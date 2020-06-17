$(document).ready(function(){
function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function isFloat(n){
    return Number(n) === n && n % 1 !== 0;
}
function isInt(n){
    return Number(n) === n && n % 1 === 0;
}
//OBTENER VALORES RENTA
$('body').on('change', 'input[id*=importe_renta]', function(e){

var viprim=parseFloat('6454.03');

vimporte_renta1=$(this).val();
if(!isNumber(vimporte_renta1))
{
   alert("INTRODUCE VALOR NUMéRICO");
  return;
}
vimporte_renta1=parseFloat(vimporte_renta1);
vimporte_renta=parseFloat(vimporte_renta1);

var vid=$(this).attr("id");
vid=vid.replace('importe_renta','');
if(vimporte_renta<viprim)
   {
   $('#puntos_renta'+vid).text('1.5');
   $('#puntos_renta'+vid).val('1.5');
   }
else if(vimporte_renta<2*viprim)
   {
   $('#puntos_renta'+vid).text('1');
   $('#puntos_renta'+vid).val('1');
   }
else
   {
   $('#puntos_renta'+vid).text('0');
   $('#puntos_renta'+vid).val('0');
   }
var cuota=0;
if(vimporte_renta>314 & vimporte_renta<=532) 
   cuota=59;
if(vimporte_renta>532 & vimporte_renta<=763) 
   cuota=86;
else cuota=118;

console.log("cuota: "+cuota);
$('#cuota'+vid).text(cuota);
$('#cuota'+vid).val(cuota);
return;
});
//GRABAMOS RENTA TRIBUTANTES
$('body').on('click', '.setrenta', function(e){
  var vrol=$('#rol').attr("value");
  var vid=$(this).attr("id");
  vid=vid.replace('setrenta','');
  var vimporte_renta=$('#importe_renta'+vid).val();
  var vpuntos_renta=$('#puntos_renta'+vid).val();
  var vcuota=$('#cuota'+vid).val();

if(!isNumber(vimporte_renta1))
{
   alert("INTRODUCE VALOR NUMéRICO");
  return;
}
vimporte_renta1=parseFloat(vimporte_renta1);
      
/*
  if(!isFloat(vimporte_renta) | !isFloat(vpuntos_renta) | !isFloat(vcuota))
   {
   alert("DEBES INTRODUCIR VALORES NUMERICOS");
   return;
   }
*/
  var vestado_convocatoria=$('#estado_convocatoria').val();
	$.ajax({
	  method: "POST",
	  url: "../guarderias/scripts/ajax/asignacion_renta.php",
	  data: {rol:vrol,estado_convocatoria:vestado_convocatoria,id_alumno:vid,importe_renta:vimporte_renta,puntos_renta:vpuntos_renta,cuota:vcuota},
	  success: function(data) {
	   console.log(data);
   	alert('Grabada Renta ALumno');
	      },
	      error: function() {
		   alert('Error LISTANDO solicitudes: ');
	      }
	});
});
//LISTADO SOLICITUDES FASEII
$(".show_tributantes").click(function () {  
  var vpdf='1';
  var vrol=$('#rol').attr("value");
  var vidcentro=$('#id_centro').text();
   console.log("idcentro: "+vidcentro);
  var vprovincia=$('#provincia').attr("value");
  var vestado_convocatoria=$('#estado_convocatoria').val();
	$.ajax({
	  method: "POST",
	  url: "../guarderias/scripts/ajax/listados_tributantes.php",
	  data: {asignar:'0',rol:vrol,pdf:vpdf,estado_convocatoria:vestado_convocatoria,id_centro:vidcentro,provincia:vprovincia},
	  success: function(data) {
					$("#l_matricula").html(data);
					$(".container").hide();
	      },
	      error: function() {
		alert('Error LISTANDO solicitudes: ');
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
	url: "../datosweb/guarderias.json",
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


});//FIN GETREADY
