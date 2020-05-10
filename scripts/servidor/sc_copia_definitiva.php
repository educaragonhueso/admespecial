<?php
require_once "../../config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/Conectar.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'models/Centro.php';
require_once DIR_BASE.'models/Solicitud.php';
require_once 'UtilidadesAdmision.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'controllers/ListadosController.php';

$log_provisional_fase2=new logWriter('log_provisional_fase2',DIR_LOGS);

$tipo='definitiva';

$list=new ListadosController('alumnos');
$conexion=$list->adapter;
$ccentros=new CentrosController(0,$conexion);
//$centro=new Centro($ccentros->conectar->conexion(),'','no',0);
$centro=new Centro($conexion,'','no',0);
//$utils=new UtilidadesAdmision($ccentros->conectar->conexion(),$ccentros,$centro);
$utils=new UtilidadesAdmision($conexion,$ccentros,$centro);
//$tsolicitud=new Solicitud($ccentros->conectar->conexion());
$tsolicitud=new Solicitud($conexion);

########################################################################################
########################################################################################
//Si hemos llegado al dia d elas provisionales o posterior, generamos la tabla de soliciutdes para los listados provisionales
$acentros=array();
echo PHP_EOL."Iniciando Copia tabla solicitudes definitiva a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
$centros=$ccentros->getAllCentros();
		while($row = $centros->fetch_assoc()) { $acentros[]=$row;}
		foreach($acentros as $dcentro)
		{
		$id_centrotmp=$dcentro['id_centro'];
		$centrotmp=new Centro($conexion,$dcentro['id_centro'],'no',0);
		$centrotmp->setId($dcentro['id_centro']);
		$centrotmp->setNombre();
		print(PHP_EOL."CENTRO: ".$dcentro['id_centro'].PHP_EOL);
		$nsolicitudescentro=$centrotmp->getNumSolicitudes($dcentro['id_centro'],1);
		if($nsolicitudescentro==0) continue;
		$nombrecentro=$centrotmp->getNombre();
		print("NOMBRE: ".$centrotmp->getNombre().PHP_EOL);
		print("FASE: ".$centrotmp->getFaseSorteo().PHP_EOL);
		print("NSOLICITUDES: ".$nsolicitudescentro.PHP_EOL);
		
		//$nsorteo=$centrotmp->getNumeroSorteo();
		$dsorteo=$centrotmp->getVacantes('centro');
		$vacantes_ebo=$dsorteo[0]->vacantes;
		$vacantes_tva=$dsorteo[1]->vacantes;
		if($tsolicitud->setSolicitudesSorteo($id_centrotmp,$nsolicitudescentro,$vacantes_ebo,$vacantes_tva)==0) 
		//if($list->actualizaSolicitudesSorteo($id_centro,$nsorteo,$nsolicitudes,$vacantes_ebo,$vacantes_tva)==0) 
			print("NO HAY VACANTES<br>");
		}
		$ct=$tsolicitud->copiaTablaCentro(1,'alumnos_definitiva_final');	
echo PHP_EOL."Copia tabla solicitudes definitiva. Realizada corectamente a las ".date('H:m')." del dia ".date('d-M-Y').PHP_EOL;	
?>
