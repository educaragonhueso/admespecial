<?php
session_start();
if(!isset($_SESSION)) exit(); 
include('includes/head.php');
?>
<html>
<body>
    <div class="wrapper">
        <div id="content">
	  <input type="hidden" id="estado_convocatoria" name="estado_estado_convocatoria" value="<?php echo $_SESSION['estado_convocatoria']; ?>"></input>
	  <span type="hidden" id="provincia" name="provincia" value="<?php echo $_SESSION['provincia'];?>"></span>
	  <span type="hidden" id="estado" name="estado" value="<?php echo $_SESSION['estado']; ?>"></span>

	<?php 
		if($_SESSION['inicio_prorroga']==1 and $_SESSION['rol']=='alumno' and $_SESSION['version']!='PRE')
		{
			echo "<p><b>
Desde la Dirección General de Panificación y Equidad se informa que de acuerdo con lo dispuesto en la disposición adicional tercera del Real Decreto 463/2020, de 14 de marzo, por el que se declara el estado de alarma para la gestión de la situación de crisis sanitaria ocasionada por el COVID-19, quedan suspendidos los procedimientos de escolarización vigentes en la Comunidad Autónoma de Aragón.</b>
<br>
Ello implica:
<ol>
	<li>
	El domingo 15 de marzo de 2020, los solicitantes podrán realizar solicitudes por internet.
	</li>
	<li>
	El lunes día 16 de marzo se suspenderá la presentación de las solicitudes.
	</li>
	<li>
	El proceso se retomará en cuanto las circunstancias lo permitan. Se recuperarán los dos días de presentación de solicitudes pendientes, así como el resto de fases del procedimiento.
	</li>
	<li>
	Se considerarán como válidas las solicitudes presentadas correctamente desde el día 11 al 15 de marzo.
	</li>
</ol>
</p>
";
			exit();
		}
		/* 
		if($_SESSION['estado_convocatoria']==4) 
			if($_SESSION['rol']=='admin' or $_SESSION['rol']=='sp')
			{
				include('includes/menusuperior.php');
	  			echo '<span type="hidden" id="provincia" name="provincia" value='.$_SESSION["provincia"].'><b>PROVINCIA: </b>'.$_SESSION["provincia"].'</b></span>'; 
			}
		*/
		if($_SESSION['version']=='PRE')	print_r($_SESSION);
	?>

	<?php echo "<br><b><i> AVISO IMPORTANTE: Si se va a imprimir la solicitud se recomienda el uso de cualquier navegador distinto de Mozilla-Firefox ya que puede dar problemas al imprimirla</i></b><br>";?>
	  <span type="hidden" id="rol" name="rol" value="<?php echo $_SESSION['rol']; ?>"><b>ROL: </b><?php echo $_SESSION['rol'];?></b></span> 
		<?php if($_SESSION['rol']=='centro') if($_SESSION['num_sorteo']!=0) echo "<br><b>Numero sorteo:</b> ".$_SESSION['num_sorteo'];else echo "<br><b>Sorteo No realizado</b> ";?>
		
		<?php if($_SESSION['rol']=='centro' or $_SESSION['rol']=='admin' or $_SESSION['rol']=='sp' or $_SESSION['rol']=='alumno')
		{
			if($_SESSION['rol']=='sp')
	  			echo '<span type="hidden" id="provincia" name="provincia" value='.$_SESSION["provincia"].'><b>PROVINCIA: </b>'.$_SESSION["provincia"].'</b></span>'; 
		 	include('includes/menusuperior.php');
		}
		?>
		<?php /*usamos metodo del controlador de centros activo echo $this->showTimeline('centro',$_SESSION['id_centro'],'matricula');*/?>
		<div class="row ">
		<div id="t_matricula" style="width:100%"></div>
		<?php /*usamos metodo del controlador de centros activo*/if($_SESSION['rol']=='centro') echo $this->showTabla('centro',$_SESSION['id_centro'],'matricula');?>
		<?php if($_SESSION['rol']=='admin') echo $this->showTablas($_SESSION['rol'],$_SESSION['id_centro'],'matricula','todas');?>
		<?php if($_SESSION['provincia']!='todas'){echo "sprovincial"; echo $this->showTablas($_SESSION['rol'],$_SESSION['id_centro'],'matricula',$_SESSION['provincia']);}?>
		<?php 
		if($_SESSION['rol']=='alumno' && $_SESSION['dia_inicio_inscripcion']==1)
		{
			if(isset($_SESSION['clave']))
	  			echo '<input type="hidden" id="pin" name="pin" value="'.$_SESSION['clave'].'" ></input> ';
			//echo '<a href="'.URL_BASE.'"><button class="btn btn-outline-info" id="inicio" type="button">INICIO</button></a>';
			echo '<br>';
			if($_SESSION['nombre_usuario']=='nousuario' and $_SESSION['fin_sol_alumno']!=2 and $_SESSION['fin_sol_alumno']!=-1)//usuario no autenticado
				{
				if($_SESSION['fin_sol_alumno']=='1')
					echo '<h2 style="padding-left:100px">ULTIMO DIA PARA INSCRIBIRSE!!!</h2>';
				//echo '<p style="padding-left:100px"><button class="btn btn-outline-info" id="nuevasolicitud" type="button">Nueva solicitud</button></p>';
				echo '<p style="padding-left:100px"><div id="nuevasolicitud"></div></p>';
				}
			elseif($_SESSION['nombre_usuario']=='nousuario' and $_SESSION['fin_sol_alumno']<'2') //fin inscripcion para ciudadano
				{
				echo '<h1>FINALIZADO PROCESO DE ADMISIÓN<br></h1>';
				if($_SESSION['fin_inscripcion_centros']==1) echo '<h1>DIRIGETE AL CENTRO PARA COMPLETAR LA INSCRIPCIÓN</h1>';
				}
			elseif($_SESSION['fin_sol_alumno']<2 and $_SESSION['nombre_usuario']!='nousuario')//autenticado en perirodo de inscripcion  alumno
				{
				echo '<button class="btn btn-outline-info calumno" id="versolicitud" type="button">Ver solicitud</button>';
				echo '<a id="imprimir" target="_blank"><input class="btn btn-primary imprimirsolicitud" style="background-color:brown;padding-left:20px" type="button" value="Vista Previa Impresion Documento"/></a>';
				}
		}
		elseif($_SESSION['dia_inicio_inscripcion']==0)
		{
				echo '<row><div class="col-12"><p><h1></h1></p></div></row>';
				echo '<row><p><h2></h2></p></row>';	
				echo '<p><h2></h2></p>';	
				echo '<main role="main" class="container">

			      <div class="starter-template">
				<h1>INCICIO DE INSCRIPCION</h1>
				<p class="lead">INSCRIPCIONES VIA WEB: DEL 11 al 16 de MARZO (inclusive)</p>
				<p class="lead">INSCRIPCIONES EN LOS CENTROS: DEL 11 al 17 de MARZO (inclusive)</p>
				<p class="lead"><i>En cualquier caso los impresos hay que entregarlos en el centro firmados</i></p>
				<a href="'.URL_BASE.'"><button class="btn btn-outline-info" id="inicio" type="button">VOLVER</button></a>    </div>

			    </main><!-- /.container -->';
		}
		?>
		</div>
		<div class="row ">
		<div id="l_matricula" style="width:100%"></div>
		</div>
        </div>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
		<script>
			$( document ).ready(function() {
			 $( "#nuevasolicitud" ).trigger( "click" );
			 $( "#versolicitud" ).trigger( "click" );
 			});

			$( "#imprimir" ).click(function() {
			 var idsolicitud=$("form").attr("id");
			 idsolicitud=idsolicitud.replace("fsolicitud","");
			 window.open("imprimirsolicitud.php?id="+idsolicitud);
			});
		</script>
</body>
</html>
