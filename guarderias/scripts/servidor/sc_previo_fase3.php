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
$con=$ccentros->conectar->conexion();
$tcentros_fase2=new Centro($con,'','no',0);
//$utils=new UtilidadesAdmision($ccentros->conectar->conexion(),$ccentros,$centro);
$gmutils=new UtilidadesGmaps($ccentros->conectar->conexion());
$admutils=new UtilidadesAdmision($ccentros->conectar->conexion());
$modos=array('walking','driving','bicycling','transit');
/*
$corgps="41.68695659999999,-0.8752580999999999";
$cdesgps="41.63635439999999,-0.8892253";
$cor="paseo sagasta, zaragoza";
$cdes="paseo rafael esteve, zaragoza";
$dlineal=$gmutils->getDistanciaGoogle($corgps,$cdesgps,"gps","walking");
print_r($dlineal);
exit();
*/
/*pruebas calculo distancia lineal
$cor="41.68695659999999:-0.8752580999999999";
$cdes="41.63635439999999:-0.8892253";

$dlineal=$gmutils->getDistanciaLineal($cor,$cdes,"K");
$corgps="41.68695659999999,-0.8752580999999999";
$cdesgps="41.63635439999999,-0.8892253";
$cor="paseo sagasta, zaragoza";
$cdes="paseo rafael esteve, zaragoza";
$dlineal=$gmutils->getDistanciaGoogle($corgps,$cdesgps,"gps","walking");
print_r($dlineal);
exit();
*/
//PROCESMOS ALUMNOS Y CENTROs PARA ACTUALIZAR SUS COORDENADAS SEGUN SU DIRECCION
$centros_fase2=$tcentros_fase2->getCentrosFase2(1,'guarderias');
$alumnos_fase2=$admutils->getAlumnosFase2('actual');

foreach($centros_fase2 as $c)
{
   print_r($c);
   if($c['coordenadas']=='nodata' and $c['localidad']!='nodata' and $c['direccion']!='nodata')
   {
      $dir1=$c['direccion'].",".$c['localidad'];
      $coord=$gmutils->getCoordenadas($dir1);
      $scoord=$coord['lat'].":".$coord['lng'];
      $admutils->setCoordenadas($c['id_centro'],$scoord,'centro');
   }
}

/*
foreach($alumnos_fase2 as $a)
{
   if($a->calle_dfamiliar!='nodata' and $a->localidad!='nodata' and $a->coordenadas=='nodata')
   {
      $dir1=$a->calle_dfamiliar.",".$a->localidad;
      $coord=$gmutils->getCoordenadas($dir1);
      $scoord=$coord['lat'].":".$coord['lng'];
      $admutils->setCoordenadas($a->id_alumno,$scoord,'alumno');
  }
}
//GENERAR TABLA DE DISTANCIAS CON LAS FUNCIONES DE GMAPS
foreach($centros_fase2 as $c)
{
   if($c['coordenadas']!='nodata')
   {
      foreach($alumnos_fase2 as $a)
      {
         if($admutils->checkDistancia($a->id_alumno,$c['id_centro'])==1) 
           {
            continue;
           }
         if($a->coordenadas!='nodata')
         {
          $datos=array();
          print(PHP_EOL."ALUMNO: $a->id_alumno CENTRO: ".$c['id_centro'].PHP_EOL);
          print(PHP_EOL."COORD CENTRO: ".$c['coordenadas']."COORD ALUMNO: ".$a->coordenadas.PHP_EOL);
            //if(getDistanciaData($a->id_alumno,$c['id_centro'])==0)
            //{
               foreach($modos as $m)
               {
                  $corgps=str_replace(":",",",$c['coordenadas']); 
                  $cdesgps=str_replace(":",",",$a->coordenadas); 
                  $d=$gmutils->getDistanciaGoogle($corgps,$cdesgps,"gps",$m);
                  if($d->rows[0]->elements[0]->status=="ZERO_RESULTS")
                  {
                     $distancia=floatVal(0);
                     $tiempo='nodata';
                  }
                  else
                  {
                     $distancia=$d->rows[0]->elements[0]->distance->text;
                     $distancia=str_replace(" mi","",$distancia);
                     $distancia=floatval($distancia)*1.6;
                     $tiempo=$d->rows[0]->elements[0]->duration->text;
                     $tiempo=str_replace("hours","horas",$tiempo);
                  }
                  $datos[]=$distancia;
                  $datos[]=$tiempo;
               }
              $res=$admutils->setDistancia($a->id_alumno,$c['id_centro'],$datos);
              if(!$res) print(PHP_EOL."ERROR $res");
           // }
         }
      }
   }
}
*/
print_r("OK"); exit();
//actualizar vacantes de centros
//$res1=$utils->getDistancia($dir1,$dir2,"K");
//$res1=$utils->getCoordenadas($dir1);
?>
