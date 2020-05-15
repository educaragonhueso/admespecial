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
require_once DIR_BASE.'models/Solicitud.php';

########################################################################################
$log_sorteo=new logWriter('log_sorteo',DIR_LOGS);
########################################################################################
//VARIABLES
$menu_provisionales=''; //añadirlo si se ha realizado el sorteo
$dia_sorteo=0;
$modo='presorteo';
$id_centro=$_POST['id_centro'];
$estado_convocatoria=$_POST['estado_convocatoria'];

$hoy = date("Y/m/d");
$list=new ListadosController('alumnos');
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,1,'ajax');
$tsolicitud=new Solicitud($conexion);
$fase_sorteo=$tcentro->getFaseSorteo();// FASE0: no realizado, 1, dia sorteo pero asignaciones no realizadas, 2 numero asignado, 3 sorteo realizado
$nsolicitudes=$tcentro->getNumSolicitudes($id_centro,$fase_sorteo);
$ccentros=new CentrosController(0,$conexion);

//Para el caso de acceso del administrador o servicios provinciales
if($_POST['rol']=='admin' or $_POST['rol']=='sp')
{
	//si se ha pulsado en el boton de asignar numero de sorteo
	if(isset($_POST['asignar'])) 
	{
		########################################################################################
		$log_sorteo->warning("NUMERO DE SORTEO ASIGNADO");
		########################################################################################
		if($list->asignarNumSol($id_centro)!=1){ print("Error asignando numero para el sorteo");exit();}
		//actualizamos el centro para marcar la fase del sorteo
		$tcentro->setFaseSorteo(2);

		print("ASIGNACION REALIZADA");
	}
	//si se ha enviado el numero de sorteo
	if(isset($_POST['nsorteo']))
	{
		########################################################################################
		$log_sorteo->warning("REALIZANDO SORTEO");
		########################################################################################
		$modo='sorteo';
		$nsorteo=$_POST['nsorteo'];
		//Actualizamos el numero de sorteo para el centro
		if($tcentro->setSorteo($nsorteo,1)==0) {print("ERROR SORTEO"); exit();}
		
		$dsorteo=$tcentro->getVacantes('admin','');
		$vacantes_ebo=$dsorteo[0]->vacantes;
		$vacantes_tva=$dsorteo[1]->vacantes;
		
		//asignamos numero de orden a las solicitudes segun el numero de sorteo	
		if($tsolicitud->setNordenSorteo($id_centro,$nsorteo,$nsolicitudes,$vacantes_ebo,$vacantes_tva)==0) 
			print("NO HAY VACANTES<br>");
		$tcentro->setFaseSorteo(3);

		//para cada centro calculamos solicitudes admitidas
		//Si hemos llegado al dia d elas provisionales o posterior, generamos la tabla de soliciutdes para los listados provisionales
		$acentros=array();
		$centros=$ccentros->getAllCentros('todas','especial');
		$ccentros=new CentrosController(0,$conexion);
		while($row = $centros->fetch_assoc()) { $acentros[]=$row;}
		
		foreach($acentros as $dcentro)
		{
			$id_centro=$dcentro['id_centro'];
			########################################################################################
			$log_sorteo->warning("INICIANDO GESTION CENTRO");
			########################################################################################
			$centrotmp=new Centro($conexion,$dcentro['id_centro'],'no',0);
			$centrotmp->setId($dcentro['id_centro']);
			$centrotmp->setNombre();
			$id_centro=$dcentro['id_centro'];
			$nsolicitudescentro=$centrotmp->getNumSolicitudes($dcentro['id_centro'],1);
			if($nsolicitudescentro==0) continue;
			$nombrecentro=$centrotmp->getNombre();
			$log_sorteo->warning("NOMBRE: ".$nombrecentro.PHP_EOL);
			$log_sorteo->warning("FASE: ".$centrotmp->getFaseSorteo().PHP_EOL);
			$log_sorteo->warning("NSOLICITUDES: ".$nsolicitudescentro.PHP_EOL);
			$log_sorteo->warning("ENTRANDO SORTEO TABLA CENTRO: $nombrecentro");
		
			if($centrotmp->setSorteo($nsorteo,$id_centro)==0) {print("ERROR SORTEO"); exit();}
			if(!$centrotmp->setFaseSorteo(3))
			{

			 $log_sorteo->warning("ERROR ACT FASE: $nombrecentro");
			 return 0;
			}
			$dsorteo=$centrotmp->getVacantes('centro');
			$vacantes_ebo=$dsorteo[0]->vacantes;
			$vacantes_tva=$dsorteo[1]->vacantes;
			if($tsolicitud->setSolicitudesSorteo($id_centro,$nsolicitudescentro,$vacantes_ebo,$vacantes_tva)==0) 
				print("NO HAY VACANTES<br>");
		}	
		//copiamos todos los datos a tabla de provisionales	
		$ct=$tsolicitud->copiaTablaCentro(1,'alumnos_provisional_final');	
		$log_sorteo->warning("RESULTADO COPIAR TABLA $ct ");
	}
}
else//accedemos como centro
{
print("NO ES UN USUARIO CON PERMISOS");
}


?>
