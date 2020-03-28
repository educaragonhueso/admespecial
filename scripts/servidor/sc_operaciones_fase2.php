
<?php
#operaciones antes de iniciar la fase2
require_once "config_global.php";
require_once "Conectar.php";
require_once 'UtilidadesAdmision.php';

$tipo='fase2';

$conexion=new Conectar();

//actualizar vacantes de centros

//comprobar reservas de plaza

//copiar tabla de solicitudes definitivas a la tabla de fase2



$tsolicitud=new UtilidadesAdmision($conexion->Conexion());
########################################################################################
//Si hemos llegado al dia d elas provisionales o posterior, generamos la tabla de soliciutdes para los listados provisionales
if($tsolicitud->copiaTablaFase2($tipo,0)) echo "Copia tabla solicitudes".$tipo." realizada corectamente a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
else "Error copiando tabla provisionales";
########################################################################################
########################################################################################
?>
