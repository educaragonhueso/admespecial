<?php
class UtilidadesAdmision{
    private $con;
     
    public function __construct($adapter) 
		{
		$this->con=$adapter;	
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
