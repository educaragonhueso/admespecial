<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_BASE.'/core/Conectar.php';
require_once DIR_BASE.'/core/EntidadBase.php';
require_once DIR_BASE.'/models/Centro.php';

print_r($_POST);
exit();
$conectar=new Conectar();
$conexion=$conectar->conexion();
$centro=new Centro($conexion,$_POST['id_centro'],'ajax');

$vacantes=$centro->actualizaVacantes('centro','');

$sql="update matricula set estado='".$nuevoestado."' where id_alumno=".$_POST['id_alumno'];
$result=$conexion->query($sql);

$sql_centro='';

$vacantes=$centro->getVacantes('centro','');
$conexion->close();
if ($result)
	print($vacantes[0]->vacantes.':'.$vacantes[1]->vacantes);
	else     
	echo "No results".$sql;

?>
