<?php
require_once "../../config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/Conectar.php';
require_once 'UtilidadesAdmision.php';

$tipo='provisional';

$conexion=new Conectar();

$tsolicitud=new UtilidadesAdmision($conexion->Conexion());
########################################################################################
########################################################################################
//Si hemos llegado al dia d elas provisionales o posterior, generamos la tabla de soliciutdes para los listados provisionales
$res=$tsolicitud->copiaTabla($tipo,0);	
if($res==1) echo "Copia tabla solicitudes".$tipo." realizada corectamente a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
else print("Error copiando tabla provisionales $res".PHP_EOL);

########################################################################################
########################################################################################


?>
