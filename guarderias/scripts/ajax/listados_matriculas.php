<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'models/Centro.php';

$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,1,'ajax');
//mostramso vacantes dde cada centro
$tablaresumen=$tcentro->getVacantesGuarderias($_POST['rol'],$_POST['id_centro']);
print($list->showVacantesGuarderias($tablaresumen));
?>
