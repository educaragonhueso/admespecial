$(document).ready(function(){
//LISTADO SOLICITUDES FASEII
$(".lfase2").click(function () {  
  var vsorteo_fase2=$('#sorteo_fase2').text();
  var vpdf='1';
  var vrol=$('#rol').attr("value");
  var vsubtipo=$(this).attr("data-subtipo");
  var vestado_convocatoria=$('#estado_convocatoria').val();
	$.ajax({
	  method: "POST",
	  url: "../scripts/ajax/listados_solicitudes_fase2.php",
	  data: {asignar:'0',rol:vrol,subtipo:vsubtipo,pdf:vpdf,estado_convocatoria:vestado_convocatoria,sorteo_fase2:vsorteo_fase2},
	  success: function(data) {
					$("#l_matricula").html(data);
					$(".container").hide();
	      },
	      error: function() {
		alert('Error LISTANDO solicitudes: '+vsubtipo);
	      }
	});
});

//ASIGNAR NUMERO FASE2
$('body').on('click', '#boton_asignar_numero_fase2', function(e){
var vsorteo_fase2=$('#sorteo_fase2').text();
var vrol=$('#rol').attr("value");
var vsubtipo=$(this).attr("data-subtipo");
var vestado_convocatoria=$('#estado_convocatoria').text();
var vidcentro=$('#id_centro').text();
	$.ajax({
	  method: "POST",
	  data: {asignar:'1',rol:vrol,subtipo:vsubtipo,estado_convocatoria:vestado_convocatoria,sorteo_fase2:vsorteo_fase2},
	  url:'../scripts/ajax/listados_solicitudes_fase2.php',
	      success: function(data) {
			        $("#tresumen"+vidcentro).remove();
                                $("#filtroscheck").remove();
                                $("#nuevasolicitud").remove();
                                $("#form_sorteo").remove();
                                $("#sol_table").remove();
				$("#l_matricula").html(data);
                                $("#num_sorteo").prop("disabled",false);
		},error: function (request, status, error) {
        alert(error);
    }
	});
});

//REALIZAR SORTEO

$('body').on('click', '#boton_realizar_sorteo_fase2', function(e){

var vestado_convocatoria=$('#estado_convocatoria').text();
var vid=$(this).attr("id");
var vrol=$('#rol').attr("value");
var vidcentro=$('#id_centro').text();
var vsolicitudes=$(this).attr("data-solicitudes");
var vnum_sorteo=$('#num_sorteo').val();
var vnum_solicitudes=$('#num_solicitudes').val();
var isnum = /^\d+$/.test(vnum_sorteo);
if (!isnum) {
    alert('No es un numero');
return;
}
if (parseInt(vnum_solicitudes)<parseInt(vnum_sorteo) || parseInt(vnum_sorteo)<=0) {
    alert('Introduce un numero entre 1 y '+vnum_solicitudes);
return;
}
	$.ajax({
	  method: "POST",
	  data: {asignar:'2',rol:vrol,nsorteo:parseInt(vnum_sorteo),estado_convocatoria:vestado_convocatoria},
	  url:'../scripts/ajax/listados_solicitudes_fase2.php',
	      success: function(data) {
				console.log(data);
				$("#l_matricula").html(data);
				$("#tresumen").hide();
		},
	      error: function() {
		alert('Problemas listando solicitud!');
	      }
	});
});

var cen_options = 
	{
	url: "../datosweb/centros_especial.json",
	getValue:"nombre_centro",
		list: 
		{
			onSelectItemEvent: function() {
			var nombre = $("#fcentrosadmin").getSelectedItemData().nombre_centro;
			var idcentro = $("#fcentrosadmin").getSelectedItemData().id_centro;
			$("#id_centro").text(idcentro);
			$("#id_centro").attr("value",idcentro);
			$("#rol").text('centro');
			$("#rol").attr("value","centro");
			},
			maxNumberOfElements: 10,
			match: 
			{
			enabled: true
			},
			onKeyEnterEvent: function() 
			{
			var vcentro = $('#buscar_centros').getSelectedItemData().name;
			},
			onClickEvent: function() 
			{
			var vcentro = $('#buscar_centros').getSelectedItemData().name;
			}
		}
	};
$(".cdefinitivo").easyAutocomplete(cen_options);
//FORMULARIO PARA MODIFICAR MANUALMENTE CENTRO DEFINITIVO ALLUMNOS FASE2
$('body').on('click', '.cdefinitivo', function(e){
  var vid=$(this).attr("id");
  var vcdefinitivo=$("#cdefinitivo"+vid).val();
  var vtipoestudios=$(this).attr("data-tipo");
	console.log("definitivo");
$.ajax({
  method: "POST",
  data: {id_alumno:vid,cdefinitivo:vcdefinitivo,tipoestudios:vtipoestudios},
  url:'../scripts/ajax/cambio_estado_fase2.php',
   	success: function(data) 
	{
	console.log("ok");
	console.log(data);
	if(data.indexOf("OK")!=-1)
		$.alert({
			title: 'CENTRO MODIFICADO CORRECTAMENTE',
			content: 'CONTINUAR'
			});
      	},
      	error: function() {
        alert('PROBLEMAS EDITANDO SOLICITUD!');
      	}
});

});

});//FIN GETREADY