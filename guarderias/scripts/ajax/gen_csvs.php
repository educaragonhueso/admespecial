<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_BASE.'core/Conectar.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/SolicitudController.php';
require_once DIR_BASE.'models/Solicitud.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'scripts/ajax/form_alumnojs.php';

require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';

#####VARIABLES#############################################################################

$id_centro=$_POST['id_centro'];
$subtipo_original=$_POST['subtipo'];
$subtipo=substr($subtipo_original,4);

$estado_convocatoria=$_POST['estado_convocatoria'];

$rol=$_POST['rol'];
//si son servicio sprovinciales quitamos los dos caracteres
$provincia=$_POST['provincia'];
$subtipo_csv=$subtipo;//dentro de cada tipo, el subtipo de listado
$cabecera="campos_cabecera_csv_".$subtipo_csv;
$camposdatos="campos_bbdd_csv_".$subtipo_csv;

if($subtipo=='fase2' or $subtipo=='fase3') $tipo=3;
else $tipo=0;
$fase_sorteo=0;
$modo='csv';

$list=new ListadosController('alumnos');
$centros_cont=new CentrosController(0);

##################################################################################
$log_gencsvs=new logWriter('log_gencsvs',DIR_LOGS);
$log_gencsvs->warning("DATOS POST PARA CSV");
$log_gencsvs->warning(print_r($_POST,true));
##################################################################################

//$solicitudes=$list->getSolicitudes($id_centro,$tipo,$fase_sorteo,$modo,$subtipo,$provincia,$estado_convocatoria); 

##################################################################################
$log_gencsvs->warning("SOLICITUDES  CSV SUBTIPO: $subtipo CAMPOS DATOS: ");
$log_gencsvs->warning(print_r($$camposdatos,true));
##################################################################################

//si es para datos de matricula, con rol de admin
if($subtipo_original=='csv_mat_admin' && $rol=='admin')
{
	$centros_data=$centros_cont->getCentrosData('matricula'); 
}

//si es para matricula de alumnos que promocionan
if($subtipo_original=='csv_pro')
{
	$solicitudes=$list->getMatriculas($id_centro,$tiposol,$fase_sorteo,$modo); 
	
	$log_gencsvs->warning("DATOS CENTROS PARA CSV: ");
	$log_gencsvs->warning(print_r($solicitudes,true));
}
//si es para datos de matricula
if($subtipo_original=='csv_mat')
{
	$solicitudes=$list->getResumenVacantesGuarderia($rol='centro',$id_centro); 
	$log_gencsvs->warning("DATOS GUARDERIAS PARA CSV: ");
	$log_gencsvs->warning(print_r($solicitudes,true));
}
//si es para datos solicitudes
if($subtipo_original=='csv_dup' or $subtipo_original=='csv_sol')
{
   $solicitudes=$list->getSolicitudes($id_centro,$tipo,$fase_sorteo,$modo,$subtipo,$provincia,$estado_convocatoria); 
	$log_gencsvs->warning("DATOS GUARDERIAS PARA CSV LISTADO SOLICITUDES: ");
	$log_gencsvs->warning(print_r($solicitudes,true));
}
//si es para datos de tributantes
if($subtipo_original=='csv_tri')
{
   $tributantes=$list->getSolicitudes($id_centro,0,0,'csv','tri',$provincia,3); 
	$log_gencsvs->warning("DATOS CSSVS TRIBUTANTES GUARDERIAS: ");
	$log_gencsvs->warning(print_r($tributantes,true));
   $solicitudes=$tributantes;
$fcsv=$list->genCsv($tributantes,$id_centro,$subtipo_original,$$cabecera,$$camposdatos,DIR_CSVS);
}
else
   $fcsv=$list->genCsv($solicitudes,$id_centro,$subtipo_original,$$cabecera,$$camposdatos,DIR_CSVS);

$log_gencsvs->warning("SOLICITUDES  CSV GENERADAS ");
//$log_gencsvs->warning("EN: ".DIR_CSVS);
$log_gencsvs->warning("EN: ".DIR_CSVS_WEB."FICHERO: $fcsv");

if($fcsv) 
{
$csvfile=DIR_CSVS_WEB.$fcsv;
print($csvfile);
}
else print("error generando csv");
?>
