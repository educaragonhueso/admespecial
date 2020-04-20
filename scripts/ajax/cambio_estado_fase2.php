<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_BASE.'/core/Conectar.php';
require_once DIR_BASE.'/core/EntidadBase.php';
require_once DIR_BASE.'/models/Centro.php';

$conectar=new Conectar();
$conexion=$conectar->conexion();
$centro_origen=new Centro($conexion,'','ajax',0);
$centro_destino=new Centro($conexion,'','ajax',0);

$centroactual=$_POST['centroactual'];
$id_centroactual=$_POST['idcentroactual'];
//centro elegido
$centroelegido=$_POST['centrodefinitivo'];
$id_centroelegido=$_POST['idcentrodefinitivo'];
$vacantes_centroelegido=$_POST['vacdefinitivo'];
$tipoestudios=$_POST['tipoestudios'];

$centro_origen->setId($id_centroactual);
$centro_destino->setId($id_centroelegido);
$centro_destino->setNombre($id_centroelegido);

$nombre_centro_destino=$centro_destino->getNombre();

if($_POST['tipoestudios']=='ebo') $tipo=1;
else $tipo=2;
//decrementamos vacantes en centro destino
$vacantesd=$centro_destino->actualizaVacantes(0,0,$tipo,'-');
if(strtoupper($_POST['centroactual'])!='NOCENTRO')
{
//incrementamos vacantes en centro original
$vacanteso=$centro_origen->actualizaVacantes(0,0,$tipo,'+');
}
$sql="update alumnos_fase2 set centro_definitivo='".$nombre_centro_destino."',id_centro_definitivo=$id_centroelegido where id_alumno=".$_POST['id_alumno'];
$result=$conexion->query($sql);
$conexion->close();

if ($result)
	print("OK");
	else     
	{
	echo "ERROR No results".$sql;
	print_r($_POST);
	}
?>
