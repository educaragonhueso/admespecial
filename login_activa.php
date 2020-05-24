<?php 
session_start();
$_SESSION=array();
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_CORE.'/Conectar.php';
date_default_timezone_set('Europe/Madrid');
$hoy=date("Y/m/d");      
$_SESSION['estado']='inicioinscripcion';
$_SESSION['rol'] = 'alumno';      
$_SESSION['usuario_autenticado'] =0;//si es un usuario autenticado o no      
$_SESSION['provincia']='todas';
$_SESSION['fin_inscripcion_centros']=0;
$_SESSION['inicio_prorroga']=0;
$_SESSION['version']=VERSION;
$_SESSION['sorteo_fase2'] =0;      
$_SESSION['id_centro'] =-10;      

//finaiza plazo inscripcion alumno
$_SESSION['fin_sol_alumno']=-1;

if($hoy==DIA_FIN_INSCRIPCION)
	$_SESSION['fin_inscripcion_centros']=1;

if($hoy<DIA_INICIO_INSCRIPCION)
	$_SESSION['dia_inicio_inscripcion']=0;
else $_SESSION['dia_inicio_inscripcion']=1;
//dia ultimo inscripcion alumno
if(DIA_MAX_SOL_ALUMNO==$hoy)
	$_SESSION['fin_sol_alumno']=1;//dia para solicitudes anonimas. -1. antes del perioodo 0.durante el perido normal de inscripcion, 1.dia maximo solicitud, 2.plazo finalizado
elseif($hoy>DIA_MAX_SOL_ALUMNO)
	$_SESSION['fin_sol_alumno']=2;
else	
	 $_SESSION['fin_sol_alumno']=0;

$_SESSION['nombre_centro'] = '9999';      
$_SESSION['nombre_usuario'] ="nousuario";    
$_SESSION['fecha_actual'] = date("Y/m/d");      
$_SESSION['estado_convocatoria'] =0;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
if($_SESSION['fecha_actual']<DIA_SORTEO) $_SESSION['sorteo'] = 0;      
else  $_SESSION['sorteo'] = 1;  
 
#if($_SESSION['fecha_actual']=='2020/05/21') //JUEVES 19 marzo) //BAREMACION: hasta 23 marzo inclusive
if($_SESSION['fecha_actual']==DIA_SORTEO) //JUEVES 19 marzo) //BAREMACION: hasta 23 marzo inclusive
 		$_SESSION['estado_convocatoria'] =1;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
elseif($_SESSION['fecha_actual']>DIA_SORTEO and $_SESSION['fecha_actual']<DIA_BAREMACION)
 		$_SESSION['estado_convocatoria'] =2;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
elseif($_SESSION['fecha_actual']==DIA_BAREMACION) //24 Marzo 12h publicacion solicitudes baremadas
 		$_SESSION['estado_convocatoria'] =21;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
elseif($_SESSION['fecha_actual']==DIA_PUBLICACION_BAREMACION) //24 Marzo 12h publicacion solicitudes baremadas
 		$_SESSION['estado_convocatoria'] =22;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
elseif($_SESSION['fecha_actual']>DIA_PUBLICACION_BAREMACION and $_SESSION['fecha_actual']<DIA_PROVISIONALES) //Reclamacion solicitudes baremadas
 		$_SESSION['estado_convocatoria'] =23;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
elseif($_SESSION['fecha_actual']>=DIA_PROVISIONALES and $_SESSION['fecha_actual']<DIA_DEFINITIVOS) //Periodo reclamacin provisionales
 		$_SESSION['estado_convocatoria'] =30;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
elseif($_SESSION['fecha_actual']==DIA_DEFINITIVOS) //jueves 16 abril
 		$_SESSION['estado_convocatoria'] =40;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
elseif($_SESSION['fecha_actual']>=DIA_SORTEO_FASE2) //jueves 16 abril
 		$_SESSION['estado_convocatoria'] =50;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
elseif($_SESSION['fecha_actual']>=DIA_FASE3) //jueves 16 abril
 		$_SESSION['estado_convocatoria'] =60;//0. inicio inscripciones, 1. dia de sorteo, 2. baremacion, 3. Provisionales, 4. Definitivos      
$_SESSION['fecha_inscripcion'] = date("2020/11/01");      
$_SESSION['fecha_iniccioprovisionales'] = date("2019/11/01");      
$_SESSION['fecha_inicciodefinitivas'] = date("2019/11/01");      
$_SESSION['url_base'] =URL_BASE;    
      

$conectar=new Conectar();
$conexion=$conectar->conexion();
header('Content-Type: text/html; charset=UTF-8');  
 // Define variables and initialize with empty values
$nombre_usuario = $clave = "";
$nombre_usuario_err = $clave_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Check if username is empty
     if(empty(trim($_POST["nombre_usuario"])))
{
         $nombre_usuario_err = 'Intro nombre de usuario';
} 
else
{
         $nombre_usuario = trim($_POST["nombre_usuario"]);
}
// Check if password is empty
if(empty(trim($_POST['clave'])))
{
   $clave_err = 'Intro clave';
} 
else
{
   $clave = trim($_POST['clave']);
}
   if(empty($nombre_usuario_err) && empty($clave_err))
   {
      $sql = "SELECT nombre_usuario, clave,rol,nombre_centro,id_centro,primera_conexion,num_sorteo,fase_sorteo FROM usuarios u left join centros c  ON u.id_usuario=c.id_usuario WHERE  u.nombre_usuario = ? and u.clave= ?";
      $sql_alumno = "SELECT id_centro_destino FROM usuarios u  join alumnos a on
   u.id_usuario=a.id_usuario where u.nombre_usuario= ?";
      if($stmt = $conexion->prepare($sql))
      {
      // Bind variables to the prepared statement as parameters
         $stmt->bind_param("ss", $param_usuario,$param_clave);
         // Set parameters
         $param_usuario = $nombre_usuario;
         $param_clave = md5($clave);
         // Attempt to execute the prepared statement
         if($stmt->execute())
         {
            // Store result
            $stmt->store_result();
               // Check if username exists, if yes then verify password
               if($stmt->num_rows == 1)
               {                    
                  // Bind result variables
                  $stmt->bind_result($nombre_usuario, $hashed_clave,$rol,$nombre_centro,$id_centro,$primera_conexion,$num_sorteo,$fase_sorteo);
                  if($stmt->fetch())
                  {
                     if(md5(strtoupper($clave))== $hashed_clave || md5($clave)== $hashed_clave)
                     {
                        $_SESSION['nombre_usuario'] = $nombre_usuario;      
                        $_SESSION['clave'] = $clave;      
                        $_SESSION['rol'] = $rol;  
                        $_SESSION['nombre_centro'] = $nombre_centro;      
                        $_SESSION['id_centro'] = $id_centro;
                        if($rol=='alumno')
                        {
                           if($stmt_alumno = $conexion->prepare($sql_alumno))
                           {
                           // Bind variables to the prepared statement as parameters
                              $stmt_alumno->bind_param("s", $param_usuario);
                              // Set parameters
                              $param_usuario = $nombre_usuario;
                              // Attempt to execute the prepared statement
                              if($stmt_alumno->execute())
                              {
                                 // Store result
                                 $stmt_alumno->store_result();
                                    // Check if username exists, if yes then verify password
                                    if($stmt_alumno->num_rows == 1)
                                    {                    
                                       // Bind result variables
                                       $stmt_alumno->bind_result($id_centro_destino);
                                       if($stmt_alumno->fetch())
                                       {
                                          $_SESSION['id_centro'] =
                                          $id_centro_destino;      
                                       }
                                    }
                              }
                           }
                        }    
                        $_SESSION['num_sorteo'] = $num_sorteo;      
                        $_SESSION['fase_sorteo'] = $fase_sorteo;
                        $_SESSION['usuario_autenticado'] =1;//si es un usuario autenticado o no      
                        if($rol=='centro' and  $primera_conexion=='si')
                           header("location: login_pconexion.php");
                        else
                           { 
                           if($_SESSION['fecha_actual']>=$_SESSION['fecha_inscripcion']) $_SESSION['estado']='inicioinscripcion';
                           else $_SESSION['estado']='inicioinscripcion';
                           //para usuarios del servicio provincial
                           if(strpos($_SESSION['rol'],'sp')!==FALSE) 
                           {	
                              $_SESSION['provincia']=substr($_SESSION['rol'],2);
                              $_SESSION['rol']='sp';
                              $_SESSION['sorteo_fase2']=1;
                           }
                           if($_SESSION['rol']=='admin') 
                              $_SESSION['sorteo_fase2']=1;
                           header("location: index.php");
                           }
                     } 
                  else
                  {
      // Display an error message if password is not valid
                  $password_err = 'Clave incorrecta';
                  print("Error ".$password_err);
                  }
               }
            } 
            else
            {
               // Display an error message if username doesn't exist
               $nombre_usuario_err = 'No existe una cuenta para este usuario'.$nombre_usuario.$hashed_clave;
            }
         }
         else
         {
            echo "Algo falló, prueba otra vez más tarde o habla con el administrador: lhueso@aragon.es";}
            $stmt->close();
      }
      else 
         {
            echo "No ha podido comprobarse las credenciales, prueba más tarde o consulta al administrador lhueso@aragon.es";
         }
   }
// Close connection
$conexion->close();
}
?>
    <!DOCTYPE html>

    <html lang="es">

    <head>

        <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acceso inscripciones estudios de Educación Especial</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{ 
width:450px;
padding: 28px;
    padding-top: 28px;
margin: auto;
padding-top: 120px;		
	}
input[type=text], input[type=password] {
    width: 450px;
    padding: 1px 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

@media screen and (max-width : 600px) {
            .wrapper{

width: 100%;
} 
input[type=text], input[type=password] {
    width: 100%;
}
}
        </style>

    </head>

    <body>
        <div class="wrapper">
            <h2>ADMISIÓN CENTROS EDUCACIÓN ESPECIAL CURSO 2020/2021</h2>
	<button type="button" class="btn btn-primary" id="csolicitud">Crear solicitud</button>

	<?php if(IPREMOTA==$_SERVER['HTTP_X_FORWARDED_FOR'] || DIA_INICIO_INSCRIPCION<=$hoy) { ?>
            <p>Introduce tu nombre de  usuario y contraseña</p>
            <form action="" method="post">
                <div class="form-group <?php echo (!empty($nombre_usuario_err)) ? 'has-error' : ''; ?>">
                    <label>Usuario</label>
                    <input type="text" name="nombre_usuario"class="form-control" value="<?php echo $nombre_usuario; ?>">
                    <span class="help-block"><?php echo $nombre_usuario_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($clave_err)) ? 'has-error' : ''; ?>">
                    <label>Clave</label>
                    <input type="password" name="clave" class="form-control">
                    <span class="help-block"><?php echo $clave_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Acceder con credenciales">
                </div>
            </form>
		<?php } else
			echo "<h1>PAGINA EN MANTENIMIENTO O CONVOCATORIA NO INICIADA</h1>";
		//	echo $_SERVER[REMOTE_ADDR];
		//	echo ":".IPREMOTA;
			?>
        </div>    

<footer class="page-footer font-small stylish-color-dark pt-4 mt-4">

    <!--Footer Links-->
    <div class="container text-center text-md-left">
        <div class="row">

    <hr>

    <!--Call to action-->
    <div class="text-center py-3">
        <ul class="list-unstyled list-inline mb-0">
            <li class="list-inline-item">
    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        Registro e incidencias:
        <a href="mailto:lhueso@aragon.es">lhueso@aragon.es </a>
        <a href="tel:976715444">976715444</a>
    </div>
            </li>
        </ul>
    </div>
    <hr>


</footer>
<!--/.Footer-->
    </body>

        <script src="js/login.js"></script>
    </html>


