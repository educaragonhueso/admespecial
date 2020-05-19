<?php if(isset($_SESSION['provincia'])) {$provincia=$_SESSION['provincia'];} else $provincia='ARAGON';?>            
<h2 style='text-align:center;'>ADMISION ALUMNOS EDUCACION ESPECIAL <?php echo strtoupper($provincia);?></h2>
		 <p hidden id='id_centro'><?php echo $_SESSION['id_centro'];?></p> 
		 <p hidden id='estado_convocatoria'><?php echo $_SESSION['estado_convocatoria'];?></p> 
		 <p hidden id='id_sorteo'><?php echo $_SESSION['sorteo'];?></p> 
		 <p hidden id='sorteo_fase2'><?php echo $_SESSION['sorteo_fase2'];?></p> 
<!--elementos a la izda-->
<nav id='navgir' class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
                            <li class="nav-item  msuperior">
            			<a
style='color:white!important;float:left!important;padding-top:9px'  href='<?php
echo $_SESSION['url_base'];?>'>INICIO</a>
                            </li>
                            <li class="nav-item active msuperior dropdown">
                                <a class="nav-link dropdown-toggle desplegable" id="navbardrop" data-toggle="dropdown">Documentación</a>
				 <div class="dropdown-menu">
				 <a class="dropdown-item" href="documentacion/a4modsol.pdf" id="doca4" target="_blank">Modelo solicitud autorrellenable (anexoIV)</a>
				 <?php if($_SESSION['rol']!='alumno') echo '<a class="dropdown-item"
href="documentacion/InstruccionesEEspecial.pdf" id="docinst"
target="_blank">Instrucciones Admisión Eduación Especial</a>';?>
      
				 </div>
                            </li>
        </ul>
    </div>
<!--elementos a la derecha-->
    <div class="mx-auto order-0">
    <!--espacio para el centro-->
    </div>
 <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
   <ul class="navbar-nav ml-auto">
<?php 
   if($_SESSION['usuario_autenticado'])
   {
      if($_SESSION['rol']!='alumno')
      {
      echo '<li class="nav-item msuperior dropdown">';
         echo '<a class="show_provisionales nav-link dropdown-toggle desplegable"
               id="navbardrop" data-toggle="dropdown" href="#">Exportar datos</a>';
         echo '<div class="dropdown-menu">';
            echo '<a class="exportpdf dropdown-item" href="#" id="pdf_usu" data-tipo="pdf" data-subtipo="pdf_usu">Listado usuarios (pdf)  </a>';
               if($_SESSION['rol']=='admin')
               { 
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_mat" data-tipo="csv" data-subtipo="csv_mat">Listado vacantes (csv)  </a>';
                  echo '<a class="exportcsv dropdown-item" href="#"
id="csv_tri" data-tipo="csv" data-subtipo="csv_tri">Listado tributantes (csv)  </a>';
               }
               if($_SESSION['rol']=='centro')
               { 
                  echo '<a class="exportpdf dropdown-item" href="#" id="pdf_mat" data-tipo="pdf" data-subtipo="pdf_mat">Listado vacantes (pdf) </a>';
               }
               echo '<a class="exportcsv dropdown-item" href="#" id="csv_sol"
                     data-tipo="csv" data-subtipo="csv_sol">Listado solicitudes (csv)</a>';
               echo '<a class="exportcsv dropdown-item" href="#" id="csv_pro"
                     data-tipo="csv" data-subtipo="csv_pro">Listado alumnos promocionan (csv)</a>';
            
               if($_SESSION['provincia']!='todas' or $_SESSION['rol']=='admin')
               { 
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_dup" data-tipo="csv" data-subtipo="csv_dup">Listado duplicados (csv) </a>';
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_dup" data-tipo="csv" data-subtipo="csv_fase2">Listado Fase 2 (csv) </a>';
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_dup" data-tipo="csv" data-subtipo="csv_fase3">Listado Fase 3 (csv) </a>';
               }
         echo '</div>';
      echo '</li>';
      echo '<li class="nav-item msuperior">';
         echo '<a class="show_mapacentros nav-link" href="mapacentros.php"
target="_blank">Mapa Centros</a>';
      echo '</li>';
      echo '<li class="nav-item active msuperior">';
         echo '<a class="show_matricula nav-link" href="#">Matricula</a>';
      echo '</li>';
      echo '<li class="nav-item active msuperior">';
         echo '<a class="show_solicitudes nav-link" href="#">Solicitudes</a>';
      echo '</li>';
      }
   if($_SESSION['estado_convocatoria']>=1){?>
                            <li class="nav-item active msuperior dropdown" id="msorteo">
				<?php if($_SESSION['sorteo']==1){?>
                                <a class="show_provisionales nav-link dropdown-toggle desplegable2" id="navbardrop" data-toggle="dropdown" href="#">Sorteo</a>
				 <div class="dropdown-menu">
				 <a class="lgenerales dropdown-item" href="#" id="sor_ale" data-subtipo="sor_ale" data-tipo="sorteo">Numero aleatorio </a>
				 <a class="lgenerales dropdown-item" href="#" data-tipo="sorteo" data-subtipo="sor_bar">Solicitudes baremadas</a>
				 <a class="lgenerales dropdown-item" href="#" data-tipo="sorteo" data-subtipo="sor_det">Detalle baremo</a>
				 </div>
				<?php }?>
                            </li>
		<?php if(($_SESSION['estado_convocatoria']<=30 and $_SESSION['estado_convocatoria']>=1)  or $_SESSION['fase_sorteo']==2) {?>
                            <li class="nav-item active msuperior dropdown" id="mprovisional">
                                 <a class="show_provisionales nav-link dropdown-toggle desplegable2" id="navbardrop" data-toggle="dropdown" href="#">Provisional</a>
				 <div class="dropdown-menu">
				 <a class="lprovisionales dropdown-item" href="#" data-subtipo="admitidos_prov">Admitidos provisional</a>
				 <a class="lprovisionales dropdown-item" href="#" data-subtipo="noadmitidos_prov">No admitidos provisional</a>
				 <a class="lprovisionales dropdown-item" href="#" data-subtipo="excluidos_prov">Excluidos provisional</a>
																		 </div>
                            </li>
			<?php }?>
		<?php if($_SESSION['estado_convocatoria']>=30){?>
                            <li class="nav-item active msuperior dropdown" id="mdefinitivo">
                                 <a class="show_definitivos nav-link dropdown-toggle desplegable2" id="navbardrop" data-toggle="dropdown" href="#">Definitivos</a>
		                 <div class="dropdown-menu">
				 <a class="ldefinitivos dropdown-item" href="#" data-subtipo="admitidos_def">Admitidos definitivo</a>
				 <a class="ldefinitivos dropdown-item" href="#" data-subtipo="noadmitidos_def">No admitidos definitivo</a>
				 <a class="ldefinitivos dropdown-item" href="#" data-subtipo="excluidos_def">Excluidos definitivo</a>
				 </div>
                            </li>
		<?php }?>
		<?php if(($_SESSION['rol']=='admin' or $_SESSION['rol']=='sp') and $_SESSION['estado_convocatoria']>30) {?>
                            <li class="nav-item active msuperior dropdown" id="mdefinitivo">
                                 <a class="nav-link dropdown-toggle desplegable2" id="navbardrop" data-toggle="dropdown" href="#">FASEII</a>
		                 <div class="dropdown-menu">
				 <a class="lfase2 dropdown-item" href="#" data-subtipo="lfase2_sol_ebo">Listado Solicitudes fase2 EBO</a>
				 <a class="lfase2 dropdown-item" href="#" data-subtipo="lfase2_sol_tva">Listado Solicitudes fase2 TVA</a>
				 </div>
                            </li>
                            <li class="nav-item active msuperior dropdown" id="mdefinitivo">
                                 <a class="nav-link dropdown-toggle desplegable2" id="navbardrop" data-toggle="dropdown" href="#">FASEIII</a>
		                 <div class="dropdown-menu">
				 <a class="lfase3 dropdown-item" href="#" data-subtipo="lfase3_sol_ebo">Listado Solicitudes fase3 EBO</a>
				 <a class="lfase3 dropdown-item" href="#" data-subtipo="lfase3_sol_tva">Listado Solicitudes fase3 TVA</a>
				 </div>
                            </li>
		<?php }?>
		<?php }?>
	<?php }?>
        </ul>
    </div>
</nav>
<?php 
if($_SESSION['id_centro']<=1 and $_SESSION['id_centro']>=-2) 
echo '<input class="form-control" id="fcentrosadminzgz" placeholder="Introduce datos del centro a suplantar" type="text">';
?>