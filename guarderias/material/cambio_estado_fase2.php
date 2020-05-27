<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_BASE.'/core/Conectar.php';
require_once DIR_BASE.'/core/EntidadBase.php';
require_once DIR_BASE.'/models/Centro.php';
require_once DIR_BASE.'/scripts/servidor/UtilidadesAdmision.php';

$conectar=new Conectar();
$conexion=$conectar->conexion();
$centro_origen=new Centro($conexion,'','ajax',0);//centro q tiene asignado en la actualidad
$centro_destino=new Centro($conexion,'','ajax',0);//cenro al q se le mueve o cambia
$centro_estudios_origen=new Centro($conexion,'','ajax',0);//centro del q proviene
$utils=new UtilidadesAdmision($conexion);

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

//comprobamos si libera plaza, obtenemos id del centro si lo hay y comproabmos si la reserva se ha liberado o no
$acestudiosorigen=$utils->getReservaPlaza($_POST['id_alumno']);
$areserva=$utils->checkReservaPlaza($_POST['id_alumno']);
$idcentro_estudios_origen=$acestudiosorigen[0];
$reserva=$areserva[0];
//incrementamos vacantes en centro de estudios origen si es q existe, no es cero
if($idcentro_estudios_origen!=0 and $reserva==1)
	{
	$centro_estudios_origen->setId($idcentro_estudios_origen);
	$lr=$utils->liberaReserva($_POST['id_alumno']);
	$vo=$centro_estudios_origen->actualizaVacantes(0,0,$tipo,'+');
	}
/*
print_r($acestudiosorigen);
print_r($acestudiosorigen[0]);
print("act vac".$idcentro_estudios_origen);
print("FIN");
exit();
*/

//decrementamos vacantes en centro destino
$vacantesd=$centro_destino->actualizaVacantes(0,0,$tipo,'-');
if(strtoupper($_POST['centroactual'])!='NOCENTRO')
{
//incrementamos vacantes en centro original
$vacanteso=$centro_origen->actualizaVacantes(0,0,$tipo,'+');
}
$sql="update alumnos_fase2 set centro_definitivo='".$nombre_centro_destino."',id_centro_definitivo=$id_centroelegido,tipo_modificacion='manual' where id_alumno=".$_POST['id_alumno'];
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
