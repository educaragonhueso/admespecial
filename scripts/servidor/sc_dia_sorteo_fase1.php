<?php
require_once "../../config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/Conectar.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'models/Centro.php';

$tipo='fase2';
$res2=0;
$res1=0;

$ccentros=new CentrosController();
$centro=new Centro($ccentros->conectar->conexion(),1,'no',0);

//actualizar estado de sorteo en centros
$res1=$centro->setFaseSorteo(1);

if($res1==1)
{
	echo PHP_EOL."Actualizadas fase centro fase 1 a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
	
}
else print("Error actualizando vacantes centros: ".$res1);
?>
