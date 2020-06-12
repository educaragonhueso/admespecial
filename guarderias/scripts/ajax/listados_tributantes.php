<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'scripts/informes/pdf/fpdf/classpdf.php';
require_once DIR_BASE.'scripts/servidor/UtilidadesAdmision.php';
require_once DIR_BASE.'models/Solicitud.php';

######################################################################################
$log_listados_tributantes=new logWriter('log_listados_tributantes',DIR_LOGS);
$log_listados_tributantes->warning("TRIBUTANTES: DATOS POST");
$log_listados_tributantes->warning(print_r($_POST,true));
######################################################################################
//VARIABLES
$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/tributantes/';
$estado_convocatoria=$_POST['estado_convocatoria'];
//comprobamos si es el dia de sorteo para la fase 2

//$tipo_listado='solicitudes_fase2';
$tipo_listado='tributantes';
$subtipo_listado='tributantes';

$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$utils=new UtilidadesAdmision($conexion);
$tsolicitud=new Solicitud($conexion);
$tcentro=new Centro($conexion,1,'ajax');

$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;
//actualizamos el estado del sorteo. 0:no realizado, 1.numero asignado, 2. realizado

//mostramos las solitudes completas sin incluir borrador
$tributantes=$list->getSolicitudes(1,0,0,$modo='tributantes',$subtipo_listado,'todas',3); 

######################################################################################
$log_listados_tributantes->warning("DATOS TRIBUTANTES::");
$log_listados_tributantes->warning(print_r($tributantes,true));
######################################################################################
//Si es el listado normal, no hay sorteo
#$tablaresumen=$tcentro->getResumenFase2($_POST['rol']);
print($filtro_datos);
print("<div id='listado_tributantes' style='text-align:center'><h1>LISTADO LISTADO TRIBUTANTES COMPLETO</h1></div>");
print($list->showListado($tributantes,$_POST['rol'],$$cabecera,$$camposdatos,$provisional=1,$subtipo_listado));
?>
