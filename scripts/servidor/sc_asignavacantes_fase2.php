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

//tipo de fase
$tipo='fase2';

$ccentros=new CentrosController();
$con=$ccentros->conectar->conexion();

//Obtenemos todos los alumnos y todos los centros con sus vacantes
$talumnos_fase2=new Alumno($con,'alumnos_fase2');
//$alumnos_fase2=$talumnos_fase2->getAll();

$tcentros_fase2=new Centro($con,'','no',0);
//$centros_fase2=$tcentros_fase2->getCentrosFase2();

$utils=new UtilidadesAdmision($ccentros->conectar->conexion(),'',$tcentros_fase2);

//asignar vacantetes de cada centro
do{
$alumnos_fase2=$talumnos_fase2->getAll();
$centros_fase2=$tcentros_fase2->getCentrosFase2();
$avac=$utils->asignarVacantesCentros($centros_fase2,$alumnos_fase2);
}while($avac==-2);

if($avac==1)
{
	echo PHP_EOL."Asignadas vacantes centros para fase 2 a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
	
}
elseif($avac=="NO CENTRO") print(PHP_EOL."Error asignando vacantes centros fase2, NO CENTRO");
elseif($avac==-1) print("Array de alumnos o de centros vacio");
elseif($avac==-2) print("Alumnos libera reserva");
print($avac);


exit();
?>
