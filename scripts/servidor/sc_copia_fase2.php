<?php
require_once "config_global.php";
require_once "Conectar.php";
require_once 'UtilidadesAdmision.php';

$tipo='fase2';

$conexion=new Conectar();

$tsolicitud=new UtilidadesAdmision($conexion->Conexion());
########################################################################################
//Si hemos llegado al dia d elas provisionales o posterior, generamos la tabla de soliciutdes para los listados provisionales
if($tsolicitud->copiaTablaFase2($tipo,0)) echo "Copia tabla solicitudes".$tipo." realizada corectamente a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
else "Error copiando tabla provisionales";
########################################################################################
########################################################################################
?>
