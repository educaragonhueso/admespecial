<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'scripts/informes/pdf/fpdf/classpdf.php';

######################################################################################
$log_listados_definitivos=new logWriter('log_listados_definitivos',DIR_LOGS);
$log_listados_definitivos->warning("OBTENIENDO DATOS DEFINITIVOS POST:");
$log_listados_definitivos->warning(print_r($_POST,true));
######################################################################################
//VARIABLES
$dir_pdf=DIR_BASE.'/scripts/datossalida/pdflistados/definitivos/';
$id_centro=$_POST['id_centro'];
$estado_convocatoria=$_POST['estado_convocatoria'];
$subtipo_listado=$_POST['subtipo'];//dentro de cada tipo, el subtipo de listado
$filtro_datos='<input type="text" class="form-control" id="filtrosol"  placeholder="Introduce datos del alumno"><small id="emailHelp" class="form-text text-muted"></small>';
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,$_POST['id_centro'],'ajax');
$solicitud=new Solicitud($conexion);
$ccentros=new CentrosController(0,$conexion);
$tcentro->setNombre();
$tsolicitud=new Solicitud($conexion);
$dvacantes=$tcentro->getVacantes($id_centro);
$fase_sorteo=$tcentro->getFaseSorteo();
$vacantes_ebo=$dvacantes[0]->vacantes;
$vacantes_tva=$dvacantes[1]->vacantes;

$log_listados_definitivos->warning("ACTUALIZANDO DEFINITIVOS, DATOS:  ESTADO
CENTRO/IDCENTRO $fase_sorteo/$estado_convocatoria");
//La convocatoria esta en definitivo según el dia programado
//si la convocatoria esta en definitivo, entramos una vez para copiar la tabla con los datos del centro
//si estamos en el periodo de provisionales actualizamos tablas de definitivos
if($estado_convocatoria>=30 and $estado_convocatoria<40)
{
	if($_POST['rol']=='centro')
	{
      $nsolicitudes=$tcentro->getNumSolicitudes($id_centro);
      $nsorteo=$tcentro->getNumeroSorteo();
      $dsorteo=$tcentro->getVacantes('centro');
      $vacantes_ebo=$dsorteo[0]->vacantes;
      $vacantes_tva=$dsorteo[1]->vacantes;
      $log_listados_definitivos->warning("ACTUALIZANDO DATOS:
NSOLICITUDES/IDCENTRO/ESTADO CENTRO $nsorteo/$id_centro/$fase_Sorteo");

      //if($list->actualizaSolicitudesSorteo($id_centro,$nsorteo,$nsolicitudes,$vacantes_ebo,$vacantes_tva,2)==0) 
      if($tsolicitud->setSolicitudesSorteo($id_centro,$nsolicitudes,$vacantes_ebo,$vacantes_tva)==0) 
            print("NO HAY VACANTES<br>");
      $ct=$tsolicitud->copiaTablaCentro($id_centro,'alumnos_definitiva_final');	
      ########################################################################################
      $log_listados_definitivos->warning("ACTUALIZADA TABLA DEFINITIVOS $ct ROL
   CENTRO");
      ########################################################################################
   }
	elseif($_POST['rol']=='admin' or $_POST['rol']=='sp')
	{
      if($tsolicitud->desmarcarValidados(1)==0)
         print("NO HAY VALIDADOS<br>");
		//para cada centro calculamos solicitudes admitidas
		//Si hemos llegado al dia d elas provisionales o posterior, generamos la tabla de soliciutdes para los listados provisionales
		$acentros=array();
		$centros=$ccentros->getAllCentros();
		while($row = $centros->fetch_assoc()) { $acentros[]=$row;}
		
		foreach($acentros as $dcentro)
		{
			$id_centrotmp=$dcentro['id_centro'];
			########################################################################################
			$log_listados_definitivos->warning("INICIANDO GESTION CENTRO");
			########################################################################################
			$centrotmp=new Centro($conexion,$dcentro['id_centro'],'no',0);
			$centrotmp->setId($dcentro['id_centro']);
			$centrotmp->setNombre();
			$nsolicitudescentro=$centrotmp->getNumSolicitudes($dcentro['id_centro'],1);
			if($nsolicitudescentro==0) continue;
			$nombrecentro=$centrotmp->getNombre();
			$log_listados_definitivos->warning("NOMBRE: ".$nombrecentro.PHP_EOL);
			$log_listados_definitivos->warning("FASE: ".$centrotmp->getFaseSorteo().PHP_EOL);
			$log_listados_definitivos->warning("NSOLICITUDES: ".$nsolicitudescentro.PHP_EOL);
			$log_listados_definitivos->warning("ENTRANDO SORTEO TABLA CENTRO: $nombrecentro");
		
			$dsorteo=$centrotmp->getVacantes('centro');
			$vacantes_ebo=$dsorteo[0]->vacantes;
			$vacantes_tva=$dsorteo[1]->vacantes;
			if($tsolicitud->setSolicitudesSorteo($id_centrotmp,$nsolicitudescentro,$vacantes_ebo,$vacantes_tva)==0) 
				print("NO HAY VACANTES<br>");
		}
		//copiamos todos los datos a tabla de provisionales	
		$ct=$tsolicitud->copiaTablaCentro(1,'alumnos_definitiva_final');	
   }
}

$cabecera="campos_cabecera_".$subtipo_listado;
$camposdatos="campos_bbdd_".$subtipo_listado;

######################################################################################
$log_listados_definitivos->warning("OBTENIENDO LISTADOS DEFINITIVOS, CENTRO: ".$id_centro);
######################################################################################

//actualizamos solicitudes para tener en cuenta las que hayan cambiado
//Esto solo puede hacerse en el momento q finalice el plazo de provisionales!!!!!!!!
//$solicitudes=$solicitud->genSolDefinitivas($id_centro,$vacantes_ebo,$vacantes_tva,2); 
//mostramos las solitudes completas sin incluir borrador
$solicitudes=$list->getSolicitudes($id_centro,2,$fase_sorteo=0,$modo='definitivos',$subtipo_listado,'estado',$estado_convocatoria); 

######################################################################################
$log_listados_definitivos->warning("OBTENIENDO SOLICITUDES GENERALES, DATOS: ");
$log_listados_definitivos->warning(print_r($solicitudes,true));
######################################################################################

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
	$pdf->AddPage();
	$pdf->Output(DIR_PROV.$subtipo_listado.'.pdf','F');
}

if($subtipo_listado=='admitidos_def') $subtipo='ADMITIDOS DEFINITIVO';
if($subtipo_listado=='noadmitidos_def') $subtipo='NO ADMITIDOS DEFINITIVO';
if($subtipo_listado=='excluidos_def') $subtipo='EXCLUIDOS DEFINITIVO';

print("<button type='button' class='btn btn-info' onclick='window.open(\"".DIR_PROV_WEB.$subtipo_listado.".pdf\",\"_blank\");'>Descarga listado</button>");
print($list->showFiltrosTipo());
print($filtro_datos);
print("<div style='text-align:center'><h1>LISTADO ".strtoupper($tipo_listado)." ".strtoupper($subtipo)."</h1></div>");
print($list->showListado($solicitudes,$_POST['rol'],$$cabecera,$$camposdatos,$provisional=1));

?>
