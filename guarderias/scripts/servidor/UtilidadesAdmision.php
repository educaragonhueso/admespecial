<?php
class UtilidadesAdmision{
    private $con;
     
    public function __construct($adapter='',$centros_controller='',$centro='',$post=0) 
		{
		$this->con=$adapter;	
		$this->centros=$centros_controller;	
		$this->centro=$centro;	
		$this->post=$post;	
		require_once DIR_CLASES.'LOGGER.php';
		require_once DIR_APP.'parametros.php';
			
		$this->log_fase2=new logWriter('log_fase2',DIR_LOGS);
		$this->log_sorteo_fase2=new logWriter('log_sorteo_fase2',DIR_LOGS);
		$this->log_listado_solicitudes=new logWriter('log_listado_solicitudes',DIR_LOGS);
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
 	public function setVacantesCentroFase2($idc,$v,$t,$inc=0){
		if($inc==1) //si inc es 1 se incrementan/decrementan las vacantes
		{
			$voriginal="vacantes_$t"."_original";
			$sql="UPDATE centros set vacantes_$t=vacantes_$t+1,$voriginal=$voriginal+1 where id_centro=$idc";
			
		}
		else
			$sql="UPDATE centros set vacantes_$t=$v where id_centro=$idc";
		$this->log_fase2->warning("ACTUALIZANDO VACANTES CENTROS, VACANTES: $v, INC: $inc CONSULTA: ".$sql);
		if(!$this->post) print(PHP_EOL."ACTUALIZANDO VACANTES CENTROS, VACANTES: $v, INC: $inc CONSULTA: ".$sql);
		if(!$this->con->query($sql)) return $this->con->error;
		else return 1;
	}
 	public function setAlumnoCentroFase2($ida,$idc,$nc){
		//modificamos el centro en a tabla de alumnos_fase2
		$sql="UPDATE alumnos_fase2 set id_centro_definitivo=$idc,centro_definitivo='$nc' where id_alumno=$ida";
		if(!$this->post) print("CONSULTA ASIGNACION PLAZA: $sql");
		if(!$this->con->query($sql)) return $this->con->error;
		else return 1;
	}
 	public function checkDistancia($idalumno,$idcentro){
		$sql="SELECT id_alumno FROM distancias WHERE id_alumno=$idalumno and
id_centro=$idcentro";
		$res=$this->con->query($sql);
		if(!$res) return $this->con->error;
		if($res->num_rows>0) return 1;
		else return 0;
	}
 	public function setDistancia($idalumno,$idcentro,$data){
		$sql="INSERT INTO distancias VALUES($idalumno,$idcentro,DEFAULT,";
      foreach ($data as $k=>$v)
         $sql.="'$v',";
      $sql=substr($sql,0,-1);
      $sql.=")";
      print($sql);
		if(!$this->con->query($sql)) return $this->con->error;
		else return 1;
	}
 	public function setCoordenadas($id,$coord,$tipo='alumno'){
      if($tipo=='alumno')
		$sql="UPDATE alumnos_fase2 set coordenadas='$coord' WHERE id_alumno=$id";
      else
		$sql="UPDATE centros set coordenadas='$coord' WHERE id_centro=$id";
		if(!$this->con->query($sql)) return $this->con->error;
		else return 1;
	}
 	public function liberaReserva($ida){
		//modificamos el centro en a tabla de alumnos_fase2
		$sql1="UPDATE alumnos_fase2 set reserva=0 where id_alumno=$ida";
		$sql2="UPDATE alumnos_fase2_tmp set reserva=0 where id_alumno=$ida";
		if(!$this->con->query($sql1)) return $this->con->error;
		if(!$this->con->query($sql2)) return $this->con->error;
		return 1;
	}
 	public function checkReservaPlaza($ida){
		//comprobamos si ell alumno tiene una reserva para el tipo determinado
		//si la tiene devolvemos el id del centro origen, siempre q sea de tipo especial
		$sql="SELECT reserva FROM alumnos_fase2 where id_alumno=$ida"; 
		$res=$this->con->query($sql);
		if($res) return $res->fetch_row();
		else return $this->con->error;
	}
	public function restaurarVacantesCentroFase2(){
		$sql="UPDATE centros SET vacantes_ebo=vacantes_ebo_original, vacantes_tva=vacantes_tva_original";
		$this->log_fase2->warning("RESTAURANDO VACANTES CENTROS, CONSULTA: $sql");
		if(!$this->con->query($sql)) return $this->con->error;
		else return 1;
	}
 	public function getReservaPlaza($ida,$tipo=''){
		//comprobamos si ell alumno tiene una reserva para el tipo determinado
		//si la tiene devolvemos el id del centro origen, siempre q sea de tipo especial
		$sql="SELECT id_centro_origen,reserva FROM alumnos_fase2 where id_alumno=$ida"; 
		$res=$this->con->query($sql);
		if($res) return $res->fetch_row();
		else return $this->con->error;
	}
 	public function resetAlumnosFase2(){
		//recargamos tabla de alumnso con los valores originales
		$sql1="DELETE FROM alumnos_fase2";
		$sql2="INSERT INTO alumnos_fase2 SELECT * FROM alumnos_fase2_tmp"; 
		$res1=$this->con->query($sql1);
		$res2=$this->con->query($sql2);
		if($res1 and $res2) return 1;
		else return 0;
	}
 	public function asignarVacantesCentros($centros_fase2=array(),$alumnos_fase2=array(),$centro_alternativo=0,$tipoestudios,$post=0)
	{
		if(sizeof($centros_fase2)==0 or sizeof($alumnos_fase2)==0){print("ARRAY VACIO"); return -1;}

		if(!$post) print(PHP_EOL."ASIGNANDO VACANTES FASE2 CENTRO ALT: $centro_alternativo TIPOESTUDIOS: $tipoestudios".PHP_EOL);
		$this->log_fase2->warning("ASIGNANDO VACANTES FASE2 CENTRO ALT: $centro_alternativo TIPOESTUDIOS: $tipoestudios");
		if(!$post) print(PHP_EOL."INCIANDO ASIGNACION RONDA: $centro_alternativo FECHAHORA: ".date("Y-m-d h:i:sa").PHP_EOL);
		$this->log_fase2->warning("INCIANDO ASIGNACION RONDA: $centro_alternativo FECHAHORA: ".date("Y-m-d h:i:sa"));

		if($centro_alternativo==0)
			$indicecentro='id_centro';
		else
			$indicecentro='id_centro'.$centro_alternativo;

		//empezamos con las ebo
		foreach($centros_fase2 as $centro)
			{			
			$this->centro->setId($centro['id_centro']);
			$this->centro->setNombre();

			$nombrecentro=$this->centro->getNombre();
			if(!$nombrecentro) return "NO HAY NOMBRE DE CENTRO";
			if(strtoupper($nombrecentro)=='NOCENTRO') continue;

			$vacantes=$this->centro->getVacantesFase2(1,$tipoestudios);
			if($vacantes<=0) continue;

			$vasignadaebo=1;

			$this->log_fase2->warning("ENTRANDO CENTRO $nombrecentro FASE2 $tipoestudios, plazas: $vacantes");
			if(!$post) print(PHP_EOL."ENTRANDO CENTRO $nombrecentro, idcentro ".$centro['id_centro']." FASE2 $tipoestudios, plazas: $vacantes".PHP_EOL);

			$idcentro=$centro['id_centro'];
			$vasignada=1;
			while($vacantes>0 and $vasignada==1)
				{
				if(!$post) print("HAY VACANTES, COMPROBANDO ALUMNOS");

				$vasignada=0;
				//revisar cada alumno (hay q considerar el orden de elección del alumno, el sorteo etc.) y si ha solicitado plaza en primera opción
				foreach($alumnos_fase2 as $alumno)
					{
					
					if(!$post) print(PHP_EOL."ENTRANDO ALUMNO, centro: ".strtoupper($alumno->centro_definitivo)." ".$alumno->tipoestudios." ".$tipoestudios.PHP_EOL);
					$this->log_fase2->warning("ENTRANDO ALUMNO, centro: ".strtoupper($alumno->centro_definitivo)." ".$alumno->tipoestudios." ".$tipoestudios);
					
					if($alumno->tipoestudios!=$tipoestudios)
					{
					
					if(!$post) print(PHP_EOL."SALIENDO, centro alumno: ".strtoupper($alumno->centro_definitivo)." ".$alumno->tipoestudios." ".$tipoestudios);
					$this->log_fase2->warning("SALIENDO, centro alumno: ".strtoupper($alumno->centro_definitivo)." ".$alumno->tipoestudios." ".$tipoestudios);
					
					continue;
					}
					
					$this->log_fase2->warning("ID ALUMNO EN PROCESO: ".$alumno->id_alumno." NOMBRE ALUMNO: ".$alumno->nombre);
					if(!$post) print(PHP_EOL."ID ALUMNO EN PROCESO: ".$alumno->id_alumno." NOMBRE ALUMNO: ".$alumno->nombre.PHP_EOL);
					$this->log_fase2->warning("CENTRO ACTUAL: $nombrecentro $idcentro CENTRO PEDIDO ALUMNO: ".$alumno->{$indicecentro}." NOMBRE ALUMNO: ".$alumno->nombre);
					if(!$post) print("CENTRO ACTUAL: $nombrecentro $idcentro CENTRO PEDIDO ALUMNO: ".$alumno->{$indicecentro}." NOMBRE ALUMNO: ".$alumno->nombre." CENTRO DEFINITIVO ALUMNO: ".$alumno->centro_definitivo.PHP_EOL);
				
					//solo asignamos plaza a alumnos sin centro definitivo	
					if($alumno->$indicecentro==$idcentro and strtoupper($alumno->centro_definitivo)=='NOCENTRO')
					{ 
						//comprobamos si tenía reserva de plaza, en caso afirmativo, se genera nueva plaza
						$reserva=$this->getReservaPlaza($alumno->id_alumno,$tipoestudios);
						
						$this->setAlumnoCentroFase2($alumno->id_alumno,$centro['id_centro'],$nombrecentro);
						$asignada=1;
						$vacantes--;
					
						if(!$post) print(PHP_EOL."COINCIDENCIA: $alumno->id_alumno CENTRO: $nombrecentro".PHP_EOL);
						$this->log_fase2->warning("COINCIDENCIA: $alumno->id_alumno CENTRO: $nombrecentro");
					
							
						if(!$post) print(PHP_EOL."ENTREGADA PLAZA DEL CENTRO $nombrecentro A: ".$alumno->id_alumno.PHP_EOL);
						$this->log_fase2->warning("ENTREGADA PLAZA DEL CENTRO $nombrecentro A: $alumno->id_alumno");
						//si habia reserva de plaza tenemos que actualizar las vacantes para ese centro y volver a procesarlo,reserva[0] es el id centro y reserva[1] el q dice si se ha liberado ya o no
						if(!$post) print(PHP_EOL."COMPROBANDO RESERVA DE PLAZA $reserva[0]".PHP_EOL);
						$this->log_fase2->warning("COMPROBANDO RESERVA DE PLAZA $reserva[0]");
					
						if($reserva[0]!=0 and $reserva[1]==1 and $alumno->$indicecentro!=$reserva[0])
						{
							//se ha liberado vacante con lo q hay q restaurar las vacantes de nuevo incrementando una
							if($this->restaurarVacantesCentroFase2()!=1) return 0;
							
							$this->log_fase2->warning("REINICIANDO PROCESO, RESTAURADAS VACANTES");
							if(!$post) print(PHP_EOL."REINICIANDO PROCESO, RESTAURADAS VACANTES");
							
							//añadimos la q se ha liberado y marcamos al alumno como q la ha liberado para no voolver a tenrla en cuenta
							if($this->setVacantesCentroFase2($reserva[0],0,$tipoestudios,1)!=1) return 0;
						
							//marcamos la reserva q deja el alumno, como reserva liberada, en las dos tablas de alumnos	
							if($this->liberaReserva($alumno->id_alumno)!=1) return 0;

							if(!$post) print(PHP_EOL."LIBERADA RESERVA CENTRO $reserva[0] ALUMNO: ".$alumno->id_alumno);
							$this->log_fase2->warning("LIBERADA RESERVA CENTRO $reserva[0] ALUMNO: ".$alumno->id_alumno);
	
							return -2;
						}
					}
					//si se acaban las vacantes del centro
					if($vacantes==0)
						{ 
						$this->log_fase2->warning("TERMINADO CENTRO: $nombrecentro");
						if($this->setVacantesCentroFase2($centro['id_centro'],$vacantes,$tipoestudios)!=1) return 0;
						if(!$post) print(PHP_EOL."Terminado centro: $nombrecentro".PHP_EOL);
						break;
						}
					}
				}
			//actualizamos las vacantes en el centro cuyas plazas se han procesado
			if($this->setVacantesCentroFase2($centro['id_centro'],$vacantes,$tipoestudios)!=1) return 0;
			}
		//print("FIN asignaciones $tipoestudios".PHP_EOL);
		return 1;
	}
    	public function getAlumnosReserva()
	{
		$resultSet=array();
		$sql="SELECT id_alumno,nombre,id_centro_estudios_origen,tipoestudios FROM alumnos where est_desp_sorteo='admitida' or (est_desp_sorteo='noadmitida' and reserva=1)";
		$query=$this->con->query($sql);
		if($query)
		while ($row = $query->fetch_object()) {
		   $resultSet[]=$row;
		}
		
		return $resultSet;
    }
   public function getAlumnosFase2($t='tmp')
	{
		$resultSet=array();
		if($t=='tmp') $tabla='alumnos_fase2_tmp';
		else $tabla='alumnos_fase2';
		$sql="SELECT coordenadas,calle_dfamiliar,localidad,id_alumno,nombre,id_centro1,id_centro2,id_centro3,id_centro4,id_centro5,id_centro6,id_centro,nombre_centro,centro_definitivo,tipoestudios,transporte,puntos_validados,nordensorteo FROM $tabla where estado_solicitud='apta' order by transporte desc,puntos_validados desc,nordensorteo asc";

		$query=$this->con->query($sql);

		if($query)
		while ($row = $query->fetch_object()) {
		   $resultSet[]=$row;
		}
		
		return $resultSet;
    }
  public function liberaVacantesAlumnos()
	{
		$alumnosreserva=$this->getAlumnosReserva();
		$alumnosreserva=(array)$alumnosreserva;
		foreach($alumnosreserva as $a)
		{
			$a=(array)$a;
			$corigen=$a['id_centro_estudios_origen'];
			$tipoestudios=$a['tipoestudios'];
			//comporbar cada alumno y si itiene reserva actualizar plaza en el centro de origen
			if($corigen!=0)
			{
			//print_r($a);exit();
			if($this->setVacantesCentroFase2($corigen,0,$tipoestudios,1)!=1) return 0;
			}
		}
	return 1;
	}
   public function getPlazasDefinitiva($idcentro)
	{

		$resultSet=array();
      //Plazas ebo
		$sqlebo="SELECT count(id_alumno) as plazas FROM alumnos_definitiva_final where
id_centro_destino=$idcentro and est_desp_sorteo='admitida' and tipoestudios='ebo'";
		$sqltva="SELECT count(id_alumno) as plazas FROM alumnos_definitiva_final where
id_centro_destino=$idcentro and est_desp_sorteo='admitida' and tipoestudios='tva'";
		$queryebo=$this->con->query($sqlebo);
		$querytva=$this->con->query($sqltva);

		if($queryebo and $querytva)
		{   
         $row=$queryebo->fetch_object(); 
         $resultSet[]=$row->plazas;
		   
         $row=$querytva->fetch_object(); 
         $resultSet[]=$row->plazas;
      }
   return $resultSet;
   }
  public function actualizaVacantesCentros($centro=0)
  {
		$acentros=array();
		$centros=$this->centros->getAllCentros();
		while($row = $centros->fetch_assoc()) { $acentros[]=$row;}
		foreach($acentros as $centro)
		{
         //obtenemos las plazas ocupadas de la lista definitiva, en cada centro
			$plazas=$this->getPlazasDefinitiva($centro['id_centro']);
			$this->centro->setId($centro['id_centro']);

			//completamos el campo de cada centro para incluir las vacantes definitivas
			$vacantes=$this->centro->getVacantes();

         $vac_final_ebo=$vacantes[0]->vacantes-$plazas[0];
         $vac_final_tva=$vacantes[1]->vacantes-$plazas[1];

         if($vac_final_ebo<0 or $vac_final_tva<0){print("ERROR: VACANTES
NEGATIVAS CENTRO: ".$centro['id_centro']); exit();}

			$sql="UPDATE centros set
vacantes_ebo_original=".$vac_final_ebo.",vacantes_ebo=".$vac_final_ebo.",
vacantes_tva_original=".$vac_final_tva.",vacantes_tva=".$vac_final_tva." where id_centro=".$centro['id_centro'];
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
			$sql="INSERT IGNORE INTO $tabla_destino SELECT a.* from $tabla_origen a, centros c WHERE a.fase_solicitud!='borrador' and a.id_centro_destino=c.id_centro and c.fase_Sorteo<'2'";
		else
			$sql="INSERT IGNORE INTO $tabla_destino SELECT a.* from $tabla_origen a WHERE a.fase_solicitud!='borrador'";
		if($this->con->query($sql)) return 1;
		else return $this->con->error;

	}
  public function copiaTablaBaremada($tdestino,$fase,$id_centro=1,$provincia='todas')
	{
		//copiamos registros de centros que todavía no han realizado el sorteo o q están en fase menos q 2
      if($id_centro==1 and $provincia=='todas')
	   {
   	$delete="delete from $tdestino";
      $sql="INSERT into $tdestino SELECT a.id_alumno,a.nombre,a.apellido1,a.apellido2,a.tipoestudios,a.fase_solicitud,a.estado_solicitud,a.transporte,a.nordensorteo,a.nasignado as nasignado,a.num_hadmision,a.fnac, b.puntos_validados,b.proximidad_domicilio,b.tutores_centro,b.renta_inferior,b.discapacidad,b.tipo_familia,b.hermanos_centro,b.sitlaboral,a.id_centro_destino,c.nombre_centro FROM alumnos a left join baremo b on b.id_alumno=a.id_alumno left join centros c on c.id_centro=a.id_centro_destino where fase_solicitud!='borrador'";
      $sqlfase="UPDATE centros set fase_sorteo='$fase'";
      }
      else if($id_centro>1)
	   {
   	$delete="delete from $tdestino where id_centro_destino=$id_centro";
      $sql="INSERT into $tdestino SELECT a.id_alumno,a.nombre,a.apellido1,a.apellido2,a.tipoestudios,a.fase_solicitud,a.estado_solicitud,a.transporte,a.nordensorteo,a.nasignado as nasignado,a.num_hadmision,a.fnac, b.puntos_validados,b.proximidad_domicilio,b.tutores_centro,b.renta_inferior,b.discapacidad,b.tipo_familia,b.hermanos_centro,b.sitlaboral,a.id_centro_destino,c.nombre_centro FROM alumnos a left join baremo b on b.id_alumno=a.id_alumno left join centros c on c.id_centro=a.id_centro_destino where fase_solicitud!='borrador' and c.id_centro=$id_centro";
      $sqlfase="UPDATE centros set fase_sorteo='$fase' where id_centro=$id_centro";
      }
		
      $this->log_listado_solicitudes->warning("COPIANDO BAREMADA, TABLA/FASE/CENTRO/PROVINCIA:$tdestino -  $fase - $id_centro - $provincia");
      $this->log_listado_solicitudes->warning("CONSULTA BORRADO: $delete");
      $this->log_listado_solicitudes->warning("CONSULTA INSERCION: $sql");
      if($this->con->query($delete) and $this->con->query($sql) and $this->con->query($fase)) return 1;
		else return $this->con->error;

	}
  public function copiaTablaFase2($tipo,$centro=0)
	{
		$tabla="alumnos_".$tipo;
		$sql='DELETE from '.$tabla;
		$res=$this->con->query($sql);
		if(!$res) return $this->con->error;
		$sqlfase2="SELECT
t1.id_alumno,t1.nombre,t1.apellido1,t1.apellido2,t1.localidad,t1.calle_dfamiliar,'nodata'
as coordenadas,t1.nombre_centro,t1.tipoestudios,t1.fase_solicitud,t1.estado_solicitud,t1.transporte,'0' as nordensorteo,'0' as nasignado,t1.puntos_validados,t1.id_centro,t2.centro1,t2.id_centro1,t3.centro2,t3.id_centro2,t4.centro3,t4.id_centro3,t5.centro4,t5.id_centro4,t6.centro5,t6.id_centro5,t7.centro6,t7.id_centro6, 'nocentro' as centro_definitivo, '0' as id_centro_definitivo,t1.id_centro_estudios_origen as id_centro_origen,t8.centro_origen,t1.reserva,t1.reserva as reserva_original,'automatica' as tipo_modificacion,'0' as activado_fase3 FROM 
	(SELECT a.id_alumno, a.nombre, a.apellido1, a.apellido2,a.loc_dfamiliar as localidad,a.calle_dfamiliar,c.nombre_centro,a.tipoestudios,a.fase_solicitud,a.estado_solicitud,a.transporte,a.nordensorteo,a.nasignado as nasignado,b.puntos_validados,a.id_centro_destino as id_centro,a.id_centro_estudios_origen,a.est_desp_sorteo,a.reserva FROM alumnos a left join baremo b on b.id_alumno=a.id_alumno 
	left join centros c on a.id_centro_destino=c.id_centro  order by c.id_centro desc, a.tipoestudios asc,a.transporte desc, b.puntos_validados desc)
	as t1 
	left join 
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
left join 
	(SELECT a.id_alumno,c.id_centro as id_centro_origen, c.nombre_centro as centro_origen from alumnos a, centros c where c.id_centro=a.id_centro_estudios_origen) 
	as t8 on t1.id_alumno=t8.id_alumno WHERE t1.fase_solicitud!='borrador' and t1.est_desp_sorteo='noadmitida'
";
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
