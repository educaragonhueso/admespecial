<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'scripts/informes/pdf/fpdf/classpdf.php';
require_once DIR_BASE.'scripts/servidor/UtilidadesAdmision.php';
require_once DIR_BASE.'models/Solicitud.php';

require_once DIR_BASE.'/scripts/ajax/form_alumnofase2js.php';
######################################################################################
$log_listados_solicitudes_fase2=new logWriter('log_listados_solicitudes_fase3',DIR_LOGS);
$log_listados_solicitudes_fase2->warning("OBTENIENDO DATOS SOLICITUDES FASE III:");
$log_listados_solicitudes_fase2->warning(print_r($_POST,true));
######################################################################################
//VARIABLES
//$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/fase2/';
$estado_convocatoria=$_POST['estado_convocatoria'];
//comprobamos si es el dia de sorteo para la fase 2

if(isset($_POST['sorteo_fase2'])) $sorteo_fase2=$_POST['sorteo_fase2'];
else $sorteo_fase2=0;
if(isset($_POST['nsorteo'])) $nsorteo=$_POST['nsorteo'];
else $nsorteo=0;
$tipo_listado='solicitudes_fase2';

if(isset($_POST['subtipo']))
	$subtipo_listado=$_POST['subtipo'];//dentro de cada tipo, el subtipo de listado, para ebo o tva

$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$utils=new UtilidadesAdmision($conexion);
$tsolicitud=new Solicitud($conexion);
$tcentro=new Centro($conexion,1,'ajax');
$nsolicitudes=$tcentro->getNumSolicitudes();
//si se ha pulsado el boton de asignar nuemro de sorteo
if($_POST['asignar']=='1')
	{
	if($utils->asignarNumSorteoFase2()!=1){ print("Error asignando numero para el sorteo");exit();}
	//$subtipo_listado="lfase2_sol";//si es para el sorteo el subtipo es lfase2_sol
	}
//si se ha pulsado el boton de realizar sorteo
if($_POST['asignar']=='2')
	{
	if($utils->actualizarSolSorteoFase2(1,$nsorteo,$nsolicitudes)!=1){ print("Error realizando el sorteo");exit();}
	$fsfase2 = fopen("nsorteofase2.txt", "w") or die("Unable to open file!");
	fwrite($fsfase2,$nsorteo);
	fclose($fsfase2);
	}
$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;
//actualizamos el estado del sorteo. 0:no realizado, 1.numero asignado, 2. realizado
$utils->setFase2Sorteo(1);
$fase2_sorteo=1;


$form_sorteo_fase2='<div id="form_sorteo" class="input-group mb-3">
		<div class="input-group-append">
			<button class="btn btn-success" type="submit" id="boton_asignar_numero_fase2" data-subtipo="'.$subtipo_listado.'">Asignar numero</button>
		</div>
		<div class="input-group-append">
			<button class="btn btn-success" type="submit" id="boton_realizar_sorteo_fase2" data-subtipo="'.$subtipo_listado.'">Realizar sorteo</button>
		</div>
		<input type="text" id="num_sorteo" name="num_sorteo" value="" placeholder="NUMERO OBTENIDO" disabled>
		<input type="hidden" id="num_solicitudes" name="num_solicitudes" value="'.$nsolicitudes.'" placeholder="NUMERO OBTENIDO" disabled>
	</div>';
$boton_asignar_automatica='<div id="form_asignarfase3" class="input-group mb-3">
				<div class="input-group-append">
				<button class="btn btn-success" type="submit" id="boton_asignar_plazas_fase3" data-subtipo="'.$subtipo_listado.'">Asignar Vacantes</button>
				</div>
		          </div>';

//mostramos las solitudes completas sin incluir borrador
$solicitudes=$list->getSolicitudes(1,0,0,$modo='fase3',$subtipo_listado,'todas',3); 

######################################################################################
$log_listados_solicitudes_fase2->warning("OBTENIDAS $nsolicitudes SOLICITUDES FASE II:");
######################################################################################
$tablaresumen=$tcentro->getResumenFase2($_POST['rol']);
print($list->showTablaResumenFase2($tablaresumen,$ncol=1));
print($list->showFiltrosTipo());
print($filtro_datos);
print("<div id='listado_fase3' style='text-align:center'><h1>LISTADO SOLICITUDES COMPLETO FASE III</h1></div>");
print($boton_asignar_automatica); //mostramos formulario sorteo solo si no se ha hecho ya
print($list->showListado($solicitudes,$_POST['rol'],$$cabecera,$$camposdatos,$provisional=1,$subtipo_listado));
print($script);
?>
