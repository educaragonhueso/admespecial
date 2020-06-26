<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/guarderias/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'scripts/informes/pdf/fpdf/classpdf.php';
require_once DIR_BASE.'scripts/servidor/UtilidadesAdmision.php';
require_once DIR_BASE.'models/Solicitud.php';

######################################################################################
$log_listados_definitivos=new logWriter('log_listados_definitivos',DIR_LOGS);
$log_listados_definitivos->warning("OBTENIENDO DATOS DEFINITIVOS POST:");
$log_listados_definitivos->warning(print_r($_POST,true));
######################################################################################
//VARIABLES
$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/definitivos/';
$id_centro=$_POST['id_centro'];
$estado_convocatoria=$_POST['estado_convocatoria'];
$tipo_listado='definitivos';
$subtipo_listado=$_POST['subtipo'];//dentro de cada tipo, el subtipo de listado
$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,$_POST['id_centro'],'ajax');
$tcentro->setNombre();
$tsolicitud=new Solicitud($conexion);
$ccentros=new CentrosController(0,$conexion);
$utils=new UtilidadesAdmision($conexion,$ccentros,$tcentro);

$nsolicitudes=$tcentro->getNumSolicitudes($id_centro);
$dsorteo=$tcentro->getVacantes($id_centro);
$vacantes_ebo=$dsorteo[0]->vacantes;
$vacantes_tva=$dsorteo[1]->vacantes;

$titulo_listado=strtoupper($tipo_listado)." ".strtoupper($subtipo_listado).$tcentro->getNombre();
//obtenemos estado de la convocatoria ara el centro
$fase_sorteo=$tcentro->getFase();
//OPERACIONES ACTUALIZACION SOLICITUDES SEGUN ESTADO CONVOCATORIA
//Si se ha realizado ya el sorteo en ese centro y aun no estamos en el estado de definitivos
$log_listados_definitivos->warning("INICIANDO DEFINITIVOS FASE:  $fase_sorteo");

if($fase_sorteo==5)
{
	if($_POST['rol']=='centro')
	{
		$nsolicitudes=$tcentro->getNumSolicitudes($id_centro);
		$dsorteo=$tcentro->getVacantesGuarderias('centro');
      $vuno=$dsorteo[0]->vuno;
      $vuno_acneae=$dsorteo[0]->vuno_acneae;
      $vdos=$dsorteo[0]->vdos;
      $vdos_acneae=$dsorteo[0]->vdos_acneae;
      $vtres=$dsorteo[0]->vtres;
      $vtres_acneae=$dsorteo[0]->vtres_acneae;
      $log_listados_definitivos->warning(print_r($dsorteo,true));
      if($tsolicitud->setSolicitudesSorteoGuarderias($id_centro,$nsolicitudescentro,$vuno,$vuno_acneae,$vdos,$vdos_acneae,$vtres,$vtres_acneae)==0) 
      {
         print("ERROR ESTABLECIENDO SOL ADMITIDAS<br>");
         exit();
      }
      $res=$utils->copiaTablaDefinitivos($id_centro);
	
	}
	elseif($_POST['rol']=='admin' or $_POST['rol']=='sp')
	{
		//para cada centro calculamos solicitudes admitidas
		//Si hemos llegado al dia d elas definitivos o posterior, generamos la tabla de soliciutdes para los listados definitivos
		$acentros=array();
		$centros=$ccentros->getAllCentros('todas','todas','guarderias');
		$ccentros=new CentrosController(0,$conexion);
		while($row = $centros->fetch_assoc()) { $acentros[]=$row;}
		
		foreach($acentros as $dcentro)
		{
			$id_centrotmp=$dcentro['id_centro'];
			########################################################################################
         $log_listados_definitivos->warning("INICIANDO CENTRO/FASE $id_centro - $fase_sorteo");
			########################################################################################
			$centrotmp=new Centro($conexion,$dcentro['id_centro'],'no',0);
			$centrotmp->setId($dcentro['id_centro']);
			$centrotmp->setNombre();
			$nsolicitudescentro=$centrotmp->getNumSolicitudes($dcentro['id_centro'],1);
			if($nsolicitudescentro==0) continue;
			$nombrecentro=$centrotmp->getNombre();
			
         $log_listados_definitivos->warning("NOMBRE: ".$nombrecentro.PHP_EOL);
			$log_listados_definitivos->warning("FASE: ".$centrotmp->getFase().PHP_EOL);
			$log_listados_definitivos->warning("NSOLICITUDES: ".$nsolicitudescentro.PHP_EOL);
			$log_listados_definitivos->warning("ENTRANDO SORTEO TABLA CENTRO: $nombrecentro");
		
			$dsorteo=$centrotmp->getVacantesGuarderias('centro');
      	$vuno=$dsorteo[0]->vuno;
			$vuno_acneae=$dsorteo[0]->vuno_acneae;
			$vdos=$dsorteo[0]->vdos;
			$vdos_acneae=$dsorteo[0]->vdos_acneae;
			$vtres=$dsorteo[0]->vtres;
			$vtres_acneae=$dsorteo[0]->vtres_acneae;
			$log_listados_definitivos->warning(print_r($dsorteo,true));
         if($tsolicitud->setSolicitudesSorteoGuarderias($id_centrotmp,$nsolicitudescentro,$vuno,$vuno_acneae,$vdos,$vdos_acneae,$vtres,$vtres_acneae)==0) 
		   {
      		print("ERROR ESTABLECIENDO SOL ADMITIDAS<br>");
            exit();
         }
		}
	   $log_listados_definitivos->warning("INICIANDO COPIA TABLA DEFINITIVOSSS");
		//copiamos todos los datos a tabla de definitivos	
      $res=$utils->copiaTablaDefinitivos();
		//$ct=$tsolicitud->copiaTablaCentro(1,'alumnos_provisional_final');	
	}	
########################################################################################
$log_listados_definitivos->warning("ACTUALIZADA TABLA DEFINITIVOS $ct");
########################################################################################
}
$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;
######################################################################################
$log_listados_definitivos->warning("OBTENIENDO SOLICITUDES DEFINITIVOS, CABECERA: ".$cabecera);
$log_listados_definitivos->warning("OBTENIENDO SOLICITUDES DEFINITIVOS, CENTRO:ESTADO ".$id_centro.":".$estado_centro);
$log_listados_definitivos->warning("OBTENIENDO SOLICITUDES DEFINITIVOS, ESTADO CONVOCATORIA/SUBTIPO:  ".$estado_convocatoria.'/'.$subtipo_listado);
######################################################################################

//mostramos las solitudes completas sin incluir borrador, ponemos fase a 4 para indicar despues del sorteo
$solicitudes=$list->getSolicitudes($id_centro,1,5,$modo='definitivos',$subtipo_listado,'todas',$estado_convocatoria); 

######################################################################################
$log_listados_definitivos->warning("OBTENIENDO SOLICITUDES DEFINITIVOS, DATOS: ");
$log_listados_definitivos->warning(print_r($solicitudes,true));
######################################################################################
//actualizamos las solicitudes por si hay cambios para tener en cuenta el sorteo previo
if($_POST['pdf']==1)
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
	$pdf->AddPage('L','',0,$titulo_listado);
	$pdf->BasicTable($cab,$datos,0,30,'definitivo');
	$pdf->Ln(20);
	$pdf->SetFont('Arial','I',8);
	  // Page number
	$pdf->Cell(30);
	$pdf->Cell(40,10,'SELLO CENTRO',1,0,'C');
	$pdf->Cell(140,10,'En ______________________ a ____de________ de 2020',0,0,'C');
	$pdf->Cell(0,10,'Firmado:',0,0);
	$pdf->Ln();
	$pdf->Cell(220,10,'El Director/a',0,0,'R');
	$pdf->Output(DIR_PROV.$subtipo_listado.'.pdf','F');
}

if($subtipo_listado=='admitidos_prov') $subtipo='ADMITIDOS PROVISIONAL';
if($subtipo_listado=='noadmitidos_prov') $subtipo='NO ADMITIDOS PROVISIONAL';
if($subtipo_listado=='excluidos_prov') $subtipo='EXCLUIDOS PROVISIONAL';

print("<button type='button' class='btn btn-info' onclick='window.open(\"".DIR_PROV_WEB.$subtipo_listado.".pdf\",\"_blank\");'>Descarga listado</button>");
/*
print("TITULO: ".$titulo_listado);
print("IDCENTRO: ".$id_centro);
print("NOMBRE CENTRO: ".str_replace(' ','',$tcentro->getNombre()));
*/
//print($list->showFiltrosTipo());
print($filtro_datos);
print("<div style='text-align:center'><h1>LISTADO ".$titulo_listado."</h1></div>");
print($list->showListado($solicitudes,$_POST['rol'],$$cabecera,$$camposdatos,$provisional=1));

?>
