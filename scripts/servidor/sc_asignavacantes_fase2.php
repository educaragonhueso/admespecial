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
require_once DIR_BASE.'models/Alumno.php';
#operaciones antes de iniciar la fase2
require_once 'UtilidadesAdmision.php';

$log_asigna_fase2=new logWriter('log_asignacion_fase2',DIR_LOGS);
//tipo de fase
$tipo='fase2';

$ccentros=new CentrosController();
$con=$ccentros->conectar->conexion();

//Obtenemos todos los alumnos y todos los centros con sus vacantes
$talumnos_asignacion_fase2=new Alumno($con,'alumnos_fase2');
//$alumnos_fase2=$talumnos_fase2->getAll();

$tcentros_fase2=new Centro($con,'','no',0);
//$centros_fase2=$tcentros_fase2->getCentrosFase2();
$post=0;
$utils=new UtilidadesAdmision($ccentros->conectar->conexion(),'',$tcentros_fase2,1);
if(isset($_POST['subtipo']))
	$tipoestudios=str_replace('lfase2_sol_','',$_POST['subtipo']);
else
	{
	$post=0;
	$tipoestudios='ebo';
	}

$avac=10;

$log_asigna_fase2->warning("DATOS RECIBIDOS ASINACION AUTOMATICA");
$log_asigna_fase2->warning(print_r($_POST,true));
$j=0;
$post=1;


//ANTES DE EMPEZAR REPLCIAMOS LA TABAL DE ALUMNOS A LA TABAL TEMPORAL QUE
//USAREMOS EN EL RESETEO
if(!$utils->copiaTablaTmpFase2()) {
      $log_asigna_fase2->warning("ERROR COPIANDO TABAL TMP FASE2");
      exit();
}

//asignar vacantetes de cada centro a centro elegido en primera opcion (oopcion 0)
do{
	if(!$post) print("INICIANDO PROCESO POR $j VECES".PHP_EOL);
   $log_asigna_fase2->warning("INICIANDO PROCESO POR $j VECES");
	if($avac==0) break;
	
	for($i=0;$i<=6;$i++)
	{
      $log_asigna_fase2->warning("EMPEZANDO CENTRO VACANTE NUMERO: $i");
		if(!$post) print("EMPEZANDO CENTRO $i, AVAC: $avac".PHP_EOL);
		
		$alumnos_fase2=$utils->getAlumnosFase2('actual');
		$centros_fase2=$tcentros_fase2->getCentrosFase2();
		
		$avac=$utils->asignarVacantesCentros($centros_fase2,$alumnos_fase2,$i,$tipoestudios,$post);
		
		if($avac==0) break;
		if($avac==-2){
			$reset=$utils->resetAlumnosFase2();
			$j++; 
			break;
			}
	}
}while($avac==-2);//mientras se este liberando una reserva hay q volver a empezar

if($avac==1)
{
   $log_asigna_fase2->warning("Asignadas vacantes centros para fase 2");
	echo PHP_EOL."Asignadas vacantes centros para fase 2 a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
	return;	
}
elseif($avac=="NO CENTRO") print(PHP_EOL."Error asignando vacantes centros fase2, NO CENTRO");
elseif($avac==-1) print("Array de alumnos o de centros vacio");
elseif($avac==-2) print("Alumnos libera reserva");
elseif($avac==0) print("Error asignando");

exit();
?>
