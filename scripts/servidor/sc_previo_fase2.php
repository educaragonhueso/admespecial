
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

$ccentros=new CentrosController();
$centro=new Centro($ccentros->conectar->conexion(),'','no',0);
$utils=new UtilidadesAdmision($ccentros->conectar->conexion(),$ccentros,$centro);

//actualizar vacantes de centros
$cen=$utils->actualizaVacantesCentros();
if($cen==1)
{
	echo PHP_EOL."Actualizadas vacantes centros para fase 2 a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
	
}
else print("Error actualizando vacantes centros: ".$cen);

//copiar tabla de solicitudes definitivas a la tabla de fase2
if($tsolicitud->copiaTablaFase2($tipo,0)) echo "Copia tabla solicitudes".$tipo." realizada corectamente a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
else "Error copiando tabla provisionales";
?>