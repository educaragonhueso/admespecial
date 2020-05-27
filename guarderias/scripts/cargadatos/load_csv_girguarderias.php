<?php
#carga de datos de matrícula del directorio de ficheros de matricula por mes
$basedatos=require_once '../../config/config_database.php';
require_once 'config_scripts.php';

$fdatos=DATOS_SCRIPTS.'datos_guarderias_aragon.csv';
require_once('../clases/ACCESO.php');

$helper=new ACCESO($fdatos,$basedatos);

$total=$helper->carga_guarderias();
print(PHP_EOL."fin carga guardes, total: ".$total.PHP_EOL);

?>
