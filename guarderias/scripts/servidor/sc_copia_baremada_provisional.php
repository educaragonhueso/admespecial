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
#ACTUALIZAMOS LAS VACANTES DE TODOS LOS CENTROS TENIENDO EN CUENTA Q LAS
//RESERVAS NO GENERAN VACANTES
//LIBERAMOS LAS VACANTES DE ALUMNOS Q HAN OBTENIDO PLAZA EN EL PROCESO PREVIO  
require_once 'UtilidadesAdmision.php';

$tipo='fase2';
$res2=0;
$res1=0;

$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$ccentros=new CentrosController(0,$conexion);
$centro=new Centro($conexion,'','no',0);
$utils=new UtilidadesAdmision($conexion,$ccentros,$centro);

//copiar tabla de solicitudes definitivas a la tabla de fase2
print("Copiando tabla baremada....".PHP_EOL);
$res=$utils->copiaTablaBaremada('alumnos_baremada_provisional','2');
print("copiada $res");
if($res==1) echo "Copia tabla baremadas provisional realizada corectamente a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
else "Error copiando tabla baremadas provisional, ERROR: $res";
?>
