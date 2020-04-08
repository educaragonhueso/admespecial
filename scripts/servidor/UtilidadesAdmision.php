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
 	public function setVacantesCentroFase2($idc,$v,$t){

		$sql="UPDATE centros set vacantes_$t=$v where id_centro=$idc";
		if(!$this->con->query($sql)) return $this->con->error;
		else return 1;

	}
 	public function setAlumnoCentroFase2($ida,$idc,$nc){
		$sql="UPDATE alumnos_fase2 set id_centro_definitivo=$idc,centro_definitivo='$nc' where id_alumno=$ida";
		if(!$this->con->query($sql)) return $this->con->error;
		else return 1;
	}
 	public function asignarVacantesCentros($centros_fase2=array(),$alumnos_fase2=array())
	{
		if(sizeof($centros_fase2)==0 or sizeof($alumnos_fase2)==0) return -1;
		$this->log_fase2->warning("ASIGNANDO VACANTES FASE2");

		//empezamos con las ebo
		foreach($centros_fase2 as $centro)
			{			
			$this->centro->setId($centro['id_centro']);
			$this->centro->setNombre();

			$nombrecentro=$this->centro->getNombre();
			if(!$nombrecentro) return "NO HAY NOMBRE DE CENTRO";

			$vebo=$this->centro->getVacantesFase2(1,'ebo');
			$vasignadaebo=1;
			$this->log_fase2->warning("ENTRANDO CENTRO $nombrecentro FASE2 EBO, plazas: $vebo");
			print("ENTRANDO CENTRO $nombrecentro, idcentor ".$centro['id_centro']." FASE2 EBO, plazas: $vebo".PHP_EOL);
			$vasignadaebo=1;
			while($vebo>0 and $vasignadaebo==1)
				{
				$vasignadaebo=0;
				//revisar cada alumno (hay q considerar el orden de elección del alumno, el sorteo etc.) y si ha solicitado plaza en primera opción
				foreach($alumnos_fase2 as $alumno)
					{
					print("ALUMNO: $alumno->id_centro".PHP_EOL);	
					if($alumno->centro_definitivo!='nocentro' || $alumno->tipoestudios!='ebo') continue;
					if($alumno->id_centro==$centro['id_centro'])
					{ 
						$this->setAlumnoCentroFase2($alumno->id_alumno,$centro['id_centro'],$nombrecentro);
						$asignadaebo=1;
						$vebo--;
						print(PHP_EOL."coincidencia alumno: $alumno->id_alumno. Centro: $nombrecentro".PHP_EOL);
						$this->log_fase2->warning("ENTREGADA PLAZA DEL CENTRO $nombrecentro A: $alumno->id_alumno");
					}
					if($vebo==0)
						{ 
						if($this->setVacantesCentroFase2($centro['id_centro'],$vebo,'ebo')!=1) return 0;
						print(PHP_EOL."Terminado centro: $nombrecentro".PHP_EOL);
						break;
						}
					}
				
				}
			if($this->setVacantesCentroFase2($centro['id_centro'],$vebo,'ebo')!=1) return 0;
			}
		print("FIN asignaciones EBO".PHP_EOL);
		//seguimos con las tva
		foreach($centros_fase2 as $centro)
			{			
			$this->centro->setId($centro['id_centro']);
			$this->centro->setNombre();

			$nombrecentro=$this->centro->getNombre();
			if(!$nombrecentro) return "NO HAY NOMBRE DE CENTRO";

			$vtva=$this->centro->getVacantesFase2(1,'tva');
			$vasignadatva=1;
			$this->log_fase2->warning("ENTRANDO CENTRO $nombrecentro FASE2 EBO, plazas: $vtva");
			print("ENTRANDO CENTRO $nombrecentro, idcentor ".$centro['id_centro']." FASE2 TVA, plazas: $vtva".PHP_EOL);
			$vasignadaebo=1;
			while($vtva>0 and $vasignadatva==1)
				{
				$vasignadatva=0;
				//revisar cada alumno (hay q considerar el orden de elección del alumno, el sorteo etc.) y si ha solicitado plaza en primera opción
				foreach($alumnos_fase2 as $alumno)
					{
					print("ALUMNO: $alumno->id_centro".PHP_EOL);	
					if($alumno->centro_definitivo!='nocentro' || $alumno->tipoestudios!='tva') continue;
					if($alumno->id_centro==$centro['id_centro'])
					{ 
						$this->setAlumnoCentroFase2($alumno->id_alumno,$centro['id_centro'],$nombrecentro);
						$asignadatva=1;
						$vtva--;
						print(PHP_EOL."coincidencia alumno: $alumno->id_alumno. Centro: $nombrecentro".PHP_EOL);
						$this->log_fase2->warning("ENTREGADA PLAZA DEL CENTRO $nombrecentro A: $alumno->id_alumno");
					}
					if($vtva==0)
						{ 
						if($this->setVacantesCentroFase2($centro['id_centro'],$vtva,'tva')!=1) return 0;
						print(PHP_EOL."Terminado centro: $nombrecentro".PHP_EOL);
						break;
						}
					}
				
				}
			if($this->setVacantesCentroFase2($centro['id_centro'],$vtva,'tva')!=1) return 0;
			}
		print("FIN asignaciones TVA".PHP_EOL);
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
		if($tipo=='definitivo') $tabla_origen='alumnos_provisional';
		elseif($tipo=='provisional') $tabla_origen='alumnos';
		else return 0;
		//copiamos registros de centros que todavía no han realizado el sorteo o q están en fase menos q 2
		$tabla_destino="alumnos_".$tipo;
		if($tipo=='provisional')
			$sql="INSERT IGNORE INTO $tabla_destino SELECT a.* from $tabla_origen a, centros c WHERE a.id_centro_destino=c.id_Centro and c.fase_Sorteo<'2'";
		else
			$sql="INSERT IGNORE INTO $tabla_destino SELECT a.* from $tabla_origen a";
		print($sql);if($this->con->query($sql)) return 1;
		else return $this->con->error;

	}
  public function copiaTablaFase2($tipo,$centro=0)
	{
		$tabla="alumnos_".$tipo;
		$sql='DELETE from '.$tabla;
		
		$res=$this->con->query($sql);
		if(!$res) return $this->con->error;
		

		$sqlfase2="	SELECT  t1.*,t2.centro1,t2.id_centro1,t3.centro2,t3.id_centro2,t4.centro3,t4.id_centro3,t5.centro4,t5.id_centro4,t6.centro5,t6.id_centro5,t7.centro6,t7.id_centro6, 'nocentro ' as centro_definitivo, '0' as id_centro_definitivo FROM 
	(SELECT a.id_alumno, a.nombre, a.apellido1, a.apellido2,a.calle_dfamiliar,c.nombre_centro,a.tipoestudios,a.fase_solicitud,a.estado_solicitud,a.transporte,a.nordensorteo,a.nasignado as nasignado,b.puntos_validados,a.id_centro_destino as id_centro FROM alumnos a left join baremo b on b.id_alumno=a.id_alumno 
	left join centros c on a.id_centro_destino=c.id_centro  order by c.id_centro desc, a.tipoestudios asc,a.transporte desc, b.puntos_validados desc)
	as t1 
	join 
	(SELECT a.id_alumno,c.id_centro as id_centro1, c.nombre_centro as centro1 from alumnos a, centros c where c.id_centro=a.id_centro_destino1) 
	as t2 on t1.id_alumno=t2.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro2, c.nombre_centro as centro2 from alumnos a, centros c where c.id_centro=a.id_centro_destino2) 
	as t3 on t1.id_alumno=t3.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro3, c.nombre_centro as centro3 from alumnos a, centros c where c.id_centro=a.id_centro_destino3) 
	as t4 on t1.id_alumno=t4.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro4, c.nombre_centro as centro4 from alumnos a, centros c where c.id_centro=a.id_centro_destino4) 
	as t5 on t1.id_alumno=t5.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro5, c.nombre_centro as centro5 from alumnos a, centros c where c.id_centro=a.id_centro_destino5) 
	as t6 on t1.id_alumno=t6.id_alumno
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro6, c.nombre_centro as centro6 from alumnos a, centros c where c.id_centro=a.id_centro_destino6) 
	as t7 on t1.id_alumno=t7.id_alumno
";
		//$sqlfase2=" SELECT  t1.*,t2.centro1,t2.id_centro1 FROM (SELECT a.id_alumno id_alumno,a.nombre,a.apellido1,a.apellido2,a.calle_dfamiliar,c.nombre_centro,a.tipoestudios,a.fase_solicitud,a.estado_solicitud,a.transporte,a.nordensorteo,a.nasignado as nasignado,b.puntos_validados,a.id_centro_destino as id_centro FROM alumnos a left join baremo b on b.id_alumno=a.id_alumno left join centros c on a.id_centro_destino=c.id_centro  order by c.id_centro desc, a.tipoestudios asc,a.transporte desc, b.puntos_validados desc)  as t1 join (SELECT a.id_alumno,c.id_centro as id_centro1, c.nombre_centro as centro1 from alumnos a, centros c where c.id_centro=a.id_centro_destino1) as t2 on t1.id_alumno=t2.id_alumno";
		$sql='INSERT IGNORE INTO '.$tabla.' '.$sqlfase2;
		print(PHP_EOL.$sql.PHP_EOL);
		if($this->con->query($sql)) return 1;
		else return $this->con->error;

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
  public function getCentrosIds()
	{
	$ares=array();
	$sql="SELECT id_centro FROM centros where fase_sorteo<2";
	$res=$this->con->query($sql);
	if(!$res) return $this->con->error;
	while($row=$res->fetch_row())
		$ares[]=$row;
	return  $ares;
	} 
 
}
?>
