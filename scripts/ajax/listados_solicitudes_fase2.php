<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'scripts/informes/pdf/fpdf/classpdf.php';
require_once DIR_BASE.'models/Solicitud.php';

######################################################################################
$log_listados_solicitudes_fase2=new logWriter('log_listados_solicitudes_fase2',DIR_LOGS);
$log_listados_solicitudes_fase2->warning("OBTENIENDO DATOS SOLICITUDES FASE II:");
$log_listados_solicitudes_fase2->warning(print_r($_POST,true));
######################################################################################
//VARIABLES
$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/fase2/';
$estado_convocatoria=$_POST['estado_convocatoria'];
$tipo_listado='solicitudes_fase2';

$subtipo_listado=$_POST['subtipo'];//dentro de cada tipo, el subtipo de listado
$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;

$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();

$tsolicitud=new Solicitud($conexion);

//mostramos las solitudes completas sin incluir borrador
$solicitudes=$list->getSolicitudes(1,0,0,$modo='fase2',$subtipo_listado,'todas',3); 

######################################################################################
$log_listados_solicitudes_fase2->warning("OBTENIDAS SOLICITUDES FASE II:");
$log_listados_solicitudes_fase2->warning(print_r($solicitudes,true));
######################################################################################


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
