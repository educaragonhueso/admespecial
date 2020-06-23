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
$log_listados_generales=new logWriter('log_listados_generales',DIR_LOGS);
$log_listados_generales->warning("OBTENIENDO SOLICITUDES");
$log_listados_generales->warning(print_r($_POST,true));
######################################################################################

//VARIABLES

$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/';
$id_centro=$_POST['id_centro'];
$estado_convocatoria=$_POST['estado_convocatoria'];
$tipo_listado=$_POST['tipo'];//listados del sorteo, provisionales o definitivos
$subtipo_listado=$_POST['subtipo'];//dentro de cada tipo, el subtipo de listado
$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,$_POST['id_centro'],'ajax');
$tcentro->setNombre();

$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;

$formato=''; //formato listado en el pdf
if($subtipo_listado=='sor_ale') $nombre_listado='LISTADO ALUMNOS SEGUN NUMERO ALEATORIO PARA SORTEO';
if($subtipo_listado=='sor_bar') $nombre_listado='LISTADO SOLICITUDES BAREMADAS';
if($subtipo_listado=='sor_det') {$nombre_listado='LISTADO DETALLE BAREMO';$formato='provisional';}

######################################################################################
$log_listados_generales->warning("OBTENIENDO SOLICITUDES GENERALES, CENTRO: ".$id_centro);
######################################################################################
if($estado_convocatoria>=22 and $subtipo_listado=='sor_bar')
{
   $log_listados_generales->warning("OBTENIENDO SOLICITUDES GENERALES EN
BAREMACION substipo: $subtipo_listado estado $estado_convocatoria");
   $solicitudes=$list->getSolicitudes($id_centro,0,$fase_sorteo=3,'normal',$subtipo_listado,'todas',$estado_convocatoria); 
   #$solicitudes=$list->getSolicitudes($id_centro,0,$estado_convocatoria=$estado_convocatoria); 
}
else
{
   //mostramos las solitudes completas sin incluir borrador
   $solicitudes=$list->getSolicitudes($id_centro,0,$fase_sorteo=3); 
}
######################################################################################
$log_listados_generales->warning("OBTENIDAS SOLICITUDES GENERALES");
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
	$log_listados_generales->warning(print_r($datos,true));
	$pdf = new PDF();
	$cab=$$cabecera;
	$pdf->SetFont('Helvetica','',8);
	$pdf->AddPage('L','',0,$nombre_listado);
	$pdf->BasicTable($cab,$datos,0,30,$formato);
	$pdf->Ln(20);
	 // Arial italic 8
	$pdf->SetFont('Arial','I',8);
	  // Page number
	$pdf->Cell(40,10,'SELLO CENTRO',1,0,'C');
	$pdf->Cell(140,10,'En ______________________ a ____de________ de 2020',0,0,'C');
	$pdf->Cell(0,10,'Firmado:',0,0);
	$pdf->Ln();
	$pdf->Cell(220,10,'El Director/a',0,0,'R');
	$pdf->Output(DIR_SOR.$subtipo_listado.'.pdf','F');
}

if($subtipo_listado=='sor_ale') $subtipo='Nº ALEATORIO';
if($subtipo_listado=='sor_bar') $subtipo='SOLICITUDES BAREMADAS';
if($subtipo_listado=='sor_bar') $subtipo='SOLICITUDES DETALLE BAREMO';

print("<button type='button' class='btn btn-info' onclick='window.open(\"".DIR_SOR_WEB.$subtipo_listado.".pdf\",\"_blank\");'>Descarga listado</button>");
print($filtro_datos);
print("<div style='text-align:center'><h1>LISTADO ".strtoupper($tipo_listado)." ".strtoupper($subtipo)."</h1></div>");
print($list->showFiltrosTipo());
//mostramos listados con el campo final a 1 para no ermitir editar el registro
print($list->showListado($solicitudes,$_POST['rol'],$$cabecera,$$camposdatos));

?>
