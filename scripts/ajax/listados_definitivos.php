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
$log_listados_definitivos=new logWriter('log_listados_definitivos',DIR_LOGS);
$log_listados_definitivos->warning("OBTENIENDO DATOS DEFINITIVOS POST:");
$log_listados_definitivos->warning(print_r($_POST,true));
######################################################################################

//VARIABLES

$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/definitivos/';
$id_centro=$_POST['id_centro'];
$estado_convocatoria=$_POST['estado_convocatoria'];
$subtipo_listado=$_POST['subtipo'];//dentro de cada tipo, el subtipo de listado
$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,$_POST['id_centro'],'ajax');
$tcentro->setNombre();

$tsolicitud=new Solicitud($conexion);
$dvacantes=$tcentro->getVacantes($id_centro);
$estado_centro=$tcentro->getFaseSorteo();

$vacantes_ebo=$dvacantes[0]->vacantes;
$vacantes_tva=$dvacantes[1]->vacantes;

$log_listados_definitivos->warning("ACTUALIZANDO DEFINITIVOS, DATOS:  ESTADO CENTRO/IDCENTRO $estado_centro/$estado_convocatoria");
//La convocatoria esta en definitivo según el dia programado
//si la convocatoria esta en definitivo, entramos una vez para copiar la tabla con los datos del centro
/*
if($estado_centro==2 and $estado_convocatoria==40)
	{
		$nsolicitudes=$tcentro->getNumSolicitudes($id_centro);
		$nsorteo=$tcentro->getNumeroSorteo();
		$dsorteo=$tcentro->getVacantes($id_centro);
		$vacantes_ebo=$dsorteo[0]->vacantes;
		$vacantes_tva=$dsorteo[1]->vacantes;
		$log_listados_definitivos->warning("ACTUALIZANDO DEFINITIVOS, DATOS:  NSOLICITUDES/IDCENTRO $nsorteo/$id_centro");
		$tcentro->actualizaVacantes($vacantes_ebo,$vacantes_tva);
		if($list->actualizaSolicitudesSorteo($id_centro,$nsorteo,$nsolicitudes,$vacantes_ebo,$vacantes_tva)==0) 
			print("NO HAY VACANTES<br>");
		//si se ha hecho el sorteo en el centro, copiamos la tabla a provisionales
		$tsolicitud->copiaTabla('definitivo',$id_centro);	
		########################################################################################
		$log_listados_definitivos->warning("CREADA TABLA DEFINITIVOS, ESTADO: ".$tcentro->getEstado());
		########################################################################################
		if(!$tcentro->setFaseSorteo(3)) {print("ERROR PROVISIONALES"); exit();}
	}
*/
$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;

######################################################################################
$log_listados_definitivos->warning("OBTENIENDO LISTADOS DEFINITIVOS, CENTRO: ".$id_centro);
######################################################################################

//actualizamos solicitudes para tener en cuenta las que hayan cambiado
//Esto solo puede hacerse en el momento q finalice el plazo de provisionales!!!!!!!!
$solicitud=new Solicitud($conexion);
$solicitudes=$solicitud->genSolDefinitivas($id_centro,$vacantes_ebo,$vacantes_tva); 
//mostramos las solitudes completas sin incluir borrador
$solicitudes=$list->getSolicitudes($id_centro,0,$fase_sorteo=0,$modo='definitivos',$subtipo_listado); 

######################################################################################
$log_listados_definitivos->warning("OBTENIENDO SOLICITUDES GENERALES, DATOS: ");
$log_listados_definitivos->warning(print_r($solicitudes,true));
######################################################################################

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
	$pdf->BasicTable($cab,$datos,0,30,'definitivo');
	$pdf->Ln(20);
	$pdf->SetFont('Arial','I',8);
	  // Page number
	$pdf->Cell(30);
	$pdf->Cell(40,10,'SELLO CENTRO',1,0,'C');
	$pdf->Cell(140,10,'En ______________________ a ____de________ de 2020',0,0,'C');
	$pdf->Cell(0,10,'Firmado:',0,0);
	$pdf->Ln();
	$pdf->Cell(220,10,'El Director/a',0,0,'R');
	$pdf->AddPage();
	$pdf->Output(DIR_PROV.$subtipo_listado.'.pdf','F');
}

if($subtipo_listado=='admitidos_def') $subtipo='ADMITIDOS DEFINITIVO';
if($subtipo_listado=='noadmitidos_def') $subtipo='NO ADMITIDOS DEFINITIVO';
if($subtipo_listado=='excluidos_def') $subtipo='EXCLUIDOS DEFINITIVO';

print("<button type='button' class='btn btn-info' onclick='window.open(\"".DIR_PROV_WEB.$subtipo_listado.".pdf\",\"_blank\");'>Descarga listado</button>");
print($list->showFiltrosTipo());
print($filtro_datos);
print("<div style='text-align:center'><h1>LISTADO ".strtoupper($tipo_listado)." ".strtoupper($subtipo)."</h1></div>");
print($list->showListado($solicitudes,$_POST['rol'],$$cabecera,$$camposdatos,$provisional=1));

?>
