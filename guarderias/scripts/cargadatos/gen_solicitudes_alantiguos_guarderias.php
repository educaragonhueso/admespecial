<?php
#carga de datos de matrícula del directorio de ficheros de matricula por mes
$basedatos=require_once '../../config/config_database.php';
$fdatos='../datos/datos_entrada/alumnos_antiguos_guarderias2020.csv';
require_once('../clases/ACCESO.php');

$helper=new ACCESO($fdatos,$basedatos);

$total=$helper->carga_alumnos_antiguos_guarderias();
print(PHP_EOL."fin carga solicitudes, total: ".$total.PHP_EOL);

?>
