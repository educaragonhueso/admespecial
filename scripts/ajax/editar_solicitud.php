<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_BASE.'/core/ControladorBase.php';
require_once DIR_BASE.'/core/EntidadBase.php';
require_once DIR_BASE.'/models/Solicitud.php';
require_once DIR_BASE.'/scripts/ajax/form_alumnojs.php';
require_once DIR_BASE.'/controllers/SolicitudController.php';

require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';

$log_editar_solicitud=new logWriter('log_editar_solicitud',DIR_LOGS);

$consulta=$_POST['modo'];
if(isset($_POST['id_alumno'])) $id=$_POST['id_alumno'];
else $id=0;
if(isset($_POST['rol'])) $rol=$_POST['rol'];
else $rol='alumno';

$log_editar_solicitud->warning("EDITANDO ALUMNO");
$log_editar_solicitud->warning(print_r($_POST,true));
$scontroller=new SolicitudController($rol);
$conexion=$scontroller->getConexion();
$tsol=new Solicitud($conexion);
$tcentro=new Centro($conexion,$_POST['id_centro'],'ajax');

if(isset($_POST['id_centro'])){
$id_centro=$_POST['id_centro'];
$fase_sorteo=$tsol->getFaseCentro($id_centro);
$log_editar_solicitud->warning("FASE SORTEO CENTRO: $id_centro , FASE: $fase_sorteo");
}
else $id_centro=0;

//revisar si es un administrador para mostrar los datos de la tabla provisionales
if(isset($_POST['estado_convocatoria'])){
	if($_POST['estado_convocatoria']>=30){
		$fase_sorteo=2;
		}
}
$estado_sol='irregular';
$solo_lectura=0;

$log_editar_solicitud->warning("DATOS ALUMNO RECIBID");
$log_editar_solicitud->warning(print_r($_POST,true));
$log_editar_solicitud->warning("DATOSS FASE SORTEO:".$fase_sorteo);
#si es un ciudadano obtenemos el id usando el pin proporcionado
if($rol=='alumno')
{
	$pin=$_POST['pin'];
	$id=$scontroller->getIdAlumnoPin($pin);
//obtenemos el estado de la solicitud
	$log_editar_solicitud->warning("idalumno-pin: ".$id.'-'.$pin);
	$estado_sol=$tsol->getEstadoSol($id);
	if($estado_sol=='apta') $solo_lectura=1;
}

if(isset($_POST['codigo_centro'])) $id_centro=$_POST['codigo_centro'];

//obtenemos formulario con los datos
$sform=$scontroller->showFormSolicitud($id,$id_centro,$rol,1,$solo_lectura,$fase_sorteo);

$botonimp='<a href="imprimirsolicitud.php?id='.$id.'" target="_blank"><input class="btn btn-primary imprimirsolicitud" style="background-color:brown;padding-left:20px" type="button" value="Vista Previa Impresion Documento"/></a>';
//Si el id es cero obentemos el nuevo id
if($id==0) $id=$scontroller->lastid+1;

$repjs="#loc_dfamiliar".$id;
$script=str_replace('.localidad',$repjs,$script);

$repjs="#nacionalidad".$id;
$script=str_replace('.nacionalidad',$repjs,$script);

if($estado_sol=='apta') print("EDUP-La solicitud no se puede moidificar");
print($sform);
print($script);

?>
