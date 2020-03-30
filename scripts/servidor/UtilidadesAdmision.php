<?php
class UtilidadesAdmision{
    private $con;
     
    public function __construct($adapter='',$centros_controller='',$centro='') 
		{
		$this->con=$adapter;	
		$this->centros=$centros_controller;	
		$this->centro=$centro;	
		require_once DIR_CLASES.'LOGGER.php';
		require_once DIR_APP.'parametros.php';
			
		$this->log_fase2=new logWriter('log_fase2',DIR_LOGS);
		$this->log_sorteo_fase2=new logWriter('log_sorteo_fase2',DIR_LOGS);
    		}
  public function asignarNumSorteoFase2(){
		$this->log_sorteo_fase2->warning("ASIGNANDO NUMERO SORTEO");
		$sql="SET @r := 0";
		$this->con->query($sql);
		//ponemos todas a cero para evitar inconsistencias
		$sql1="UPDATE  alumnos_fase2 SET nasignado =0";
		$sql2="UPDATE  alumnos_fase2 SET nasignado = (@r := @r + 1) ORDER BY  RAND()";
		$this->log_sorteo_fase2->warning($sql1);
		$this->log_sorteo_fase2->warning($sql2);
		if($this->con->query($sql1) and $this->con->query($sql2))
		{
			$this->log_sorteo_fase2->warning("OK ASIGNANDO NUM SORTEO EN FASE2");
			return 1;
		}
		else{ 
			$this->log_sorteo_fase2->warning("ERROR ASIGNANDO NUM SORTEO FASE2: ");
			$this->log_sorteo_fase2->warning($sql1);
			$this->log_sorteo_fase2->warning($sql2);
			$this->log_sorteo_fase2->warning($this->adapter->error);
			return 0;
		}
		return 0;
	}
	public function actualizarSolSorteoFase2($c=1,$numero=0,$solicitudes=0) 
	{
		$resultSet=array();
		
		$sql1="UPDATE alumnos_fase2 a set nordensorteo=$solicitudes+nasignado-$numero+1 where nasignado<$numero";
		$sql2="UPDATE alumnos_fase2 a set nordensorteo=nasignado-$numero+1 where nasignado>=$numero";

		$this->log_sorteo_fase2->warning("ASIGNANDO NUMERO DESPUES DE SORTEO $sql1 -- $sql2");
		if(!$this->con->query($sql1) or !$this->con->query($sql2)) return $this->con->error;
		else return 1;
	}
 	public function setFase2Sorteo($f){return 1;}
 	public function asignarVacantesCentros($centros_fase2=array(),$alumnos_fase2=array())
	{
		if(sizeof($centros_fase2)==0 or sizeof($alumnos_fase2)==0) return -1;
		$this->log_fase2->warning("ASIGNANDO VACANTES FASE2");
		return 1;

		foreach($centros_fase2 as $centro)
			{			
			//empezamos con las ebo
			$this->centro->setId($centro['id_centro']);
			$vebo=$centro->getvacantes_fase2('ebo');
			$vasignadaebo=1;
			while($vebo>0 and $vasignadaebo==1)
				{
				$vasignadaebo=0;
				//revisar cada alumno (hay q considerar el orden de elección del alumno, el sorteo etc.) y si ha solicitado plaza en primera opción
				foreach($alumnos_fase2 as $alumno)
					if($alumno['id_centro1']==$centro['id_centro'])
					{ 
						$this->setCentroFase2($alumno['id_alumno'],$centro['idcentro']);
						$asignadaebo=1;
						$vebo--;
					}
				
				}
			}
		$centros=$this->centros->getAllCentros();
		while($row = $centros->fetch_assoc()) { $acentros[]=$row;}
		foreach($acentros as $centro)
		{
			$this->centro->setId($centro['id_centro']);
			$vacantes=$this->centro->getVacantes();
			$sql="UPDATE centros set vacantes_ebo=".$vacantes[0]->vacantes.",vacantes_tva=".$vacantes[1]->vacantes." where id_centro=".$centro['id_centro'];
			if(!$this->con->query($sql)) return $this->con->error;
		}
	return 1;
	}
  public function actualizaVacantesCentros($centro=0)
	{
		$acentros=array();
		$centros=$this->centros->getAllCentros();
		while($row = $centros->fetch_assoc()) { $acentros[]=$row;}
		foreach($acentros as $centro)
		{
			$this->centro->setId($centro['id_centro']);
			$vacantes=$this->centro->getVacantes();
			$sql="UPDATE centros set vacantes_ebo=".$vacantes[0]->vacantes.",vacantes_tva=".$vacantes[1]->vacantes." where id_centro=".$centro['id_centro'];
			if(!$this->con->query($sql)) return $this->con->error;
		}
	return 1;
	}
  public function copiaTabla($tipo,$centro=0)
	{
		$tabla="alumnos_".$tipo;
		$sql='DELETE from '.$tabla;
		print($sql);
		if($this->con->query($sql)==0) return 0;

		$sql='INSERT IGNORE INTO '.$tabla.' SELECT * from alumnos';
		if($this->con->query($sql)) return 1;
		else return 0;

	}
  public function copiaTablaFase2($tipo,$centro=0)
	{
		$tabla="alumnos_".$tipo;
		$sql='DELETE from '.$tabla;
		if(!$this->con->query($sql)) return 0;
		$sqlfase2=" SELECT  t1.*,t2.centro1,t2.id_centro1 FROM (SELECT a.id_alumno id_alumno,a.nombre,a.apellido1,a.apellido2,a.calle_dfamiliar,c.nombre_centro,a.tipoestudios,a.fase_solicitud,a.estado_solicitud,a.transporte,a.nordensorteo,a.nasignado as nasignado,b.puntos_validados,a.id_centro_destino as id_centro FROM alumnos a left join baremo b on b.id_alumno=a.id_alumno left join centros c on a.id_centro_destino=c.id_centro  order by c.id_centro desc, a.tipoestudios asc,a.transporte desc, b.puntos_validados desc)  as t1 join (SELECT a.id_alumno,c.id_centro as id_centro1, c.nombre_centro as centro1 from alumnos a, centros c where c.id_centro=a.id_centro_destino1) as t2 on t1.id_alumno=t2.id_alumno";
		$sql='INSERT IGNORE INTO '.$tabla.' '.$sqlfase2;
		print($sql);
		if($this->con->query($sql)) return 1;
		else return 0;

	}
  public function compruebaReservas($centro=0)
	{
//si alguien reserva una plaza se supone q el centro ha marcado q continua asi q no genera vacante
//si alguien reserva laza incorrectamente debe anularse esa reserva y anotarse en un fichero asi como en la base de datos, añadiendo un campo llamado reserva incorrecta
//en el formulario de fase 2 deberá aparecer si tiene o no reserva y esta es correcta 
	}
  public function copiaTablaProvisionales($centro=0)
	{
		$sql_provisionales='DELETE from alumnos_provisional';
		if($this->con->query($sql_provisionales)==0) return 0;

		$sql_provisionales='INSERT IGNORE INTO alumnos_provisional SELECT * from alumnos';
		if($this->con->query($sql_provisionales)) return 1;
		else return 0;

	}
 
 
}
?>
