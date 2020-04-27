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

$log_fase2=new logWriter('log_fase2',DIR_LOGS);
//tipo de fase
$tipo='fase2';

$ccentros=new CentrosController();
$con=$ccentros->conectar->conexion();

//Obtenemos todos los alumnos y todos los centros con sus vacantes
$talumnos_fase2=new Alumno($con,'alumnos_fase2');
//$alumnos_fase2=$talumnos_fase2->getAll();

$tcentros_fase2=new Centro($con,'','no',0);
//$centros_fase2=$tcentros_fase2->getCentrosFase2();
$post=1;
$utils=new UtilidadesAdmision($ccentros->conectar->conexion(),'',$tcentros_fase2,0);
if(isset($_POST['subtipo']))
	$tipoestudios=str_replace('lfase2_sol_','',$_POST['subtipo']);
else
	{
	$post=0;
	$tipoestudios='ebo';
	}

$avac=10;

$j=0;
//asignar vacantetes de cada centro a centro elegido en primera opcion (oopcion 0)
do{
	if(!$post) print("INICIANDO EL PROCESO POR $j VECES".PHP_EOL);
	if($avac==0) break;
	for($i=0;$i<=6;$i++)
	{
		if(!$post) print("EMPEZANDO CENTRO $i, AVAC: $avac".PHP_EOL);
		$log_fase2->warning("INCIIO FOR, AVAC: $avac");
		
		//si venimos de una reserva de plaza, liberacion tenemos q volver a empezar tomando los alumnos de la tabla original
		if($avac==-2) $alumnos_fase2=$utils->getAlumnosFase2('tmp');
		else $alumnos_fase2=$utils->getAlumnosFase2('actual');
		
		$centros_fase2=$tcentros_fase2->getCentrosFase2();
		$avac=$utils->asignarVacantesCentros($centros_fase2,$alumnos_fase2,$i,$tipoestudios,$post);
		
		if($avac==0) break;
		if($avac==-2){$j++; break;}
	}
}while($avac==-2);//mientras se este liberando una reserva hay q volver a empezar

if($avac==1)
{
	echo PHP_EOL."Asignadas vacantes centros para fase 2 a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
	return;	
}
elseif($avac=="NO CENTRO") print(PHP_EOL."Error asignando vacantes centros fase2, NO CENTRO");
elseif($avac==-1) print("Array de alumnos o de centros vacio");
elseif($avac==-2) print("Alumnos libera reserva");
elseif($avac==0) print("Error asignando");


exit();
?>
