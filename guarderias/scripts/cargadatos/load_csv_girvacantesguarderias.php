<?php
#carga de datos de matrícula del directorio de ficheros de matricula por mes
$basedatos=require_once '../../config/config_database.php';
require_once 'config_scripts.php';

$fdatos=DATOS_SCRIPTS_DIR.'vacantes_provisionales.csv';
$fdatos=DATOS_SCRIPTS_DIR.'vacantes_definitivas.csv';
require_once('../clases/ACCESO.php');

$helper=new ACCESO($fdatos,$basedatos);

$total=$helper->carga_vacantes();
print(PHP_EOL."fin carga vacantes guardes, total: ".$total.PHP_EOL);

?>
