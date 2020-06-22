<?php
session_start();
//if(!isset($_SESSION)) exit(); 
include('includes/head.php');
if($_SESSION['version']=='PRE') print_r($_SESSION);
?>
<html>
<body>
    <div class="wrapper">
        <div id="content">
	  <input type="hidden" id="estado_convocatoria" name="estado_estado_convocatoria" value="<?php echo $_SESSION['estado_convocatoria']; ?>"></input>
	  <span type="hidden" id="provincia" name="provincia" value="<?php echo $_SESSION['provincia'];?>"></span>
	  <span type="hidden" id="estado" name="estado" value="<?php echo $_SESSION['estado']; ?>"></span>

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
        <div id="mapcontrol" style='display:none' >
          <input id="address" type="text" value="Aragón">
          <input type="button" value="Geocode"  onclick="codeAddress()">
        </div>
      <div id="map-canvas" style="height:90%;top:30px"></div>
		<div class="row ">
		<div id="t_matricula" style="width:100%"></div>
      </div>
		<div class="row ">
		<div id="t_matricula" style="width:100%"></div>
		<?php /*usamos metodo del controlador de centros activo*/
      //      if($_SESSION['rol']=='centro') 
        //       echo $this->showTabla('centro',$_SESSION['id_centro'],'matricula');
      ?>
		<?php if($_SESSION['rol']=='admin') 
               #echo $this->showTablas($_SESSION['rol'],$_SESSION['id_centro'],'matricula','todas');
      ?>
		<?php if($_SESSION['provincia']!='todas')
            {
               echo "sprovincial"; 
               echo $this->showTablas($_SESSION['rol'],$_SESSION['id_centro'],'matricula',$_SESSION['provincia']);
            }
      ?>
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
			elseif($_SESSION['nombre_usuario']=='nousuario' and $_SESSION['fin_sol_alumno']=='2') //fin inscripcion para ciudadano
				{
				if($_SESSION['fin_inscripcion_centros']==1) echo '<h1>DIRIGETE AL CENTRO PARA COMPLETAR LA INSCRIPCIÓN</h1>';
				}
			elseif($_SESSION['nombre_usuario']!='nousuario' and $_SESSION['fin_sol_alumno']>0)//autenticado en perirodo de inscripcion  alumno
				{
			   //echo '<b>La solicitud no se puede modificar en la web, deberás dirigrte al centro para ello</b>';
         	}
		}
		elseif($_SESSION['dia_inicio_inscripcion']==0 and $_SESSION['rol']=='alumno')
		{
				echo '<row><div class="col-12"><p><h1></h1></p></div></row>';
				echo '<row><p><h2></h2></p></row>';	
				echo '<p><h2></h2></p>';	
				echo '<main role="main" class="container">

			      <div class="starter-template">
				<h1>INICIO INSCRIPCION</h1>
				<p class="lead">INSCRIPCIONE VIA WEB: DEL 8 al 11 de Junio jueves (ambos inclusive)</p>
				<p class="lead">INSCRIPCIONES EN LOS CENTROS: DEL 8 al 12 de Junio viernes (inclusive)</p>
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
			 $( ".show_solicitudes" ).trigger( "click" );
			 $( "#nuevasolicitud" ).trigger( "click" );
			 $( "#versolicitud" ).trigger( "click" );
			 $( "#versolicitud" ).remove();
 			});

			$( "#imprimir" ).click(function() {
			 var idsolicitud=$("form").attr("id");
			 idsolicitud=idsolicitud.replace("fsolicitud","");
			 window.open("imprimirsolicitud.php?id="+idsolicitud);
			});
		</script>
</body>
</html>
