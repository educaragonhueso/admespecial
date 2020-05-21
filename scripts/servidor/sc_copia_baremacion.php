<?php
require_once "../../config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/Conectar.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'models/Solicitud.php';
require_once 'UtilidadesAdmision.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'controllers/ListadosController.php';

$log_fase_baremacion=new logWriter('log_fase_baremacion',DIR_LOGS);

$tipo='provisional';

$list=new ListadosController('alumnos');
$conexion=$list->adapter;
$ccentros=new CentrosController(0,$conexion);
$centro=new Centro($conexion,'','no',0);
$utils=new UtilidadesAdmision($conexion,$ccentros,$centro);
$tsolicitud=new Solicitud($conexion);
$ct=$tsolicitud->copiaTablaBaremacion(1,'alumnos_baremacion_final','baremo_baremacion_final');	

$log_fase_baremacion->warning("RESULTADO COPIAR TABLA $ct ");

echo PHP_EOL."Copia tabla solicitudes baremadas realizada corectamente a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
?>
