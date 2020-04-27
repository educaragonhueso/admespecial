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
				$("#sol_table").remove();
				$("#listado_fase2").html(data);
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
var vsubtipo=$(this).attr("data-subtipo");
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
	  data: {asignar:'2',rol:vrol,nsorteo:parseInt(vnum_sorteo),estado_convocatoria:vestado_convocatoria,subtipo:vsubtipo},
	  url:'../scripts/ajax/listados_solicitudes_fase2.php',
	      success: function(data) {
				$("#sol_table").remove();
				$("#listado_fase2").html(data);
		},
	      error: function() {
		alert('Problemas listando solicitud!');
	      }
	});
});
//REALIZAR ASIGNACION VACANTES

$('body').on('click', '#boton_asignar_plazas_fase2', function(e){

var vsubtipo=$(this).attr("data-subtipo");

	$.ajax({
	  method: "POST",
	  data: {subtipo:vsubtipo},
	  url:'../scripts/servidor/sc_asignavacantes_fase2.php',
	      success: function(data) {
				alert(data);
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
  var vacdefinitivo=$("#selectcentro"+vid+" option:selected").attr("value");
  var vcdefinitivo=vacdefinitivo.split(':')[0];
  var vvacdefinitivo=vacdefinitivo.split(':')[1];

  var vidcdefinitivo=$("#selectcentro"+vid+" option:selected").attr("class");
  vidcdefinitivo=vidcdefinitivo.replace("vacantesebo","");
  vidcdefinitivo=vidcdefinitivo.replace("vacantestva","");
  var vtipoestudios=$(this).attr("data-tipo");
  var vcactual=$("#centro_definitivo"+vid).text();
  
  var vidcactual=$("#centro_definitivo"+vid).attr("data-idcactual");
  vidcactual=vidcactual.replace("idcactual","");
  
  var vidcorigen=$("#centro_origen"+vid).attr("data-idcorigen");
  vidcorigen=vidcorigen.replace("idcorigen","");
  
  var vclasdefinitivo=$("#selectcentro"+vid+" option:selected").attr("class");
  var vclasactual=$(".vacantes"+vtipoestudios+vidcactual).attr("class");
  //vacantes ccentro actual
  var vvaccactual=$(".vacantes"+vtipoestudios+vidcactual).attr("value").split(':')[1];

  //datos centro de estudios origen, si lo hay  
  var vcorigen=$("#centro_origen"+vid).text();
  var vvaccorigen=$(".vacantes"+vtipoestudios+vidcorigen).attr("value").split(':')[1];
  var vreserva=$("#centro_origen"+vid).attr("data-reserva");
  var vclasorigen=$(".vacantes"+vtipoestudios+vidcorigen).attr("class");
			
 vacantesfinales_def=+vvacdefinitivo-1;
 vacantesfinales_act=+vvaccactual+1;
 
 vacantesfinales_corigen=+vvaccorigen+1;
 
console.log("Centro definitivo: "+vcdefinitivo);
console.log("id centro definitivo: "+vidcdefinitivo);
console.log("vac centro definitivo: "+vvacdefinitivo);
console.log("vacantes finales cdefinitivo: "+vacantesfinales_def);

console.log("Centro actual: "+vcactual);
console.log("id centro actual: "+vidcactual);
console.log("class centro actual: "+vclasactual);
console.log("Vacantes centro actual: "+vvaccactual);
console.log("vacantes finales actual: "+vacantesfinales_act);

console.log("CENTRO ESTUDIOS ORIGEN: "+vidcorigen);
console.log("vacantes finales CORIGEN: "+vacantesfinales_corigen);
console.log("Reserva CORIGEN: "+vreserva);

if(vidcorigen==vidcdefinitivo)
{
		$.alert({
			title: 'TIENE RESERVA EN ESE CENTRO',
			content: 'CONTINUAR'
			});
		return;
}

if(vidcactual==vidcdefinitivo)
{
		$.alert({
			title: 'YA SE ENCUENTRA EN ESE CENTRO',
			content: 'CONTINUAR'
			});
		return;
}
$.ajax({
  method: "POST",
  data: {id_alumno:vid,centrodefinitivo:vcdefinitivo,idcentrodefinitivo:vidcdefinitivo,vacdefinitivo:vvacdefinitivo,tipoestudios:vtipoestudios,centroactual:vcactual,idcentroactual:vidcactual},
  url:'../scripts/ajax/cambio_estado_fase2.php',
   	success: function(data) 
	{
	if(data.indexOf("OK")!=-1)

		$("."+vclasdefinitivo).text(vcdefinitivo+':'+vacantesfinales_def);
		$("."+vclasdefinitivo).attr("value",vcdefinitivo+':'+vacantesfinales_def);

		//modificamos vacantes en el listado
		$("#"+vtipoestudios+vidcdefinitivo).text(vacantesfinales_def);
		$("#"+vtipoestudios+vidcactual).text(vacantesfinales_act);
		
		$("."+vclasactual).text(vcactual+':'+vacantesfinales_act);
		$("."+vclasactual).attr("value",vcactual+':'+vacantesfinales_act);
		//modificamos vacantes en el centro de estudios origen si lo hay y si no se ha liberado la reserva, o sea es la primera veza
		console.log(vidcorigen+":::"+vreserva);
		if(vidcorigen!=0 & vreserva=='reserva1')
		{
		console.log("modificando vacantes en centro de reserva");
		$("."+vclasorigen).text(vcorigen+':'+vacantesfinales_corigen);
		$("."+vclasorigen).attr("value",vcorigen+':'+vacantesfinales_corigen);
		$("#centro_origen"+vid).attr("data-reserva","reserva0");
		$("#"+vtipoestudios+vidcorigen).text(vacantesfinales_corigen);
		}
		$("#centro_definitivo"+vid).attr("data-idcactual","idcactual"+vidcdefinitivo);
		$("#centro_definitivo"+vid).text(vcdefinitivo);
		$.alert({
			title: 'CENTRO MODIFICADO CORRECTAMENTE',
			content: 'CONTINUAR'
			});
      	},
      	error: function() {
        alert('PROBLEMAS CAMBIANDO CENTRO!');
      	}
});

});

});//FIN GETREADY
