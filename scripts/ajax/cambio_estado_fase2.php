<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_BASE.'/core/Conectar.php';
require_once DIR_BASE.'/core/EntidadBase.php';
require_once DIR_BASE.'/models/Centro.php';



$conectar=new Conectar();
$conexion=$conectar->conexion();
$centro_origen=new Centro($conexion,'','ajax',0);
$centro_destino=new Centro($conexion,'','ajax',0);

if($_POST['centroorigen']!='nocentro')
{
	$id_centro_origen=$centro_origen->getIdNombre($_POST['centroorigen']);
	$centro_origen->setId($id_centro_origen);
}
$id_centro_destino=$centro_destino->getIdNombre($_POST['centrodestino']);
$centro_destino->setId($id_centro_destino);

if($_POST['tipoestudios']=='ebo') $tipo=1;
else $tipo=2;
//decrementamos vacantes en centro destino
$vacantesd=$centro_destino->actualizaVacantes(0,0,$tipo,'-');
if($_POST['centroorigen']!='nocentro')
{
//incrementamos vacantes en centro original
$vacanteso=$centro_origen->actualizaVacantes(0,0,$tipo,'+');
}
$sql="update alumnos_fase2 set centro_definitivo='".$_POST['centrodestino']."',id_centro_definitivo=$id_centro_destino where id_alumno=".$_POST['id_alumno'];
$result=$conexion->query($sql);
$conexion->close();

if ($result)
	print("OK");
	else     
	echo "ERROR No results".$sql;

?>
