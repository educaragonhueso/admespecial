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
$log_listados_solicitudes_fase2=new logWriter('log_listados_solicitudes_fase2',DIR_LOGS);
$log_listados_solicitudes_fase2->warning("OBTENIENDO DATOS SOLICITUDES FASE II:");
$log_listados_solicitudes_fase2->warning(print_r($_POST,true));
######################################################################################
//VARIABLES
$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/fase2/';
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

if($utils->checkSorteoFase2()==0) $sorteo=0;
else $sorteo=1;


if($_POST['asignar']=='1')
	{
	if($utils->asignarNumSorteoFase2(1)!=1){ print("Error asignando numero para el sorteo");exit();}
	if($utils->copiaTablaTmpFase2()!=1){ print("Error copiandko tabla tmp");exit();}
	//$subtipo_listado="lfase2_sol";//si es para el sorteo el subtipo es lfase2_sol
	}
//si se ha pulsado el boton de realizar sorteo
if($_POST['asignar']=='2')
	{
	if($utils->actualizarSolSorteoFase2(1,$nsorteo,$nsolicitudes)!=1){ print("Error realizando el sorteo");exit();}
	if($utils->copiaTablaTmpFase2()!=1){ print("Error copiandko tabla tmp");exit();}
	}
$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;

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
$boton_asignar_automatica='<div id="form_asignarfase2" class="input-group mb-3"
style="margin-top:5px">
				<div class="input-group-append">
				<button class="btn btn-success" type="submit" id="boton_asignar_plazas_fase2" data-subtipo="'.$subtipo_listado.'">Asignar Vacantes</button>
				</div>
		          </div>';

$boton_descarga="<button type='button' class='btn btn-info' onclick='window.open(\"".DIR_SOR_WEB.$subtipo_listado.".pdf\",\"_blank\");'>Descarga listado</button>";
//mostramos las solitudes completas sin incluir borrador
$solicitudes=$list->getSolicitudes(1,0,0,$modo='fase2',$subtipo_listado,'todas',3); 
######################################################################################
$log_listados_solicitudes_fase2->warning("OBTENIDAS $nsolicitudes SOLICITUDES FASE II:");
######################################################################################
//Si es el listado normal, no hay sorteo

if($_POST['pdf']==1 and $subtipo_listado=='lfase2_sol_sor')
{
	$datos=array();
	$i=0;
	//extraemos los campos de datos q nos interesan
	foreach($solicitudes as $sol)
	{
		$datos[$i] = new stdClass;
		foreach($$camposdatos as $d)
		{
			$datos[$i]->$d=$sol->$d;
		}
	$i++;
	}
	$pdf = new PDF();
	$cab=$$cabecera;
	$pdf->SetFont('Helvetica','',8);
	$pdf->AddPage('L','',0,$nombre_listado);
	$pdf->BasicTable($cab,$datos,0,30,$formato);
	$pdf->Ln(20);
	 // Arial italic 8
	$pdf->SetFont('Arial','I',8);
	  // Page number
	$pdf->Cell(40,10,'SELLO CENTRO',1,0,'C');
	$pdf->Cell(140,10,'En ______________________ a ____de________ de 2020',0,0,'C');
	$pdf->Cell(0,10,'Firmado:',0,0);
	$pdf->Ln();
	$pdf->Cell(220,10,'El Director/a',0,0,'R');
	$pdf->Output(DIR_SOR.$subtipo_listado.'.pdf','F');
}

if($_POST['asignar']==0)
	{
      if($sorteo==0)		print($form_sorteo_fase2); //mostramos formulario sorteo solo si no se ha hecho ya
		$tablaresumen=$tcentro->getResumenFase2($_POST['rol']);
		print($list->showTablaResumenFase2($tablaresumen,$ncol=1));
		#print($list->showFiltrosTipo());
		print($filtro_datos);
		print("<div id='listado_fase2' style='text-align:center'><h1>LISTADO LISTADO SOLICITUDES COMPLETO</h1></div>");
	}
if($subtipo_listado!='lfase2_sol_sor') print($boton_descarga.'<br>'); //
if($subtipo_listado!='lfase2_sol_sor') print($boton_asignar_automatica); //mostramos formulario sorteo solo si no se ha hecho ya
print($list->showListado($solicitudes,$_POST['rol'],$$cabecera,$$camposdatos,$provisional=1,$subtipo_listado));
print($script);
?>
