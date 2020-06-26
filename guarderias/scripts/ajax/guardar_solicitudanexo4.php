<?php
######################
# script para modificar/editar y crear solicitudes
######################
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/SolicitudController.php';

require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';

$log_a4=new logWriter('log_a4',DIR_LOGS);
######################################################################################
$log_a4->warning("SOLICITUD a4 RECIBIDA, DATOS POST BRUTOS:");
$log_a4->warning(print_r($_POST,true));
######################################################################################

$sc=new SolicitudController();
$conexion=$sc->getConexion();
$tsol=new Solicitud($conexion);

$modo=$_POST['modo'];
$rol=$_POST['rol'];
$estado_convocatoria=$_POST['estado_convocatoria'];

$fsol_entrada=$_POST['fsol'];
if($modo=="GRABAR SOLICITUD")
{
######################################################################################
   $log_a4->warning("SOLICITUD RECIBIDA, DATOS:");
   $log_a4->warning(print_r($fsol_entrada,true));
######################################################################################
}
else
{
######################################################################################
   $log_a4->warning("POST RECIBIDO ACTUALIZANDO:");
   $log_a4->warning(print_r($fsol_entrada,true));
######################################################################################
}


parse_str($fsol_entrada, $fsol_salida);
if($rol=='alumno')
{
	$fsol_salida['id_centro_destino']=$_POST['id_centro'];
	//$fase_sol=$tsol->getFaseSol($_POST['idsol']);
	//$log_a4->warning("OBTENIDA FASE SOLICITUD: ".$fase_sol);
	//if($fase_sol=='validada') return 'ERROR, NO SE PUEDE MODIFICAR UNA SOLICITUD APTA';
	//$log_a4->warning("SOLICITUD NO ESTA EN ESTADO VALIDADA, ESTADO: ".$estado_sol);
	//$id_centro_destino=$tsol->getCentroId($_POST['id_centro_destino'],'normal');
	/*
   if($id_centro_destino==0) 
		{
		print('ERROR GUARDANDO DATOS: EL CENTRO SOLICITADO NO EXISTE');
		exit();
		}
	$fsol_salida['id_centro_destino']=$id_centro_destino;
	$log_a4->warning("SOLICITUD NUEVA DE ALUMNO, NOMBRE CENTRO: ".$_POST['id_centro_destino']);
	$log_a4->warning("SOLICITUD NUEVA DE ALUMNO, ID CENTRO: ".$fsol_salida['id_centro_destino']);
   */
}

//comprobamos los campos tipo check: padres trabajan en el cenntro y renta inferior
if(!isset($fsol_salida['cumplen']))
	$fsol_salida['cumplen']=0;
if(!isset($fsol_salida['oponenautorizar']))
	$fsol_salida['oponenautorizar']=0;
if(!isset($fsol_salida['solcalcbon']))
	$fsol_salida['solcalcbon']=0;
//Si es nueva solicitud
if($modo=="GRABAR SOLICITUD")
	{
		$log_a4->warning("SOLICITUD NUEVA, FORMULARIO RECIBIDO - DATOS BRUTOS:");
		$log_a4->warning($fsol_entrada);
		$log_a4->warning("FORMULARIO RECIBIDO:".$modo);
		$log_a4->warning(json_encode($fsol_salida));
		$log_a4->warning("GRABANDO NUEVA SOLICITUD...");
		$log_a4->warning(print_r($fsol_salida,true));
		$res=$tsol->save($fsol_salida,$_POST['idsol'],$rol);
		$log_a4->warning("RESULTADO ACT: ".$res);
		$log_a4->warning(print_r($res,true));
	}
else 
	{
		#######################################################################################################
		$log_a4->warning("ACTUALIZAR FORMULARIO RECIBIDO - DATOS BRUTOS:");
		$log_a4->warning($fsol_entrada);
		$log_a4->warning("ACTUALIZAR FORMULARIO RECIBIDO: ".$modo."ESTADO CONVOCATORIA: $estado_convocatoria ");
		$log_a4->warning(json_encode($fsol_salida));
		$log_a4->warning("ACTUALIZANDO SOLICITUD...");
		$log_a4->warning(print_r($fsol_salida,true));
		#######################################################################################################
		//modificamos solicitud teniendo en cuenta la fase en la q esta el centro y el estado de la convocatoria
		$res=$tsol->updateanexo4($fsol_salida,$_POST['idsol']);
	}
if($res<=0) 
{
	if($res==-1)	print('ERROR GUARDANDO DATOS: YA EXISTE UN USUARIO CON ESE NOMBRE DE USUARIO');
	if($res==-2)	print('ERROR GUARDANDO DATOS: YA EXISTE UN ALUMNO CON ESOS DATOS');
	if($res==0)	print('ERROR GUARDANDO DATOS: CONTACTA CON EL AMDINISTRADOR, lhueso@aragon.es');
}
else
{ 
	//si es nueva y anonima se devuelve la clave para acceder despues
	if($modo=="GRABAR SOLICITUD" and $rol=='alumno')
		print($res);
	else
 		print_r($sc->showSolicitud($res));
}
?>
