<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'scripts/informes/pdf/fpdf/classpdf.php';

######################################################################################
$log_listados_provisionales=new logWriter('log_listados_provisionales',DIR_LOGS);
$log_listados_provisionales->warning("OBTENIENDO DATOS PROVISIONALES POST:");
$log_listados_provisionales->warning(print_r($_POST,true));
######################################################################################
//VARIABLES
$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/provisionales/';
$id_centro=$_POST['id_centro'];
$estado_convocatoria=$_POST['estado_convocatoria'];
$tipo_listado='provisionales';
$subtipo_listado=$_POST['subtipo'];//dentro de cada tipo, el subtipo de listado
$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,$_POST['id_centro'],'ajax');
$tcentro->setNombre();
$nsorteo=$tcentro->getNumeroSorteo();

$nsolicitudes=$tcentro->getNumSolicitudes($id_centro);
$dsorteo=$tcentro->getVacantes($id_centro);
$vacantes_ebo=$dsorteo[0]->vacantes;
$vacantes_tva=$dsorteo[1]->vacantes;

$titulo_listado=strtoupper($tipo_listado)." ".strtoupper($subtipo).$tcentro->getNombre();
//obtenemos estado de la convocatoria ara el centro
$estado_centro=$tcentro->getFaseSorteo();
//OPERACIONES ACTUALIZACION SOLICITUDES SEGUN ESTADO CONVOCATORIA
//Si se ha realizado ya el sorteo en ese centro y aun no estamos en el estado de provisionales
if($estado_centro==2 and $estado_convocatoria<3)
	{
		$nsolicitudes=$tcentro->getNumSolicitudes($id_centro);
		$nsorteo=$tcentro->getNumeroSorteo();
		$dsorteo=$tcentro->getVacantes($id_centro);
		$vacantes_ebo=$dsorteo[0]->vacantes;
		$vacantes_tva=$dsorteo[1]->vacantes;
		$tcentro->actualizaVacantes($vacantes_ebo,$vacantes_tva);
		if($list->actualizaSolicitudesSorteo($id_centro,$nsorteo,$nsolicitudes,$vacantes_ebo,$vacantes_tva)==0) 
			print("NO HAY VACANTES<br>");
		//si se ha hecho el sorteo en el centro, copiamos la tabla a provisionales
		$tsolicitud->copiaTabla('provisional',$id_centro);	
	########################################################################################
	$log_listado_solicitudes->warning("CREADA TABLA PROV. ESTADO: ".$tcentro->getEstado());
	########################################################################################
	}

$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;

######################################################################################
$log_listados_provisionales->warning("OBTENIENDO SOLICITUDES PROVISIONALES, CABECERA: ".$cabecera);
$log_listados_provisionales->warning("OBTENIENDO SOLICITUDES PROVISIONALES, CAMPOS DATOS: ".$camposdatos);
$log_listados_provisionales->warning("OBTENIENDO SOLICITUDES PROVISIONALES, SUBTIPO: ".$subtipo_listado);
$log_listados_provisionales->warning("OBTENIENDO SOLICITUDES PROVISIONALES, CENTRO:ESTADO ".$id_centro.":".$estado_centro);
$log_listados_provisionales->warning("OBTENIENDO SOLICITUDES PROVISIONALES, ESTADO CONVOCATORIA:  ".$estado_convocatoria);
######################################################################################

//mostramos las solitudes completas sin incluir borrador
$solicitudes=$list->getSolicitudes($id_centro,0,$estado_centro,$modo='provisionales',$subtipo_listado,'todas',3); 

######################################################################################
$log_listados_provisionales->warning("OBTENIENDO SOLICITUDES PROVISIONALES, DATOS: ");
$log_listados_provisionales->warning(print_r($solicitudes,true));
######################################################################################

//actualizamos las solicitudes por si hay cambios para tener en cuenta el sorteo previo


if($_POST['pdf']==1)
{
	$datos=array();
	$i=0;
	//extraemos los campos de datos q nos interesan
	foreach($solicitudes as $sol)
	{
		$datos[$i] = new stdClass;
		foreach($$camposdatos as $d)
		{
			$datos[$i]->$d=$sol->$d;
		}
	$i++;
	}
	$pdf = new PDF();
	$cab=$$cabecera;
	$pdf->SetFont('Helvetica','',8);
	$pdf->AddPage('L','',0,$titulo_listado);
	$pdf->BasicTable($cab,$datos,0,30,'provisional');
	$pdf->Ln(20);
	$pdf->SetFont('Arial','I',8);
	  // Page number
	$pdf->Cell(30);
	$pdf->Cell(40,10,'SELLO CENTRO',1,0,'C');
	$pdf->Cell(140,10,'En ______________________ a ____de________ de 2020',0,0,'C');
	$pdf->Cell(0,10,'Firmado:',0,0);
	$pdf->Ln();
	$pdf->Cell(220,10,'El Director/a',0,0,'R');
	$pdf->Output(DIR_PROV.$subtipo_listado.'.pdf','F');
}

if($subtipo_listado=='admitidos_prov') $subtipo='ADMITIDOS PROVISIONAL';
if($subtipo_listado=='noadmitidos_prov') $subtipo='NO ADMITIDOS PROVISIONAL';
if($subtipo_listado=='excluidos_prov') $subtipo='EXCLUIDOS PROVISIONAL';

print("<button type='button' class='btn btn-info' onclick='window.open(\"".DIR_PROV_WEB.$subtipo_listado.".pdf\",\"_blank\");'>Descarga listado</button>");
/*
print("TITULO: ".$titulo_listado);
print("IDCENTRO: ".$id_centro);
print("NOMBRE CENTRO: ".str_replace(' ','',$tcentro->getNombre()));
*/
print($list->showFiltrosTipo());
print($filtro_datos);
print("<div style='text-align:center'><h1>LISTADO ".$titulo_listado."</h1></div>");
print($list->showListado($solicitudes,$_POST['rol'],$$cabecera,$$camposdatos,$provisional=1));

?>
