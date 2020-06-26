<?php 
class ACCESO 
	{
  public $c; 
  private $csv_file='';
  private $post='';
  public $dimension=0;
  public $bd=array();
  public $f3=array();

  public function __construct($f='',$bd)
	{
		$this->bd=$bd;
		$this->c =$this->dbconnect($bd['host'],$bd['user'],$bd['pass']);
      $this->c->autocommit(TRUE);
		mysqli_select_db($this->c,$bd['database']);
		$this->c->set_charset("utf8");
		$q="SET NAMES 'UTF8'";
		$this->c->query($q);
		$this->csv_file=$f;
      //print($f);exit();
	}
  public function insertar_usuario($nusuario)
  {
		$clave=rand(1000,99999);
		$sql="INSERT INTO usuarios values(0,'$nusuario','alumno',md5($clave),$clave)";
      print($sql);
      if (mysqli_query($this->c, $sql)) 
      {
         echo "New record created successfully. Last inserted ID is: ";
       $id_usuario = mysqli_insert_id($this->c);
       } 
       else 
       {
         echo "Error: " . $sql . "<br>" . mysqli_error($this->c);
       }		
       if(!$this->c->commit()) 
       {
         echo "Commit de insercion usuario fallo";
         exit();
       }
       else return $id_usuario; 
   }
  public function generar_solicitudes($ns)
	{
		//generar usuarios
		$clave=rand(1000,99999);
		$nid=600000000;//ultimo usuario
		$nidal=60000;//ultimo alumno
		$nsol=0;
		$ndni=35123000;
		
		for($i=1;$i<$ns;$i++)
		{
		$nidal++;
		$ndni++;
		$nid=$nid+1;
		$commit=1;
		$nusuario="nusu9".$i;
		$sql="INSERT INTO usuarios values($nid,'$nusuario','alumno',md5($clave),$clave)";
		$resusu = mysqli_query($this->c,$sql);
		if(!$resusu)
			{	
		 	$commit=0;
			print($this->c->error);
			continue;
			}
		//generamos solicitud: nombre apellidos dni de tutor y centro destino

		$adnitutor=str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$idni=array_rand($adnitutor);
		$dnitutor=$ndni.$adnitutor[$idni];

		$fases = array("borrador","apta","baremada");
		$ifase=array_rand($fases);
		$fase=$fases[$ifase];
		
		$estados = array("duplicada","irregular","apta");
		$iestado=array_rand($estados);
		$estado=$estados[$iestado];
		
		$centros = array("50019020","50019081","50019101","50019147","50019251","50019287","50019299","50019317","50019354","50019378","50019408","50019500","50019548","50019551","50019597","50019615","50019676","50019731","50019792","50018131","50017369");
		$icentro=array_rand($centros);
		$idcentro=$centros[$icentro];
		$nasignado=rand(1,20);
		$nordensorteo=rand(1,20);
		$transporte=rand(1,3);
		
		$sql="INSERT INTO alumnos(id_alumno,id_usuario,nombre,apellido1,apellido2,dni_tutor1,id_centro_destino,nasignado,nordensorteo,transporte,estado_solicitud,fase_solicitud) 
				values($nidal,$nid,'nombre".$i."','pape".$i."','sape".$i."','$dnitutor',$idcentro,$nasignado,$nordensorteo,$transporte,'$estado','$fase')";
		$resusu = mysqli_query($this->c,$sql);
		if(!$resusu)
			{	
		 	$commit=0;
			print($this->c->error);
			continue;
			}
		//datos baremo
		$puntos=rand(1,200);
		$sql="INSERT INTO baremo(id_alumno,puntos_totales,puntos_validados) 
				values($nidal,$puntos,$puntos)";
		$resusu = mysqli_query($this->c,$sql);
		if(!$resusu) $commit=0;
		if($commit==0)
			{	
		 	$commit=1;
			print($this->c->error);
			continue;
			}
		
		if (!$this->c->commit()) 
			{
  		echo "Commit transaction failed";
			}
		$nsol++;
		}
		return $nsol;
	}

  public function generar_usuario($t,$cod)
	{
			//die(PHP_EOL."Error genrando: ".mysqli_error($this->c));
			$sql="INSERT IGNORE INTO usuarios values($cod,$cod,'centro',md5($cod),'$cod')";
			$resusu = mysqli_query($this->c,$sql);
			if(!$resusu) die("ERROR INSERTANDO USUARIO");
			else $usu=1;
	return $usu;

	}
  public function carga_vacantes() 
	{
	$total_filas=0;
	$total_filas_insertadas=0;
	$total_filas_fallidas=0;
	if (($gestor = fopen($this->csv_file, "r")) !== FALSE) 
	{
		while (($datos = fgetcsv($gestor, 0, "\n")) !== FALSE) 
		{  
         $centros = explode(";",$datos[0]);
         //preparando datos
         $total_filas++;		
         $c_ce=$centros[0];	
         $c_vuno=$centros[1];
         $c_vuno_acneae=$centros[2];
         $c_vdos=$centros[3];
         $c_vdos_acneae=$centros[4];
         $c_vtres=$centros[5];
         $c_vtres_acneae=$centros[6];
         
         $sql="UPDATE  premarquesa_produccion.centros SET vuno=$c_vuno,vuno_original=$c_vuno,vuno_acneae=$c_vuno_acneae,vuno_acneae_original=$c_vuno_acneae,vdos=$c_vdos,vdos_original=$c_vdos,vdos_acneae=$c_vdos_acneae,vdos_acneae_original=$c_vdos_acneae ,vtres=$c_vtres,vtres_original=$c_vtres,vtres_acneae=$c_vtres_acneae,vtres_acneae_original=$c_vtres_acneae WHERE id_centro='$c_ce'"; 

            print($sql.PHP_EOL);
            if(!$result = mysqli_query($this->c, $sql)) 
            {
               die(PHP_EOL."Error actualizando centros vacantes: ".mysqli_error($this->c));
            }
         print($result);
        }
	}
 	fclose($gestor);
   return 1;
   }
  public function carga_guarderias() 
	{
	$total_filas=0;
	$total_filas_insertadas=0;
	$total_filas_fallidas=0;
	if (($gestor = fopen($this->csv_file, "r")) !== FALSE) 
	{
		while (($datos = fgetcsv($gestor, 0, "\n")) !== FALSE) 
		{  
         $centros = explode(";",$datos[0]);
         //preparando datos
         $total_filas++;		
         $c_ce=$centros[0];	
         $c_den_centro=$centros[1];	
         $c_codcentro=$centros[2];	
         $c_nombre_centro=$centros[3];	
         $c_domicilio=$centros[4];
         $c_cp=$centros[5];
         $c_ensenanza=$centros[6];
         $c_loc=$centros[7];
         $c_vuno=$centros[8];
         $c_vdos=$centros[9];
         $c_vtres=$centros[10];
         
         $id_usuario=$this->generar_usuario('centros',$c_codcentro);
         if($id_usuario!=0)
         {
            $sql="insert IGNORE  into centros(id_usuario,localidad,provincia,direccion,nombre_centro,id_centro,vuno,vuno_original,vdos,vdos_original,vtres,vtres_original) values($c_codcentro,'$c_loc','zaragoza','$c_domicilio','$c_nombre_centro','$c_codcentro','$c_vuno','$c_vuno','$c_vdos','$c_vdos','$c_vtres','$c_vtres')";

            print($sql);
            if(!$result = mysqli_query($this->c, $sql)) 
            {
               die(PHP_EOL."Error insertando: ".mysqli_error($this->c));
               $total_filas_fallidas++;
            }
            else	
               $total_filas_insertadas++;
          }
		 }
 	fclose($gestor);
   }
	return $total_filas_insertadas;
	} 
  public function carga_centros_grupos() 
	{
	$total_filas=0;
	$total_filas_insertadas=0;
	$total_filas_fallidas=0;
	if (($gestor = fopen($this->csv_file, "r")) !== FALSE) 
	{
		while (($datos = fgetcsv($gestor, 0, "\n")) !== FALSE) 
		{  
		$centros = explode(";",$datos[0]);
		//preparando datos
		$total_filas++;		
		$c_codigo_centro=$centros[1];	
		$c_ngrupos_ebo=$centros[5];	
		$c_nplazas_ebo=$centros[5]*6;
		if(!$centros[6])
		{
			$centros[6]=0;
		}	
 		$c_ngrupos_tva=$centros[6];	
		$c_nplazas_tva=$centros[6]*12;	
		$sql1="insert IGNORE  into centros_grupos values('$c_codigo_centro','ebo','$c_ngrupos_ebo','$c_nplazas_ebo')";
		$sql2="insert IGNORE  into centros_grupos values('$c_codigo_centro','tva','$c_ngrupos_tva','$c_nplazas_tva')";
					if(!$result = mysqli_query($this->c, $sql1)) 
					{
						die(PHP_EOL."Error insertando: ".mysqli_error($this->c));
					}
					if(!$result = mysqli_query($this->c, $sql2)) 
					{
						die(PHP_EOL."Error insertando: ".mysqli_error($this->c));
					}
		}
	}
 	fclose($gestor);
	return $total_filas_insertadas;
	} 

  public function carga_centros($tipo) 
	{
	$total_filas=0;
	$total_filas_insertadas=0;
	$total_filas_fallidas=0;
	if (($gestor = fopen($this->csv_file, "r")) !== FALSE) 
	{
		while (($datos = fgetcsv($gestor, 0, "\n")) !== FALSE) 
		{  
		$centros = explode(";",$datos[0]);
		//preparando datos
		if($centros[0]=='Cód. RCD Centro') continue;
		$total_filas++;		
		$c_codigo_centro=$centros[0];	
		$c_nombre_centro=mysqli_real_escape_string($this->c,$centros[1]);	
		$c_provincia=$centros[2];	
		$c_localidad=$centros[3];	
		
		
		$id_usuario=$this->generar_usuario('centros',$c_codigo_centro);
		if($id_usuario!=0)
		{
		$sql="insert IGNORE  into centros values(0,'$c_codigo_centro','$c_localidad','$c_provincia','$c_nombre_centro','$tipo','$c_codigo_centro')";
		if(!$result = mysqli_query($this->c, $sql)) 
		{
			die(PHP_EOL."Error insertando: ".mysqli_error($this->c));
			$total_filas_fallidas++;
		}
		else	
			$total_filas_insertadas++;
		}
		else echo $id_usuario;
		}
	}
 	fclose($gestor);
	return $total_filas_insertadas;
	} 
  public function carga_alumnos_antiguos_guarderias() 
	{
	$total_filas=0;
	$total_filas_insertadas=0;
	$total_filas_fallidas=0;
	if (($gestor = fopen($this->csv_file, "r")) !== FALSE) 
	{
		while (($datos = fgetcsv($gestor, 0, "\n")) !== FALSE) 
		{
		$matricula = explode(";",$datos[0]);
		//preparando datos
      if($matricula[0]=='centro') continue;  
		$total_filas++;		
      print_r($matricula);
		$m_codcentro=utf8_encode($matricula[0]);	
		$m_apellido1=$matricula[1];	
		$m_apellido2=$matricula[2];	
		$m_nombre=$matricula[3];	
		$m_fnac=$this->make_fecha2($matricula[4]);
		$m_acneae=$matricula[5];
		$m_tipoestudios=$matricula[6];
		$m_hore=$matricula[7];
		$m_hors=$matricula[8];
		$m_email=$matricula[9];
		$m_telefono1=$matricula[11];
	   //if($m_email=='') {print("email vacio");return 0;}
      //else 
        // {   
            if($m_telefono1=='') $m_telefono1='202020';
            $id_usuario=$this->insertar_usuario($m_telefono1);  
            if($id_usuario!=0)  
            {  
               $sql="insert into alumnos(id_usuario,apellido1,apellido2,nombre,fnac,id_centro_destino,sol_plaza,tipoestudios,hore,hors,email,tipoalumno,est_desp_sorteo) values($id_usuario,'$m_apellido1','$m_apellido2','$m_nombre','$m_fnac','$m_codcentro','$m_acneae','$m_tipoestudios','$m_hore','$m_hors','$m_email','anterior','admitido')"; 
            print($sql);
               if(!$result = mysqli_query($this->c, $sql)) 
               {
                  print($sql);
                  die(PHP_EOL."Error insertando: ".mysqli_error($this->c));
               }
               else	
               {	
               if (!$this->c->commit()) 
                  {
               echo "Commit de insercion guarderia fallo";
               exit();
                  }
               $total_filas_insertadas++;
               }	
               }
               else print("error ins usuario");
            //}
	   }
 	fclose($gestor);
	return 1;
   }
  } 
  public function carga_matricula() 
	{
	$edadtva=21;
	$edadebo=18;
	$total_filas=0;
	$nedad=0;
	$total_filas_insertadas=0;
	$total_filas_fallidas=0;
	if (($gestor = fopen($this->csv_file, "r")) !== FALSE) 
	{
		while (($datos = fgetcsv($gestor, 0, "\n")) !== FALSE) 
		{  
		$matricula = explode(";",$datos[0]);
		//preparando datos
		if($matricula[0]=='CE') continue;
		$total_filas++;		
		$m_curso=utf8_encode($matricula[0]);	
		$m_provincia=$matricula[1];	
		$m_ensenanza=mysqli_real_escape_string($this->c,$matricula[2]);	
		$m_nombre=$matricula[3];	
		$m_apellidos=$matricula[4];	
		$m_fnac=$this->make_fecha($matricula[5]);	
		$m_tipo_centro=$matricula[6];	
		$m_nombre_centro=$matricula[7];	
		$m_codigo_centro=$matricula[9];
		//if($m_codigo_centro!=50005616 || $m_codigo_centro!=50007674)
		//	continue;
		//pasamos los de san antonio a atades50007674
		if($m_codigo_centro==50005616)
			{
			$m_codigo_centro=50007674;
			$m_nombre_centro="ATADES CENTRO DE EDUCACIÓN ESPECIAL SAN MARTÍN DE PORRES";
			}
		$m_tipo_alumno_futuro=$this->calcula_alumno($matricula[5]);	
		$m_estado="continua";
		
		$edad=date_diff(date_create($m_fnac), date_create('2020-12-31'))->y;
		//igual o mas de 21 no pueden entrar
		if($edad>=$edadtva) 
		{
			print($m_fnac);
			print_r($matricula);
			$nedad++;
			continue;
		}
		if($edad<$edadebo) $m_tipo_alumno_actual='ebo';
		else $m_tipo_alumno_actual='tva';
		$sql="insert into matricula values(0,'$m_curso','$m_provincia','$m_ensenanza','$m_nombre','$m_apellidos','$m_fnac','$m_tipo_centro','$m_nombre_centro','$m_tipo_alumno_futuro','$m_tipo_alumno_actual','$m_estado','$m_codigo_centro')";
		if(!$result = mysqli_query($this->c, $sql)) 
		{
			print($sql);
			die(PHP_EOL."Error insertando: ".mysqli_error($this->c));
			$total_filas_fallidas++;
		}
		else	
		{	
		if (!$this->c->commit()) 
			{
  		echo "Commit de insercion matricula fallo";
  		exit();
			}
		$total_filas_insertadas++;
		}	
		}
	}
 	fclose($gestor);
	$res=array($total_filas_insertadas,$nedad,$total_filas);
	return $res;
	} 
  public function calcula_alumno($s) 
	{
	$af=explode('/',$s);
	$res=2021-$af[2];
	if($res==19) $t='ebo';
	elseif($res==21 or $res==20) $t='tva';
	else $t='out';
	return $t;
	}
  public function make_fecha2($s) 
	{
	$afecha=explode("/",$s);
	$sfecha=$afecha[2]."-".$afecha[1]."-".$afecha[0];
	$timestamp = strtotime($sfecha);
	$fecha=date("Y-m-d", $timestamp);
	return $fecha ;
	} 
  public function make_fecha($s) 
	{
	$afecha=explode("/",$s);
	$sfecha=$afecha[1]."-".$afecha[0]."-".$afecha[2];
	$timestamp = strtotime($sfecha);
	$fecha=date("Y-m-d", $timestamp);
	return $fecha ;
	} 

  private function dbconnect() 
	{
	$conn =mysqli_connect($this->bd['host'],$this->bd['user'],$this->bd['pass']) or die ("<br/>No conexion servidor");
    	#$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("<br/>No conexion servidor");
	$this->c=$conn;     
	mysqli_select_db($conn,$this->bd['database']) or die ("<br/>No se puedo seleccionar la bases de datos");
	return $conn;
  	}
 
  public function gen_csvs() 
	{
		$filtros3=array();
 		$fp = fopen('tmp.csv', 'w');
		$dim1=$this->dpos[0];
		$posicion=str_replace('d','',array_search($dim1,$this->post));
		$dim=$this->dimension;
		$cabecera=array('Matricula');
		#añadimos cabecera al fichero
		if($dim==1) array_push($cabecera,'NALUMNOS');
		elseif($dim==2)
		{
		$filtros2=$this->get_filtros($posicion+1,'array');
		foreach($filtros2 as $filtro2)
			array_push($cabecera,'NALUMNOS-'.$filtro2);
		}
		else
		{
		#hacemos un grafico para cada uno ded los valores de la d3
		$filtros3=$this->get_filtros(3,'array');
		#recogemos los filtros para nombrar los graficos
		$this->f3=$filtros3;
		
		$i=0;
		if(sizeof($filtros3)!=0)
		foreach($filtros3 as $filtro3)
			{
			$cabecera=array('Matricula');

 			$fp1 = fopen('tmp'.$i.'.csv', 'w');
			$filtros2=$this->get_filtros(2,'array');
			foreach($filtros2 as $filtro2)
				{
				array_push($cabecera,'NALUMNOS-'.$filtro2);
				}
				fputcsv($fp1, $cabecera);
				$sql=$this->gen_sql(2,$filtro3);
				//print(PHP_EOL.$sql." ".PHP_EOL);
				$res = mysqli_query($this->c,$sql);
					if (!$res=mysqli_query($this->c,$sql)) 
					{
					printf("Hay un Error: %s\n", mysqli_error($this->c));
					}
					else 
					{
					while ($row = mysqli_fetch_assoc($res))
					{
					fputcsv($fp1, $row);
					}
					}
			$i++;
			fclose($fp1);
			}
		}
		if($dim!=3)
		{
		fputcsv($fp, $cabecera);
	
		$sql=$this->gen_sql($this->dimension);
		$res = mysqli_query($this->c,$sql);
		if (!$res=mysqli_query($this->c,$sql)) {
			printf("Hay un Error: %s\n", mysqli_error($this->c));
		}
		else {
			while ($row = mysqli_fetch_assoc($res))
				{
				fputcsv($fp, $row);
				}
		}
		fclose($fp);
		}
	} 
  public function select($d) 
	{
	$sql="SELECT distinct (".$d.") FROM GIR_MATRICULA";
	$as=array();
	$res = mysqli_query($this->c,$sql);
	if(!$res=mysqli_query($this->c,$sql)) 
	{
	printf("Hay un Error: %s\n", mysqli_error($this->c));
	}
	else 
	{
	while ($row = mysqli_fetch_assoc($res))
	{
	array_push($as,$row[$d]);
	}
	}
	return $as;
	}
}
?>
