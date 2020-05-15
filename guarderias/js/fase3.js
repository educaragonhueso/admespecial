$(document).ready(function(){
//LISTADO SOLICITUDES FASEIII
$(".lfase3").click(function () {  
  var vsorteo_fase2=$('#sorteo_fase3').text();
  var vpdf='1';
  var vrol=$('#rol').attr("value");
  var vsubtipo=$(this).attr("data-subtipo");
  var vestado_convocatoria=$('#estado_convocatoria').val();
	$.ajax({
	  method: "POST",
	  url: "../scripts/ajax/listados_solicitudes_fase3.php",
	  data: {asignar:'0',rol:vrol,subtipo:vsubtipo,estado_convocatoria:vestado_convocatoria},
	  success: function(data) {
					$("#l_matricula").html(data);
					$(".container").hide();
	      },
	      error: function() {
		alert('Error LISTANDO solicitudes: '+vsubtipo);
	      }
	});
});

//REALIZAR ASIGNACION VACANTES

$('body').on('click', '#boton_asignar_plazas_fase3', function(e){

var vsubtipo=$(this).attr("data-subtipo");

	$.ajax({
	  method: "POST",
	  data: {subtipo:vsubtipo},
	  url:'../scripts/servidor/sc_asignavacantes_fase3.php',
	      success: function(data) {
				alert(data);
		},
	      error: function() {
		alert('Problemas listando solicitud!');
	      }
	});
});

//FORMULARIO PARA MODIFICAR MANUALMENTE CENTRO DEFINITIVO ALLUMNOS FASE2
$('body').on('click', '.activarfase3', function(e){
  var vid=$(this).attr("id");
  var vactivar=$(this).attr("value");
$.ajax({
  method: "POST",
  data: {id_alumno:vid,valor:vaactivar},
  url:'../scripts/ajax/cambio_estado_fase3.php',
   	success: function(data) 
	{
		$.alert({
			title: 'ALUMNO MODIFICADO CORRECTAMENTE',
			content: 'CONTINUAR'
			});
      	},
      	error: function() {
        alert('PROBLEMAS CAMBIANDO CENTRO!');
      	}
});

});

});//FIN GETREADY
