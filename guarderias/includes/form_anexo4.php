<?php
$formsolanexo4='<tr style="width:1300px"><td colspan="12" style="width:inherit"><div class="container anexo4" id="tablasolicitud">
<div class="row">
<div class="col-md-12 mb-md-0 mb-5">
<form lang="es" id="fsolicitud"  class="was-validated formsolicitud"  name="contact-form"  method="POST">';

if($rol!='alumno')
{
/*
$formsol.=
'<!--INICIO SECCION ESTADO-->
<p type="button" class="btn btn-primary bform" data-toggle="collapse" data-target="#estadosol">ESTADO<span> <i class="fas fa-angle-down"></i></span></p>
<div id="estadosol" class="collapse">
<!--INICIO FILA ESTADO-->
                <div class="row formrow">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
				<p>Fase solicitud</p>
				<div class="radio">
				<label><input type="radio" name="fase_solicitud" value="borrador">BORRADOR</label>
				</div>
				<div class="radio">
				<label><input type="radio" name="fase_solicitud" value="validada">VALIDADA</label>
				</div>
				<div class="radio">
				<label><input type="radio" name="fase_solicitud" value="baremada">BAREMADA</label>
				</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-0">
				<p>Estado solicitud</p>
				<div class="radio">
				<label><input type="radio" name="estado_solicitud" value="duplicada">DUPLICADA</label>
				</div>
				<div class="radio">
				<label><input type="radio" name="estado_solicitud" value="irregular">IRREGULAR</label>
				</div>
				<div class="radio">
				<label><input type="radio" name="estado_solicitud" value="apta">APTA</label>
				</div>
                        </div>
                    </div>
                </div>
<!--FIN FILA DATOS-->
</div>
<!--FIN SECCION ESTADO-->';
*/
}
/*
$formsol.=
'<!--INICIO SECCION DATOS-->
<p type="button" class="btn btn-primary bform" data-toggle="collapse" data-target="#personales">DATOS PERSONALES<span> <i class="fas fa-angle-down"></i></span></p>
<div id="personales" class="collapse">
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-4">
                        <div class="md-form mb-0">
			    Primer apellido*
                            <input type="text" id="apellido1" value="" name="apellido1" placeholder="Primer apellido"  class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form mb-0">
			    Segundo apellido
                            <input type="text" id="apellido2" value="" name="apellido2" placeholder="Segundo apellido"  class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form mb-0">
					Nombre*
                            <input type="text" id="nombre" value="" name="nombre" placeholder="Nombre"  class="form-control" required>
                        </div>
                    </div>
                </div>
<!--FIN FILA DATOS-->
		<br>
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                      	    DNI/NIE Alumno 
                            <input type="text" id="dni_alumno" value="" name="dni_alumno" placeholder="DNI/NIE alumno" pattern="[a-zA-Z0-9]{9}" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form mb-0">
      Fecha de nacimiento*
                            <input type="date" id="fnac" value="" name="fnac" placeholder="Fecha Nacimiento" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
			Nacionalidad
                        <div class="md-form mb-0" data-tip="This is the text of the tooltip2">
                            <input type="text" id="nacionalidad" value="" name="nacionalidad" placeholder="Nacionalidad" class="form-control" title="paises" data-toggle="tooltip">
                        </div>
                    </div>

                </div>
<!--FIN FILA DATOS-->
		<br>
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-8">
                        <div class="md-form mb-0">
			    Nombre y apellidos madre/padre o tutor*
                            <input type="text" id="datos_tutor1" value="" name="datos_tutor1" placeholder="Nombre y apellidos madre/padre o tutor" class="form-control is-valid" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form mb-0">
			    NIF/NIE madre/padre o tutor/a*
                            <input type="text" id="dni_tutor1" value="" name="dni_tutor1" placeholder="NIF/NIE Tutor" pattern="[0-9a-zA-Z]{9}" class="form-control" required>
                        </div>
                    </div>

                </div>
<!--FIN FILA DATOS-->
		<br>
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-8">
                        <div class="md-form mb-0">
			    Nombre y apellidos madre/padre o tutor
                            <input type="text" id="datos_tutor2" value="" name="datos_tutor2" placeholder="Nombre y apellidos madre/padre o tutor" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form mb-0">
			NIF/NIE madre/padre o tutor/a
			<input type="text" id="dni_tutor2" value="" name="dni_tutor2" placeholder="NIF/NIE tutor"   pattern="[0-9a-zA-Z]{9}"  class="form-control">
                        </div>
                    </div>

                </div>
		<br>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-5">
                        <div class="md-form mb-0">
			    Calle/Plaza/Avenida domicilio familiar*
                            <input type="text" id="calle_dfamiliar" value="" name="calle_dfamiliar" placeholder="Calle/Plaza/Avenida" class="form-control is-valid">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
			Número*
			<input type="text" id="num_dfamiliar" value="" name="num_dfamiliar"  placeholder="Nº" pattern="[0-9]{1,3}"  class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
			Piso/Casa*
			<input type="text" id="piso_dfamiliar" value="" name="piso_dfamiliar"  placeholder="Piso/Casa" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
			Codigo Postal*
			<input type="text" id="cp_dfamiliar" value="" name="cp_dfamiliar" placeholder="CP" pattern="[0-9]{5}"  class="form-control">
                        </div>
                    </div>

                </div>
		<br>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                           Localidad*
                           <input type="text" id="loc_dfamiliar" value="" name="loc_dfamiliar" placeholder="Localidad"   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                           Telefono madre/tutora*
                           <input type="tel" id="tel_dfamiliar1" value="" name="tel_dfamiliar1" placeholder="Telefono 1" pattern="[0-9]{9}" class="form-control is-valid">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                           Teléfono padre/tutor
                           <input type="tel" id="tel_dfamiliar2" value="" name="tel_dfamiliar2"  placeholder="Telefono 2" pattern="[0-9]{9}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                           Correo electrónico
                           <input type="email" id="email" value="" name="email"  placeholder="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control">
                        </div>
                    </div>
                </div>
		<br>
<!--FIN FILA DATOS-->
</div>
<!--FIN SECCION DATOS-->
<!--INICIO SECCION DATOS: EXPONE-->
<p type="button" class="btn btn-primary bform" data-toggle="collapse" data-target="#expone">EXPONE<span> <i class="fas fa-angle-down"></i></span></p>
<div id="expone" class="collapse">
		<br>
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-4">
                            <input type="checkbox" class="check_hadmision" id="hermanosadmision" value="0" name="num_hadmision" placeholder="" data-target="thermanosadmision" >Hermanos en el proceso de admisión
                    </div>
                </div>
<!--FIN FILA DATOS-->
<br>
<div class="row" id="thermanosadmision" style="display:none">

<!--INICIO FILA DATOS-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_datos_admision1" value="" name="hermanos_datos_admision1" placeholder="Apellidos Nombre hermano" class="form-control">
                            <input type="hidden" id="hermanos_id_registro_admision1" value="0" name="hermanos_id_registro_admision1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="date" id="hermanos_fnacimiento_admision1" value="" name="hermanos_fnacimiento_admision1" placeholder="Fecha Nacimiento" class="form-control" data-idhadmision="0">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_hcurso_admision1" value="" name="hermanos_hcurso_admision1" placeholder="Curso solicitado" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_nivel_educativo_admision1" value="" name="hermanos_nivel_educativo_admision1" placeholder="Nivel educativo" class="form-control" data-idhadmision="0">
                        </div>
                    </div>

                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_datos_admision2" value="" name="hermanos_datos_admision2" placeholder="Apellidos Nombre hermano" class="form-control" >
                            <input type="hidden" id="hermanos_id_registro_admision2" value="0" name="hermanos_id_registro_admision2">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="date" id="hermanos_fnacimiento_admision2" value="" name="hermanos_fnacimiento_admision2" placeholder="Fecha Nacimiento" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_hcurso_admision2" value="" name="hermanos_hcurso_admision2" placeholder="Curso solicitdado" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_nivel_educativo_admision2" value="" name="hermanos_nivel_educativo_admision2" placeholder="Nivel educativo" class="form-control">
                        </div>
                    </div>

                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_datos_admision3" value="" name="hermanos_datos_admision3" placeholder="Apellidos Nombre hermano" class="form-control" >
                            <input type="hidden" id="hermanos_id_registro_admision3" value="0" name="hermanos_id_registro_admision3">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="date" id="hermanos_fnacimiento_admision3" value="" name="hermanos_fnacimiento_admision3" placeholder="Fecha Nacimiento" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_hcurso_admision3" value="" name="hermanos_hcurso_admision3" placeholder="Curso solicitdado" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="hermanos_nivel_educativo_admision3" value="" name="hermanos_nivel_educativo_admision3" placeholder="Nivel educativo" class="form-control" >
                        </div>
                    </div>

                </div>
<!--FIN FILA DATOS-->
</div>
</div>
<!--FIN SECCION EXPONE-->
<!--INICIO SECCION DATOS: SOLICITA-->
<p type="button" class="btn btn-primary bform" data-toggle="collapse" data-target="#solicita" aria-controls="solicita">SOLICITA<span> <i class="fas fa-angle-down"></i></span></p>
<div id="solicita" class="collapse">
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
			                   Centro solicitado
                            <input type="text"  id="id_centro_destino" value="" name="id_centro_destino" placeholder="Centro estudios solicitado" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
			                  Localidad centro solicitado
			                  <input type="text" id="loc_centro_destino" value="" name="loc_centro_destino" placeholder="Localidad centro"  class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                     		Provincia centro solicitado
				               <div class="form-group">
					               <select class="form-control" name="prov_centro_destino" id="prov_centro_destino" value="">
                                  <option>Zaragoza</option>
                                  <option>Teruel</option>
                                  <option>Huesca</option>
                              </select>
                           </div>
                        </div>
                    </div>
                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                   <div class="col-md-12">
                     <div class="md-form mb-0">
                        <input type="checkbox" id="sol_plaza" value="0" name="sol_plaza"  >
                           <label for="sol_plaza">Solicita una de las plazas a disposición para Alumnos/as con Necesidad Específica de Apoyo Educativo </label>
                     </div>
                   </div>
                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                   <div class="col-md-12">
                     <div class="md-form mb-0">
                        <input type="checkbox" id="sol_vacantes" value="0" name="sol_vacantes"  >
                           <label for="sol_vacantes">En caso de no ser admitido/a, estoy interesado/a en obtener plaza en posibles vacantes de otro centro en el que no se hayan cubierto las plazas (art. Octavo.3) </label>
                     </div>
                   </div>
                </div>
<!--FIN FILA DATOS-->
<br>
<!--INICIO FILA DATOS-->
                  <div class="row formrow">
         	         <div class="col-md-5 offset-md-1">
          	            <div class="md-form mb-0">
                           <div class="radio">
                           <label><b>CURSO/AÑOS</b></label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="tipoestudios" value="2020" >0 (2020)</label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="tipoestudios" value="2019">1 (2019)</label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="tipoestudios" value="2018">2 (2018)</label>
                           </div>
				            </div>
				         </div>
         	         <div class="col-md-3">
          	            <div class="md-form mb-0">
                           <div class="radio">
                           <label><b>HORARIO ENTRADA</b></label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="hore" value="7:45" >7:45</label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="hore" value="8:30">8:30</label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="hore" value="9:00">9:00</label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="hore" value="9:30">9:30</label>
                           </div>
				            </div>
				         </div>
         	         <div class="col-md-3">
          	            <div class="md-form mb-0">
                           <div class="radio">
                           <label><b>HORARIO SALIDA</b></label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="hors" value="13:00" >13:00</label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="hors" value="16:00">16:00</label>
                           </div>
                           <div class="radio">
                              <label><input type="radio" name="hors" value="17:00">17:00</label>
                           </div>
				            </div>
				         </div>
			         </div>
<!--FIN FILA DATOS-->
<br>
</div>
<!--INICIO FILA DATOS-->
<!--FIN SECCION SOLICITA-->

<!--INICIO SECCION DATOS: BAREMO-->
<p type="button" class="btn btn-primary bform crojo" id="labelbaremo" data-toggle="collapse" data-target="#baremo">BAREMO<span> <i class="fas fa-angle-down"></i></span>
<span>PUNTOS BAREMO TOTALES:<span id="id_puntos_baremo_totales">0</span> 
<span>PUNTOS BAREMO VALIDADOS:<span id="id_puntos_baremo_validados">0</span> 
</p>
	<input type="hidden" name="baremo_puntos_totales" value="0" id="btotales" class="bhiden">
	<input type="hidden" name="baremo_puntos_validados" value="0" id="bvalidados" class="bhiden">
<div id="baremo" class="collapse">
<!--INICIO FILA DATOS-->
	      <div class="row formrow">
            <div class="col-md-4">
               <div class="md-form mb-0">
                  <input type="checkbox" id="baremo_sitlaboral" value="0" name="baremo_sitlaboral" data-baremo="4" >
                     <label  for="hermanos_baremo">Situación laboral en activo de todos los progenitores o tutores legales del alumno/a</label>
               </div>
                        <input type="hidden" id="baremo_validar_sitlaboral" value="0" name="baremo_validar_sitlaboral">
                        <button name="boton_baremo_validar_sitlaboral" type="button" class="btn btn-outline-dark">Validar situación laboral</button>
            </div>
            <div class="col-md-4">
               <div class="md-form mb-0">
                  <input type="checkbox" id="baremo_tutores_centro" value="0" name="baremo_tutores_centro" data-baremo="1" >
                     <label  for="hermanos_baremo">Padre/madre/tutor trabaja en el centro</label>
               </div>
                        <input type="hidden" id="baremo_validar_tutores_centro" value="0" name="baremo_validar_tutores_centro">
                        <button name="boton_baremo_validar_tutores_centro" type="button" class="btn btn-outline-dark">Validar tutores trabajan centro</button>
            </div>
          <div class="col-md-3">
          	<div class="md-form mb-0">
            	<input type="checkbox" id="baremo_renta_inferior" value="0" name="baremo_renta_inferior" data-baremo="1" >
      				<label for="baremo_renta_inferior"> Renta inferior</label>
            </div>
						<input type="hidden" id="baremo_validar_renta_inferior" value="0" name="baremo_validar_renta_inferior">
						<button name="boton_baremo_validar_renta_inferior" type="button" class="btn btn-outline-dark">Validar renta</button>
							<div class="radio">
								<label><input type="radio" name="baremo_iprem" value="menor" data-baremo="1.5">Menor o igual que IPREM</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_iprem" value="mayor" data-baremo="1">Mayor que IPREM</label>
							</div>
          </div>
        </div>
<!--FIN FILA DATOS-->
<hr>
<!--INICIO FILA DATOS-->
        <div class="row formrow">
        	<div class="col-md-12">
          	<div class="md-form mb-0">
            	<input type="checkbox" id="num_hbaremo" value="0" name="num_hbaremo" class="num_hbaremo" >
      				<label for="hermanos_baremo">Tiene matriculados a los siguientes hermanos:</label>
            </div>
          </div>
       	</div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
        <div class="row hno_baremo" style="display:none">
        	<div class="col-md-4">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_datos_baremo1" value="" name="hermanos_datos_baremo1" data-baremo="8" placeholder="Apellidos Nombre hermano" class="form-control" >
              <input type="hidden" id="hermanos_id_registro_baremo1" value="" name="hermanos_id_registro_baremo1">
            </div>
          </div>
					<br>
          <div class="col-md-3">
          	<div class="md-form mb-0">
            	<input type="date" id="hermanos_fnacimiento_baremo1" value="" name="hermanos_fnacimiento_baremo1" placeholder="Fecha Nacimiento" class="form-control">
            </div>
          </div>
					<br>
          <div class="col-md-2">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_hcurso_baremo1" value="" name="hermanos_hcurso_baremo1" placeholder="Curso solicitado" class="form-control">
            </div>
          </div>
					<br>
          <div class="col-md-3">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_nivel_educativo_baremo1" value="" name="hermanos_nivel_educativo_baremo1" placeholder="Nivel educativo" class="form-control">
            </div>
          </div>
					<br>
        </div>
<!--FIN FILA DATOS-->
<br>
<!--INICIO FILA DATOS-->
        <div class="row hno_baremo" style="display:none">
        	<div class="col-md-4">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_datos_baremo2" value="" name="hermanos_datos_baremo2"  data-baremo="1" placeholder="Apellidos Nombre hermano" class="form-control" >
              <input type="hidden" id="hermanos_id_registro_baremo2" value="" name="hermanos_id_registro_baremo2">
            </div>
          </div>
          <div class="col-md-3">
          	<div class="md-form mb-0">
            	<input type="date" id="hermanos_fnacimiento_baremo2" value="" name="hermanos_fnacimiento_baremo2" placeholder="Fecha Nacimiento" class="form-control">
            </div>
          </div>
          <div class="col-md-2">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_hcurso_baremo2" value="" name="hermanos_hcurso_baremo2" placeholder="Curso solicitado" class="form-control">
            </div>
          </div>
          <div class="col-md-3">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_nivel_educativo_baremo2" value="" name="hermanos_nivel_educativo_baremo2" placeholder="Nivel educativo" class="form-control">
            </div>
          </div>
        </div>
<!--FIN FILA DATOS-->
<br>
<!--INICIO FILA DATOS-->
        <div class="row hno_baremo" style="display:none">
        	<div class="col-md-4">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_datos_baremo3" value="" name="hermanos_datos_baremo3"  data-baremo="1" placeholder="Apellidos Nombre hermano" class="form-control" >
              <input type="hidden" id="hermanos_id_registro_baremo3" value="" name="hermanos_id_registro_baremo3">
            </div>
          </div>
          <div class="col-md-3">
          	<div class="md-form mb-0">
            	<input type="date" id="hermanos_fnacimiento_baremo3" value="" name="hermanos_fnacimiento_baremo3" placeholder="Fecha Nacimiento" class="form-control">
            </div>
          </div>
          <div class="col-md-2">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_hcurso_baremo3" value="" name="hermanos_hcurso_baremo3" placeholder="Curso solicitado" class="form-control">
            </div>
          </div>
          <div class="col-md-3">
          	<div class="md-form mb-0">
            	<input type="text" id="hermanos_nivel_educativo_baremo3" value="" name="hermanos_nivel_educativo_baremo3" placeholder="Nivel educativo" class="form-control">
            </div>
          </div>
        </div>
<!--FIN FILA DATOS-->
<hr>
<br>
<!--INICIO FILA DATOS-->
                <div class="row hno_baremo" style="display:none">
                    <div class="col-md-4">
											<input type="hidden" id="baremo_validar_hnos_centro" value="0" name="baremo_validar_hnos_centro">
											<button name="boton_baremo_validar_hnos_centro" type="button" class="btn btn-outline-dark">Validar hermanos</button>
                    </div>

                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
         <div class="row formrow">
         	<div class="col-md-4 offset-md-4">
          	   <div class="md-form mb-0">
							<div class="radio">
							<label><b>DISCAPACIDAD</b></label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_discapacidad" value="alumno" data-baremo="1">Del alumno</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_discapacidad" value="hpadres" data-baremo="1">De padres/hermanos</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_discapacidad" value="no" data-baremo="0">Ninguna</label>
							</div>
				   </div>
				</div>

          <div class="col-md-4">
						<div class="md-form mb-0">
							<div class="radio">
								<label><b> FAMILIA NO NUMEROSA</b></label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_tipo_familia" value="no" data-baremo="0">No numerosa</label>
							</div>
							<div class="radio">
								<label><b> FAMILIA NUMEROSA</b></label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_tipo_familia" value="numerosa_general" data-baremo="1">General</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_tipo_familia" value="numerosa_especial" data-baremo="2">Especial</label>
							</div>
							<div class="radio">
								<label><b> FAMILIA MONOPARENTAL</b></label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_tipo_familia" value="monoparental_general" data-baremo="1">General</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="baremo_tipo_familia" value="monoparental_especial" data-baremo="2">Especial</label>
							</div>
						</div>
					</div>
</div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
        <div class="row formrow">
        	<div class="col-md-4 offset-md-4">
          	<div class="md-form mb-0">
							<input type="hidden" id="baremo_validar_discapacidad" value="0" name="baremo_validar_discapacidad">
							<button name="boton_baremo_validar_discapacidad" type="button" class="btn btn-outline-dark validar">Validar discapacidad</button>
            </div>
          </div>
          <div class="col-md-4">
          	<div class="md-form mb-0">
							<input type="hidden" id="baremo_validar_tipo_familia" value="0" name="baremo_validar_tipo_familia">
							<button name="boton_baremo_validar_tipo_familia" type="button" class="btn btn-outline-dark validar">Validar familia</button>
						</div>
					</div>
        </div>
<!--FIN FILA DATOS-->
</div>";

<!--FIN SECCION BAREMO-->
<!--INICIO SECCION DATOS: TRIBUTO-->
*/
$formsolanexo4.='
<p type="button" class="btn btn-primary bform" id="labeltributo" style="display:none" data-toggle="collapse" data-target="#tributo" >DATOS TRIBUTARIOS<span> <i class="fas fa-angle-down"></i></span></p>
<div id="tributo"  class="collaps">
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-12">
                            <input type="checkbox" id="solcalcbon" value="0" name="solcalcbon" class="solcalcbon" placeholder=""  >Solicitan cálculo bonificación
                    </div>
                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                     		Número miembros unidad familiar
				               <div class="form-group">
					               <select class="form-contro" name="nmunidad" id="nmunidad" value="">
                                  <option>0</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                              </select>
                           </div>
                        </div>
                    </div>
                </div>
<br>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-12">
                            <input type="checkbox" id="oponenautorizar" value="0" name="oponenautorizar" class="oponenautorizar" placeholder=""  >Los abajo firmantes se oponen a autorizar expresamente al Departamento de Educación, Cultura y Deporte para que recabe, de la Agencia Estatal de Administración Tributaria (AEAT), la información de carácter tributario del ejercicio fiscal 2017, y aportan certificación expedida por la AEAT de cada uno de los miembros de la unidad familiar, correspondiente al ejercicio fiscal 2017. Se hará constar los miembros computables de la familia a 31 de diciembre de 2017.
                    </div>
                </div>
<!--FIN FILA DATOS-->
<br>
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-12">
                            <input type="checkbox" id="cumplen" value="0" name="cumplen" class="cumplen" placeholder="" >
Los abajo firmantes declaran responsablemente que cumplen con sus obligaciones tributarias, así como que autorizan expresamente al Departamento de Educación, Cultura y Deporte para que recabe de la AEAT, la información de carácter tributario del ejercicio fiscal 2017.
                    </div>
                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_nombre1" value="" name="tributantes_nombre1" placeholder="Nombre" class="form-control" >
              							<input type="hidden" id="tributantes_id_tributante1" value="0" name="tributantes_id_tributante1">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_apellido11" value="" name="tributantes_apellido11" placeholder="Primer apellido" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_apellido21" value="" name="tributantes_apellido21" placeholder="Segundo apellido" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_parentesco1" value="" name="tributantes_parentesco1" placeholder="Parentesco" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_dni1" value="" name="tributantes_dni1" placeholder="NIF" pattern="[a-zA-Z0-9]{9}" class="form-control" >
                        </div>
                    </div>
                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_nombre2" value="" name="tributantes_nombre2" placeholder="Nombre" class="form-control" >
              							<input type="hidden" id="tributantes_id_tributante2" value="0" name="tributantes_id_tributante2">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_apellido12" value="" name="tributantes_apellido12" placeholder="Primer apellido" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_apellido22" value="" name="tributantes_apellido22" placeholder="Segundo apellido" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_parentesco2" value="" name="tributantes_parentesco2" placeholder="Parentesco" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_dni2" value="" name="tributantes_dni2" placeholder="NIF" pattern="[a-zA-Z0-9]{9}" class="form-control" >
                        </div>
                    </div>
                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_nombre3" value="" name="tributantes_nombre3" placeholder="Nombre" class="form-control" >
              							<input type="hidden" id="tributantes_id_tributante3" value="0" name="tributantes_id_tributante3">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_apellido13" value="" name="tributantes_apellido13" placeholder="Primer apellido" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_apellido23" value="" name="tributantes_apellido23" placeholder="Segundo apellido" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_parentesco3" value="" name="tributantes_parentesco3" placeholder="Parentesco" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_dni3" value="" name="tributantes_dni3" placeholder="NIF" pattern="[a-zA-Z0-9]{9}" class="form-control" >
                        </div>
                    </div>
                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_nombre4" value="" name="tributantes_nombre4" placeholder="Nombre" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_apellido14" value="" name="tributantes_apellido14" placeholder="Primer apellido" class="form-control" >
              							<input type="hidden" id="tributantes_id_tributante4" value="0" name="tributantes_id_tributante4">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_apellido24" value="" name="tributantes_apellido24" placeholder="Segundo apellido" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_parentesco4" value="" name="tributantes_parentesco4" placeholder="Parentesco" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="tributantes_dni4" value="" name="tributantes_dni4" placeholder="NIF" pattern="[a-zA-Z0-9]{9}" class="form-control" >
                        </divs>
                    </div>
                </div>
<!--FIN FILA DATOS-->
<!--INICIO FILA DATOS-->
                <div class="row formrow">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                           <input type="hidden" id="validar_infotributaria" value="0" name="validar_infotributaria">
                           <button name="boton_validar_infotributaria" type="button" class="btn btn-outline-dark">Validar información tributaria</button>
                        </div>
                    </div>
                </div>
<!--FIN FILA DATOS-->
</div>
</div>
<!--FIN SECCION TRIBUTO-->

			<br>
	    <div class="text-center text-md-left">
                <a class="btn btn-primary senda4" >GRABAR SOLICITUD</a>
            </div>
            <div class="status"></div>
</form> 
</div>
</div></td></tr>';    

