<?php
include_once '../../includes/autoload.php';
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'scripts/informes/pdf/fpdf/classpdf.php';
//require_once DIR_BASE.'models/Solicitud.php';

########################################################################################
$log_listado_solicitudes=new logWriter('log_listado_solicitudes',DIR_LOGS);
########################################################################################
//VARIABLES
$menu_provisionales=''; //añadirlo si se ha realizado el sorteo
$modo='presorteo';
$id_centro=$_POST['id_centro'];
$estado_convocatoria=$_POST['estado_convocatoria'];
$hoy = date("Y/m/d");
$form_nuevasolicitud='<div class="input-group-append" id="cab_fnuevasolicitud"><button class="btn btn-outline-info" id="nuevasolicitud" type="button">Nueva solicitud</button></div>';
$filtro_solicitudes='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno o centro"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,$_POST['id_centro'],'ajax');

$provincia='todas';
if(isset($_POST['provincia']))
	$provincia=$_POST['provincia'];

$tsolicitud=new Solicitud($conexion);

$tcentro->setNombre();
$nombre_centro=$tcentro->getNombre();
$fase=$tcentro->getFase();// FASE0: no realizado, 1, dia sorteo pero asignaciones no realizadas, 2 numero asignado, 3 sorteo realizado
$numero_sorteo=$tcentro->getNumeroSorteo();// FASE0: no realizado, 1, dia sorteo pero asignaciones no realizadas, 2 numero asignado, 3 sorteo realizado
$nsolicitudes=$tcentro->getNumSolicitudes($id_centro,$fase);
//Segun el estado del sorteo deshabilitamos el sorteo
//fase 0 inicio, fase 1 inicio en baremacion provisional, fase2 publicadas listado baremacion, fase 3 pub list bar def.
if($fase<=3) $disabled='';
else $disabled='disabled';

$form_sorteo_parcial='<div id="form_sorteo_parcial" class="input-group mb-3">
	<div class="input-group-append">
	</div>
	<div class="input-group-append">
		<button class="btn" type="submit" id="boton_realizar_sorteo">Realizar sorteo</button>
	</div>
	<input type="text" id="num_sorteo" name="num_sorteo" value="" style="width:400px;" placeholder="NUMERO OBTENIDO, DEBE ESTAR ENTRE 1 y '.$nsolicitudes.'" '.$disabled.'>
	<input type="hidden" id="num_solicitudes" name="num_solicitudes" value="'.$nsolicitudes.'" placeholder="NUMERO OBTENIDO" '.$disabled.'>
</div>';
$form_sorteo_completo='<div id="form_sorteo" class="input-group mb-3">
	<div class="input-group-append">
		<button class="btn btn-success" type="submit" id="boton_asignar_numero">Asignar numero</button>
	</div>
	<div class="input-group-append">
		<button class="btn btn-success" type="submit" id="boton_realizar_sorteo">Realizar sorteo</button>
	</div>
	<input type="text" id="num_sorteo" name="num_sorteo" value="" placeholder="NUMERO OBTENIDO" disabled>
	<input type="hidden" id="num_solicitudes" name="num_solicitudes" value="'.$nsolicitudes.'" placeholder="NUMERO OBTENIDO" disabled>
</div>';

//variable para controlar si se actualiza el sorteo en la tabla de centros
//if($_POST['rol']=='centro') $fase_sorteo=$tcentro->getFaseSorteo();//0: no realizado, 1: se han asignado los numeros aleatorios, 2: se ha realizado sorteo
//else $fase_sorteo=2;
$log_listado_solicitudes->warning("OBTENIENDO SOLICITUDES CON ROL: ".$_POST['rol']);
//Para el caso de acceso del administrador o servicios provinciales
if($_POST['rol']=='admin' or $_POST['rol']=='sp')
{
   if($numero_sorteo==0) print("<h2  style='text-align:end'>SORTEO NO REALIZADO</h2>");
   else   print("<h2 style='text-align:end'>NUMERO DE SORTEO: $numero_sorteo</h2>");
   if($_POST['rol']=='admin')
   {
	   if($fase==2) print($form_sorteo_completo);
      if($fase==3) print($form_sorteo_parcial); //mostramos formulario para hacer el sorteo, ya se han hecjo las asignaciones
   }
	$centros=$list->getCentrosIds($provincia);	
	foreach($centros as $centro)
	{
	########################################################################################
	$log_listado_solicitudes->warning("OBTENIENDO NOMBRE CENTRO para".$_POST['rol']);
	$log_listado_solicitudes->warning(print_r($centro,true));
	########################################################################################
	
	$tcentro->setId($centro->id_centro);
	$tcentro->setNombre();
	$nombre_centro=$tcentro->getNombre();
	$tablaresumen=$tcentro->getResumen('centro','alumnos');
	
	########################################################################################
	$log_listado_solicitudes->warning("OBTENIENDO SOLICITUDES COMO ADMINISTRADOR: ".$_POST['rol']);
	$log_listado_solicitudes->warning($nombre_centro);
	$log_listado_solicitudes->warning(print_r($tablaresumen,true));
	########################################################################################
	
	print($list->showTablaResumenSolicitudes($tablaresumen,$nombre_centro,$centro->id_centro));
	print('<br>');
	}
}
else//accedemos como centro
{
	//SECCION OBTENCION DATOS
	########################################################################################
	$log_listado_solicitudes->warning("OBTENIENDO SOLICITUDES, FASE: ".$fase." ESTADO CONVOCATORIA: $estado_convocatoria");
	########################################################################################
	
	//obtenemos solicitudes normales
	$solicitudes=$list->getSolicitudes($id_centro,0,$fase); 
	$tablaresumen=$tcentro->getResumen($_POST['rol'],'alumnos');
	$nombre_centro=$tcentro->getNombre();
	//SECCION MOSTAR DATOS
	#Mostramos formulario para el sorteo si es el dia correcto
        $fase=$tcentro->getFaseSorteo();
	#Mostramos formulario para el sorteo si es el dia correcto


	if($fase==0)
	{
			if($_POST['id_centro']!='1') print($list->showTablaResumenSolicitudes($tablaresumen,$nombre_centro,$id_centro));
	//		print($form_nuevasolicitud);
			//print($list->showFiltrosCheck());
			print($filtro_solicitudes);
			print($list->showSolicitudes($solicitudes,$_POST['rol']));
	}
	elseif($fase==1)
   {
         if($_POST['id_centro']>='1') print($list->showTablaResumenSolicitudes($tablaresumen,$nombre_centro,$id_centro));
    //     print($form_nuevasolicitud);
         print('<br>');
         //print($list->showFiltrosCheck());
         print($filtro_solicitudes);
         print($list->showSolicitudes($solicitudes,$_POST['rol']));
   }
	//elseif($fase_sorteo==2 and $estado_convocatoria<30)
	elseif($fase>=2)
	{
			//print($menu_provisionales);
         if($_POST['id_centro']>='1') print($list->showTablaResumenSolicitudes($tablaresumen,$nombre_centro,$id_centro));
       //  if($estado_convocatoria<=30) print($form_nuevasolicitud);
			print($list->showSolicitudes($solicitudes,$_POST['rol']));
	}
}


?>
