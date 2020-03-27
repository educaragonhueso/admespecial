<?php
class UtilidadesAdmision{
    private $con;
     
    public function __construct($adapter) 
		{
		$this->con=$adapter;	
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
  public function actualizaVacantesCentros($centro=0)
	{
		$vebo[0]=$this->centro->getVacantes();
		$sql='INSERT IGNORE INTO '.$tabla.' SELECT * from alumnos';
		if($this->con->query($sql)) return 1;
		else return 0;

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
