<?php if(isset($_SESSION['provincia'])) {$provincia=$_SESSION['provincia'];} else $provincia='ARAGON';?>            
<h2 style='text-align:center;'>ADMISION ALUMNOS GUARDERIAS Curso 2020/2021 </h2>
		 <p hidden id='id_centro'><?php echo $_SESSION['id_centro'];?></p> 
		 <p hidden id='estado_convocatoria'><?php echo $_SESSION['estado_convocatoria'];?></p> 
		 <p hidden id='id_sorteo'><?php echo $_SESSION['sorteo'];?></p> 
		 <p hidden id='sorteo_fase2'><?php echo $_SESSION['sorteo_fase2'];?></p> 
<!--elementos a la izda-->
<nav id='navgir' class="navbar navbar-expand-md navbar-dark bg-dark">
        <ul class="navbar-nav mr-auto">
         <li class="nav-item  msuperior">
            <a style='color:white!important;float:left!important;padding-top:9px'  href='<?php echo $_SESSION['url_base'];?>'>INICIO</a>
         </li>
         <li class="nav-item active msuperior dropdown">
            <a class="nav-link dropdown-toggle desplegable" id="navbardrop" data-toggle="dropdown">Documentación</a>
				   <div class="dropdown-menu">
				   <?php 
                     echo '<a class="dropdown-item" href="documentacion/a2_1c_2021.pdf" id="doca21c" target="_blank">ANEXO II- Solicitud ingreso (pdf)</a>';
                     echo '<a class="dropdown-item" href="documentacion/a3_1c.pdf" id="doca31c" target="_blank">ANEXO III- Baja o excedencia (pdf)</a>';
                     echo '<a class="dropdown-item" href="documentacion/a4_1c.pdf" id="doca31c" target="_blank">ANEXO IV- Renta familiares (pdf)</a>';
                     echo '<a class="dropdown-item" href="documentacion/boa14f20201c.pdf" id="docboa1c" target="_blank">BOA 14 febrero (pdf)</a>';
                     echo '<a class="dropdown-item" href="documentacion/res_guarderias_anexos_29052020.pdf" id="docresboa1c" target="_blank">Resolución BOA 29 Mayo (pdf)</a>';
               if($_SESSION['rol']!='alumno')
               {
                     echo '<a class="dropdown-item" href="documentacion/plantilla_matriculaguarderias.csv" id="docinst" target="_blank">Plantilla matrícula guarderías (csv)</a>';
               }
               ?>
      
				   </div>
            </li>
        </ul>
<!--elementos a la derecha-->
   <ul class="navbar-nav">
<?php 
      echo '<li class="nav-item msuperior">';
         echo '<a class="nav-link" href="#" id="show_mapacentros">Mapa Centros</a>';
      echo '</li>';
   if($_SESSION['usuario_autenticado'])
   {
      if($_SESSION['rol']!='alumno')
      {
      echo '<li class="nav-item msuperior dropdown">';
         echo '<a class="show_provisionales nav-link dropdown-toggle desplegable"
               id="navbardrop" data-toggle="dropdown" href="#">Exportar datos</a>';
         echo '<div class="dropdown-menu">';
            echo '<a class="exportpdf dropdown-item" href="#" id="pdf_usu" data-tipo="pdf" data-subtipo="pdf_usu">Listado usuarios (pdf)  </a>';
               if($_SESSION['rol']=='admin' or $_SESSION['rol']=='sp' or $_SESSION['rol']=='centro')
               { 
                  echo '<a class="dropdown-item" href="/guarderias/documentacion/vac_prov_def.pdf" target="_blank" id="pdf_vacantes" data-tipo="pdf" data-subtipo="pdf_vac">Listado vacantes provisional y definitivo (pdf)  </a>';
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_mat" data-tipo="csv" data-subtipo="csv_mat">Listado vacantes (csv)  </a>';
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_tri" data-tipo="csv" data-subtipo="csv_tri">Listado tributantes (csv)  </a>';
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_a4" data-tipo="csv" data-subtipo="csv_a4">Listado tributantes Anexo4 (csv)  </a>';
               }
               if($_SESSION['rol']=='centro')
               { 
                  echo '<a class="exportpdf dropdown-item" href="#" id="pdf_mat" data-tipo="pdf" data-subtipo="pdf_mat">Listado vacantes (pdf) </a>';
               }
               echo '<a class="exportcsv dropdown-item" href="#" id="csv_sol"
                     data-tipo="csv" data-subtipo="csv_sol">Listado solicitudes (csv)</a>';
               //echo '<a class="exportcsv dropdown-item" href="#" id="csv_pro" data-tipo="csv" data-subtipo="csv_pro">Listado alumnos promocionan (csv)</a>';
            
               if($_SESSION['provincia']!='todas' or $_SESSION['rol']=='admin')
               { 
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_dup" data-tipo="csv" data-subtipo="csv_dup">Listado duplicados (csv) </a>';
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_dup" data-tipo="csv" data-subtipo="csv_fase2">Listado Fase 2 (csv) </a>';
                  echo '<a class="exportcsv dropdown-item" href="#" id="csv_dup" data-tipo="csv" data-subtipo="csv_fase3">Listado Fase 3 (csv) </a>';
               }
         echo '</div>';
      echo '</li>';
      
   if($_SESSION['matricula']==1)
   {
      echo '<li class="nav-item active msuperior">';
         echo '<a class="show_matricula nav-link" href="#">Matricula</a>';
      echo '</li>';
   }
      echo '<li class="nav-item active msuperior">';
         echo '<a class="show_solicitudes nav-link" href="#">Solicitudes</a>';
      echo '</li>';
      }

   if($_SESSION['estado_convocatoria']>=1 and $_SESSION['usuario_autenticado']==1){?>
                            <li class="nav-item active msuperior dropdown" id="msorteo">
				<?php if($_SESSION['estado_convocatoria']>=21){?>
                                <a class="show_provisionales nav-link dropdown-toggle desplegable2" id="navbardrop" data-toggle="dropdown" href="#">Listas baremadas</a>
				 <div class="dropdown-menu">
            
				<?php if($_SESSION['rol']!='alumno'){?>
				 <a class="lgenerales dropdown-item" href="#" id="sor_ale" data-subtipo="sor_ale" data-tipo="sorteo">Numero aleatorio </a>
				 <a class="lgenerales dropdown-item" href="#" data-tipo="sorteo" data-subtipo="sor_bar">Solicitudes baremadas provisional</a>
				 <a class="lgenerales dropdown-item" href="#" data-tipo="sorteo" data-subtipo="sor_bardef">Solicitudes baremadas definitiva</a>
				 <a class="lgenerales dropdown-item" href="#" data-tipo="sorteo" data-subtipo="sor_det">Detalle baremo</a>
				<?php }?>
				<?php if($_SESSION['rol']=='alumno'){?>
				 <a class="lgenerales dropdown-item" href="#" data-tipo="sorteo" data-subtipo="sor_bar">Solicitudes baremadas provisional</a>
				<?php }?>
				 </div>
				<?php }?>
                            </li>
		<?php if(($_SESSION['estado_convocatoria']<=30 and $_SESSION['estado_convocatoria']>22)  or $_SESSION['fase_sorteo']==2 or $_SESSION['rol']=='sp' or $_SESSION['rol']=='centro' or $_SESSION['rol']=='admin') {?>
             <li class="nav-item active msuperior dropdown" id="mtributantes">
                <a class="show_tributantes nav-link" id="navbardrop" data-toggle="dropdow" href="#">Datos Tributantes</a>
            </li>
             <li class="nav-item active msuperior dropdown" id="mprovisional">
                <a class="show_provisionales nav-link dropdown-toggle desplegable2" id="navbardrop" data-toggle="dropdown" href="#">Provisional</a>
                <div class="dropdown-menu">
                   <a class="lprovisionales dropdown-item" href="#" data-subtipo="admitidos_prov">Admitidos provisional</a>
                   <a class="lprovisionales dropdown-item" href="#" data-subtipo="noadmitidos_prov">No admitidos provisional</a>
                   <a class="lprovisionales dropdown-item" href="#" data-subtipo="excluidos_prov">Excluidos provisional</a>
                </div>
            </li>
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
		<?php }?>
		<?php if(($_SESSION['rol']=='admin' or $_SESSION['rol']=='sp' or $_SESSION['rol']=='centro') and $_SESSION['estado_convocatoria']>30) {?>
              <li class="nav-item active msuperior dropdown" id="mdefinitivo">
                  <a class="nav-link dropdown-toggle desplegable2" id="navbardrop" data-toggle="dropdown" href="#">FASEII</a>
		            <div class="dropdown-menu">
                     <a class="show_anexo4 nav-link" id="navbardrop" data-toggle="dropdow" href="#">Confirmar Tributantes</a>
				      </div>
              </li>
		<?php }?>
			<?php }?>
	<?php }?>
        </ul>
</nav>
<?php 

//if($_SESSION['id_centro']<=1 and $_SESSION['id_centro']>=-2) 
//echo '<input class="form-control" id="fcentrosadminzgz" placeholder="Introduce datos del centro a suplantar" type="text">';
?>
