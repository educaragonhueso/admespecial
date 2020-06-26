<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'/core/ControladorBase.php';
require_once DIR_BASE.'/core/EntidadBase.php';
require_once DIR_BASE.'/controllers/ListadosController.php';
require_once DIR_BASE.'/controllers/CentrosController.php';
require_once DIR_BASE.'/models/Centro.php';

$log_mostrar_solicitudes=new logWriter('log_mostrar_solicitudes',DIR_LOGS);
	$log_mostrar_solicitudes->warning('MOSTRARR SOLICITUDES POST:');
	$log_mostrar_solicitudes->warning(print_r($_POST,true));

if(!isset($_POST['tipoform'])) $_POST['tipoform']='normal';

$tipoform=$_POST['tipoform'];

if($_POST['rol']=='admin' || $_POST['provincia']!='todas') 
{
	$id_centro=$_POST['id_centro'];
	$list=new ListadosController('alumnos');

	$log_mostrar_solicitudes->warning('IDCENTRO: '.$id_centro);

	$solicitudes=$list->getSolicitudes($id_centro,0,$fase_sorteo=0,$tipoform); 

	$log_mostrar_solicitudes->warning('MOSTRAR SOLICITUDES');
	$log_mostrar_solicitudes->warning(print_r($solicitudes,true));
	print($list->showSolicitudes($solicitudes,'centro',$_POST['tipoform']));
}
else
{
print("ERROR");
}
?>
