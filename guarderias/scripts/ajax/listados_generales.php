<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'scripts/informes/pdf/fpdf/classpdf.php';
require_once DIR_BASE.'scripts/servidor/UtilidadesAdmision.php';

######################################################################################
$log_listados_generales=new logWriter('log_listados_generales',DIR_LOGS);
$log_listados_generales->warning("OBTENIENDO SOLICITUDES");
$log_listados_generales->warning(print_r($_POST,true));
######################################################################################

//VARIABLES

$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/';
$id_centro=$_POST['id_centro'];
$tipo_listado=$_POST['tipo'];//listados del sorteo, provisionales o definitivos
$subtipo_listado=$_POST['subtipo'];//dentro de cada tipo, el subtipo de listado
$estado_convocatoria=$_POST['estado_convocatoria'];//dentro de cada tipo, el subtipo de listado
$provincia=$_POST['provincia'];//dentro de cada tipo, el subtipo de listado

$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,$_POST['id_centro'],'ajax');
$tcentro->setNombre();
$fase=$tcentro->getFase();
$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;
$modo='baremadas';

$ccentros=new CentrosController(0,$conexion);
$utils=new UtilidadesAdmision($conexion,$ccentros,$tcentro);

$formato=''; //formato listado en el pdf
if($subtipo_listado=='sor_ale') $nombre_listado='LISTADO ALUMNOS SEGUN NUMERO ALEATORIO PARA SORTEO';
if($subtipo_listado=='sor_bar') {$nombre_listado='LISTADO SOLICITUDES BAREMADAS';$modo='baremadas';}
if($subtipo_listado=='sor_bardef') {$nombre_listado='LISTADO SOLICITUDES BAREMADAS';$modo='baremadasdef';}
if($subtipo_listado=='sor_det') {$nombre_listado='LISTADO DETALLE BAREMO';$formato='provisional';}

######################################################################################
$log_listados_generales->warning("OBTENIENDO SOLICITUDES GENERALESS, SUBTIPO/FASE/CENTRO/PROVINCIA: $subtipo_listado -  $fase - $id_centro - $provincia");
######################################################################################

//copiamos tabla de defintivas baremadas para ese centro siempre q sea para definitivos o datos de detalle de baremo
if($subtipo_listado=='sor_bardef' or $subtipo_listado=='sor_det')
   {
   $log_listados_generales->warning("COPIANDO TABLA DEIFNITIVO: $subtipo_listado -  $fase - $id_centro - $provincia");
   $res=$utils->copiaTablaBaremada('alumnos_baremada_definitivo','2',$id_centro,'todas');
   }
//mostramos las solitudes completas sin incluir borrador
$solicitudes=$list->getSolicitudes($id_centro,0,$fase,$modo,$subtipo_listado,$provincia,$estado_convocatoria); 

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
if($subtipo_listado=='sor_det') $subtipo='SOLICITUDES DETALLE BAREMO';

print("<button type='button' class='btn btn-info' onclick='window.open(\"".DIR_SOR_WEB.$subtipo_listado.".pdf\",\"_blank\");'>Descarga listado</button>");
print($filtro_datos);
print("<div style='text-align:center'><h1>LISTADO ".strtoupper($tipo_listado)." ".strtoupper($subtipo)."</h1></div>");
#print($list->showFiltrosTipo());
print($list->showListado($solicitudes,$_POST['rol'],$$cabecera,$$camposdatos,1));

?>
