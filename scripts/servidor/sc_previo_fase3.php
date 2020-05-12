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
require_once 'UtilidadesGmaps.php';
require_once 'UtilidadesAdmision.php';

$tipo='fase2';
$res2=0;
$res1=0;

$ccentros=new CentrosController();
$centro=new Centro($ccentros->conectar->conexion(),'','no',0);
//$utils=new UtilidadesAdmision($ccentros->conectar->conexion(),$ccentros,$centro);
$gmutils=new UtilidadesGmaps($ccentros->conectar->conexion());
$admutils=new UtilidadesAdmision($ccentros->conectar->conexion());

$cor="41.68695659999999:-0.8752580999999999";
$cdes="41.63635439999999:-0.8892253";

$dlineal=$gmutils->getDistanciaLineal($cor,$cdes,"K");
print($dlineal);exit();
//PROCESMOS ALUMNOS Y CENTROs PARA ACTUALIZAR SUS COORDENADAS SEGUN SU DIRECCION
$alumnos_fase2=$admutils->getAlumnosFase2('actual');

foreach($alumnos_fase2 as $a)
{
   if($a->calle_dfamiliar!='nodata' and $a->localidad!='nodata')
   {
      $dir1=$a->calle_dfamiliar.",".$a->localidad;
      $coord=$gmutils->getCoordenadas($dir1);
      print_r($coord);
      $scoord=$coord['lat'].":".$coord['lng'];
      $admutils->setAlumnoCoordenadas($a->id_alumno,$scoord);
   }
}

//actualizar vacantes de centros
//$res1=$utils->getDistancia($dir1,$dir2,"K");
//$res1=$utils->getCoordenadas($dir1);
?>
