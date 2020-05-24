<?php
class Centro extends EntidadBase{
    private $id_centro;
    private $id_usuario;
    private $localidad;
    private $provincia;
    private $nombre_centro;
    
    public function __construct($adapter,$id_centro='',$ajax='no',$estadocentro=0) 
		{
			$table="centros";
			$this->id_centro=$id_centro;
			$this->estadocentro=$estadocentro;
			$this->conexion=$adapter;
			if($ajax=='no') parent::__construct($adapter, $table);
			require_once DIR_CLASES.'LOGGER.php';
			require_once DIR_APP.'parametros.php';
			
			$this->log_sorteo=new logWriter('log_sorteo',DIR_LOGS);
			$this->log_matricula=new logWriter('log_matricula',DIR_LOGS);
			$this->log_fase2=new logWriter('log_fase2',DIR_LOGS);
    		}
    public function getIdNombre($n) {
	$query="select id_centro from centros where nombre_centro='".$n."' and clase_centro='especial' limit 1";
	$this->log_fase2->warning("CONSULTA IDCENTRO $query");
	
	$soldata=$this->conexion->query($query);
	if($soldata->num_rows==0) return 0;
	if($row = $soldata->fetch_object()) 
	{
	 $solSet=$row;
	return $solSet->id_centro;
	}
	else return 0;
    }
   //devolvemos los datos de centros y vancantes definitivas para asignar plazas fase2
    public function getCentrosFase2($c=1)
		{
			$sql="SELECT * FROM centros where clase_centro='especial'";
			$sol_fase2=array();
			$query=$this->conexion->query($sql);
			if(!$query) return $sol_fase2;
			while($row = $query->fetch_assoc())
				$sol_fase2[]=$row;
			return $sol_fase2;
		}
   //devolvemos las vacantes en cada tpo de estudios 
    public function getNumSolicitudes($c=1,$fase_sorteo=0)
		{
		$where='';
		if($fase_sorteo>=1) $where=" WHERE fase_solicitud!='borrador' ";
		
		if($c==1)
			$sql="SELECT count(*) as nsolicitudes FROM alumnos $where";
		else
			if($fase_sorteo==0)
				$sql="SELECT count(*) as nsolicitudes FROM alumnos WHERE id_centro_destino=$c";
			else
				$sql="SELECT count(*) as nsolicitudes FROM alumnos where fase_solicitud!='borrador' and id_centro_destino=$c";

		$this->log_sorteo->warning("OBTENIENDO NUMERO DE SOLICITUDES");
		$this->log_sorteo->warning($sql);

		$query=$this->conexion->query($sql);
		if($query) {$row = $query->fetch_object();return $row->nsolicitudes;}
		else return 0;
		}
    public function getNumeroSorteo()
	{
			$sql="select num_sorteo from centros where id_centro=$this->id_centro";

			$this->log_sorteo->warning('CONSULTA OBTENCION NUMERO DE SORTEO: '.$sql);

			$query=$this->conexion->query($sql);
			if($query)
			return $query->fetch_object()->num_sorteo;
			else return 0;
	}
 	public function resetSorteoFase2(){
		$sql=" update centros set asignado_num_fase2=0,num_sorteo_fase2=0";
		$res=$this->conexion->query($sql);
		if($res) return 1;
      else return 0;
	}
    public function getVacantesFase2($idcentro=1,$tipo='ebo'){
			$tvacantes="vacantes_".$tipo;
			if(!isset($id_centro)) $id_centro=$this->id_centro;
			$sql="select $tvacantes from centros where id_centro=$id_centro";

			$this->log_sorteo->warning('CONSULTA OBTENCION VACANTES FASE2: '.$sql);

			$query=$this->conexion->query($sql);
			if($query)
			return $query->fetch_object()->$tvacantes;
			else return 0;
		}
    public function getVacantes($rol='centro')
		{
			if($rol=='centro')
				$sql="select ifnull(IF(t3.plazas-t2.np<0,0,t3.plazas-t2.np),t3.plazas) as vacantes from          (select tipo_alumno ta,num_grupos as ng,plazas from centros_grupos ce where ce.id_centro=".$this->id_centro." ) as t3          left join          (select  tipo_alumno_actual as tf, ifnull(count(*),0) as np from matricula where id_centro=".$this->id_centro." and estado='continua' group by tipo_alumno_actual ) as t2  on t3.ta=t2.tf;
";
			else
				$sql="select ifnull(IF(t3.plazas-t2.np<0,0,t3.plazas-t2.np),t3.plazas) as vacantes from (select tipo_alumno ta,sum(plazas) as plazas from centros_grupos ce group by ta ) as t3 left join (select  tipo_alumno_actual as tf, ifnull(count(*),0) as np from matricula where estado='continua' group by tipo_alumno_actual ) as t2  on t3.ta=t2.tf";		
			$query=$this->conexion->query($sql);

			$this->log_matricula->warning('CONSULTA OBTENCION VACANTES: '.$sql);

			if($query)
    			{
				while ($row = $query->fetch_object()) 
				{
					$resultSet[]=$row;
				}
			}
      		return $resultSet;
		} 
    public function getDatosMatriculaCentro($rol,$t,$centro)
		{
			$this->id_centro=$centro;
			return $this->getResumen($rol,$t);
		}
    public function getResumenFase2($rol) 
		{
			$resultSet=array();
			if($rol=='admin') 
				$sql="SELECT nombre_centro,IFNULL(vacantes_ebo,0) as vacantes_ebo,IFNULL(vacantes_tva,0) as vacantes_tva ,id_centro FROM centros WHERE clase_centro='especial'";
	
	
			$this->log_matricula->warning("CONSULTA DATOS CENTROS RESUMEN FASE 2: ".$sql);
	
			$query=$this->conexion->query($sql);
			if($query)
    			{
				while ($row = $query->fetch_object()) 
				{
					$resultSet[]=$row;
				}
			}
      			return $resultSet;
    		}
    public function getUsuariosCentro($rol,$c) 
		{
			$resultSet=array();
			if($rol=='admin') 
			{
				$sql="select nombre,nombre_usuario,clave_original,a.tel_dfamiliar1 FROM alumnos a, usuarios u WHERE a.id_usuario=u.id_usuario";
			}
			elseif($rol=='centro') 
			{
				$sql="select nombre,nombre_usuario,clave_original,a.tel_dfamiliar1 FROM alumnos a, usuarios u WHERE a.id_usuario=u.id_usuario AND a.id_centro_destino=$c";
			}
	
	
			$this->log_matricula->warning("CONSULTA DATOS RESUMEN MATRICULA: ".$sql);
	
			$query=$this->conexion->query($sql);
			if($query)
    			{
				while ($row = $query->fetch_object()) 
				{
					$resultSet[]=$row;
				}
			}
      			return $resultSet;
    		}

    public function getResumen($rol,$t) 
		{
			$resultSet=array();
			if($rol=='admin') 
			{
				if($t=='matricula')
					{
					$sql="
					select t1.ta,t3.ng as grupo,t3.plazas as puestos,IFNULL(t2.np,0) as plazasactuales,IFNULL(IF(t3.plazas-t2.np<0,0,t3.plazas-t2.np),0) as vacantes 
					from
					(select tipo_alumno ta,sum(num_grupos) as ng,sum(plazas) as plazas from centros_grupos ce group by ta) as t3
					join                   
					(select  tipo_alumno_actual as tf, count(*) as np from matricula where estado='continua' group by tipo_alumno_actual ) as t2  
					on t3.ta=t2.tf    
  					join                   
					(select  tipo_alumno_actual as ta, count(*) as np from matricula m group by tipo_alumno_actual  ) as t1 on t1.ta=t3.ta;
						";
					}
					elseif($t=='alumnos')
					{
					return "tabla:".$t;
					$sql="select t1.ta,'0' as grupo,'0' as puestos,t1.np as plazasactuales,t1.np-t2.np as vacantes from
					(select  tipo_alumno_actual as ta, count(*) as np from matricula group by tipo_alumno_actual ) as t1
					join
					(select  tipo_alumno_actual as tf, count(*) as np from matricula where estado='continua'  group by tipo_alumno_actual ) as t2
					on t1.ta=t2.tf";
					}
			}
			elseif($rol=='centro') 
			{
				if($t=='matricula')
					{
						$sql="
						select t1.ta,t3.ng as grupo,t3.plazas as puestos,IFNULL(t2.np,0) as plazasactuales,
						IFNULL(IF(ifnull(t3.plazas,0)-ifnull(t2.np,0)<0,0,ifnull(t3.plazas,0)-ifnull(t2.np,0)),0
						) 
						as vacantes from 
						(select tipo_alumno ta,num_grupos as ng,plazas from centros_grupos ce where ce.id_centro=".$this->id_centro.") as t3 
						left join 
						(select  tipo_alumno_actual as tf, count(*) as np from matricula where id_centro=".$this->id_centro." and estado='continua' group by tipo_alumno_actual ) as t2  
						on t3.ta=t2.tf 
						left join 
						(select  tipo_alumno_actual as ta, count(*) as np from matricula m,centros ce where m.id_centro=ce.id_centro and ce.id_centro=".$this->id_centro." group by tipo_alumno_actual  ) as t1 
						on t1.ta=t3.ta
						";
					}
					elseif($t=='alumnos')	
					{
					$sql="
					select t1.nc centro,t1.nb borrador,t2.np validada, t3.nd baremada
					from (select nombre_centro nc,count(*) as nb from centros c, alumnos a where a.id_centro_destino=c.id_centro and id_centro=".$this->id_centro." and fase_solicitud='borrador') t1 
					join
					(select nombre_centro nc,count(*) as np from centros c, alumnos a where a.id_centro_destino=c.id_centro and id_centro=".$this->id_centro." and fase_solicitud='validada') t2 on t1.nc=t2.nc
					join
					(select nombre_centro nc,count(*) as nd from centros c, alumnos a where a.id_centro_destino=c.id_centro and id_centro=".$this->id_centro." and fase_solicitud='baremada') t3 on t2.nc=t3.nc";
					}
			}
	
	
			$this->log_matricula->warning("CONSULTA DATOS RESUMEN MATRICULA: ".$sql);
	
			$query=$this->conexion->query($sql);
			if($query)
    			{
				while ($row = $query->fetch_object()) 
				{
					$resultSet[]=$row;
				}
			}
      			return $resultSet;
    		}

    public function setSorteo($ns=0,$c=1) 
		{
			if($c!=1)
				$sql="update centros set num_sorteo=$ns WHERE id_centro=$c";
			else
				$sql="update centros set num_sorteo=$ns";

			$this->log_sorteo->warning("CONSULTA ACTUALIZACION VALORES CENTROS: ");
			$this->log_sorteo->warning($sql);
		
			$query=$this->conexion->query($sql);
			if($query)
				return 1;
			else{ 
						$this->log_sorteo->warning("ERROR ACTUALIZANDO VALORES NUM SORTEO EN CENTROS: ");
						$this->log_sorteo->warning($this->conexion->error);
				
						return 0;
				}
		}
    public function getFases($c=1) 
		{
		$resultado=array(0,0,0);
		$sql="select nombre_centro nc,count(*) as nb,fase_solicitud from centros c, alumnos a where a.id_centro_destino=c.id_centro and id_centro=$this->id_centro  group by nombre_centro,fase_solicitud";

		$this->log_matricula->warning("CONSULTA DATOS ESTADO SOLICITUDES: ".$sql,DIR_LOGS);

			$query=$this->conexion->query($sql);
		if($query)
    		{
			while ($row = $query->fetch_object()) 
			{
					if($row->fase_solicitud=='borrador')	$resultado[0]=$row->nb;
					if($row->fase_solicitud=='validada')	$resultado[1]=$row->nb;
					if($row->fase_solicitud=='baremada')	$resultado[2]=$row->nb;
			}
			}
			else 
			$this->log_matricula->warning($this->conexion->error);
			$this->log_matricula->warning(print_r($resultado,true));
			
			return  $resultado;
    		}
    public function getDatosSorteo($c=1,$tipo='') 
		{
			$sql="select vacantes_ebo,vacantes_tva,num_sorteo_ebo,num_sorteo_tva,solicitudes_ebo,solicitudes_tva from centros where id_centro=$c";
			$query=$this->conexion->query($sql);
			if($query)
    	{
				while ($row = $query->fetch_object()) 
				{
					$resultSet[]=$row;
				}
			}
			
			return  $resultSet;
    }
    public function setFaseSorteo($f) 
    {
			$sql="update centros set fase_sorteo='$f' where id_centro='$this->id_centro'";

			$this->log_sorteo->warning("CONSULTA ACTUALIZANDO FASE SORTEO");
			$this->log_sorteo->warning($sql);

			$query=$this->conexion->query($sql);
			if($query)
			return  1;
			else return 0;
    }
    public function getFaseSorteo() 
    {
			$sql="SELECT fase_sorteo FROM centros WHERE id_centro=$this->id_centro";
			$query=$this->conexion->query($sql);

			$this->log_sorteo->warning("OBTENIENDO FASE SORTEO");
			$this->log_sorteo->warning($sql);

			$query=$this->conexion->query($sql);
			if($query)
    			{
			return  $query->fetch_object()->fase_sorteo;
			}
			else return 0;
			

    }
    public function setEstado($e) {
    }
    public function getEstado() {
	$ec = $this->conexion->query("SELECT num_sorteo FROM centros WHERE id_centro =".$this->id_centro)->fetch_object()->num_sorteo; 
        return $ec;
    }

    public function getDb() {
        return $this->db;
    }
    public function getId() {
        return $this->id_centro;
    }

    public function setId($id) {
        $this->id_centro = $id;
    }
    
    public function getNombre() {
	if(!$this->nombre_centro)
		return 0;	
        return $this->nombre_centro;
    }

    public function setNombre() {
	//si el centros es -1,-2 o -3 es un servicio provincial asi iq no tiene nombre
	if($this->id_centro<0) $this->nombre_centro='sp';
	else
	{
	$nombre_centro = $this->conexion->query("SELECT nombre_centro FROM centros WHERE id_centro =".$this->id_centro)->fetch_object()->nombre_centro; 
	$this->nombre_centro = $nombre_centro;
	}
    }

    public function getPassword() {
        return $this->password;
    }

    public function actualizaVacantes($vebo,$vtva,$tipo=0,$inc) {
			if($tipo==0)
			$sql="update centros set vacantes_ebo=$vebo,
vacantes_ebo_original=$vebo, vacantes_tva=$vtva, vacantes_tva_original=$vtva where id_centro='$this->id_centro'";
			elseif($tipo==1)
			$sql="update centros set vacantes_ebo_original=vacantes_ebo_original".$inc."1, vacantes_ebo=vacantes_ebo".$inc."1 where id_centro='$this->id_centro'";
			elseif($tipo==2)
			$sql="update centros set vacantes_tva_original=vacantes_tva_original".$inc."1, vacantes_tva=vacantes_tva".$inc."1 where id_centro='$this->id_centro'";

			$this->log_fase2->warning("CONSULTA ACTUALIZANDO VACANTES: idcentro/ebo/tva: ".$this->id_centro."/".$vebo."/".$vtva);
			$this->log_fase2->warning($sql);

			$query=$this->conexion->query($sql);
			if($query)
			return  1;
			else return 0;
        $this->password = $password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

}
?>
