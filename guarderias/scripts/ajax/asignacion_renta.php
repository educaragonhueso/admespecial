<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_BASE.'/core/Conectar.php';
require_once DIR_BASE.'/core/EntidadBase.php';
require_once DIR_BASE.'/models/Centro.php';

$conectar=new Conectar();
$conexion=$conectar->conexion();
$centro=new Centro($conexion,$_POST['id_centro'],'ajax');

if($_POST['nodatos']==1)
$sql="UPDATE alumnos set nodatos='".$_POST['nodatos']."', importe_renta='0', cuota='0', puntos_renta='0' where id_alumno=".$_POST['id_alumno'];
else
$sql="UPDATE alumnos set nodatos='".$_POST['nodatos']."', importe_renta='".$_POST['importe_renta']."', cuota='".$_POST['cuota']."', puntos_renta='".$_POST['puntos_renta']."' where id_alumno=".$_POST['id_alumno'];
$result=$conexion->query($sql);
$conexion->close();
echo "Consulta".$sql;
if ($result)
	print("OK GRABANDO RENTA".$sql);
	else     
	echo "No results".$sql;

?>