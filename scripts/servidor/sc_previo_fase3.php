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
#operaciones antes de iniciar la fase2
require_once 'UtilidadesAdmision.php';

$tipo='fase2';
$res2=0;
$res1=0;

$ccentros=new CentrosController();
$centro=new Centro($ccentros->conectar->conexion(),'','no',0);
$utils=new UtilidadesAdmision($ccentros->conectar->conexion(),$ccentros,$centro);

$dir1="Rafael esteve aragon 34 50018";
$dir2="PAseo ruiseñores aragon 34 50018";

//actualizar vacantes de centros
$res1=$utils->getDistancia($dir1,$dir2,"K");
print($res1);

if($res1==1)
{
	echo PHP_EOL."Distancia fase 2 a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
	
}
else print("Error actualizando vacantes centros: ".$res1);
//copiar tabla de solicitudes definitivas a la tabla de fase2
?>
