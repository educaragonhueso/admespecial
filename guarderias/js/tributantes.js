$(document).ready(function(){
//OBTENER VALORES RENTA
$('body').on('change', 'input[id*=importe_renta]', function(e){

var viprim=parseFloat('6454.03');

vimporte_renta1=$(this).val();
vimporte_renta=parseFloat($(this).val());
console.log("renta: "+vimporte_renta);
console.log("iprim: "+viprim);

var vid=$(this).attr("id");
vid=vid.replace('importe_renta','');
if(vimporte_renta<viprim)
   $('#puntos_renta'+vid).text('1.5');
else
   $('#puntos_renta'+vid).text('1');
   
var cuota=0;
if(vimporte_renta>314 & vimporte_renta<=532) 
   cuota=59;
if(vimporte_renta>532 & vimporte_renta<=763) 
   cuota=86;
else cuota=118;

console.log("cuota: "+cuota);
$('#cuota'+vid).text(cuota);
return;
  vidcentro=$(this).parent('td').parent('tr').parent('tbody').parent('table').attr('id');
  vidcentro=vidcentro.replace('mat_table','');
  var ots = $(this);
  var vid=$(this).attr("id");
  vid=vid.replace('cambiar','');
  var vcontinua=$("#estado"+vid).text();
  var vtipoalumno=$('#tipoalumno'+vid).text();
  var vestado_pulsado=$(this).text();
  var vestado_actual=$(this).parent('div').parent('div').attr("id");
$.ajax({
  method: "POST",
  data: { id_alumno:vid,estado_pulsado:vestado_pulsado,estado_actual:vestado_actual,id_centro:vidcentro,continua:vcontinua},
  url:'../guarderias/scripts/ajax/cambio_estado_solicitud.php',
      success: function(data) 
      {
	if(vcontinua.indexOf('NO')!=-1){ alert("El alumno no continua, no afecta plazas vacantes");return;}
	cambiar_tipo(ots,vestado_pulsado,vid);
	var vacantes_ebo =data.split(":")[0];
	var vacantes_tva =data.split(":")[1];
       	$('#vacantesmat_ebo_desk'+vidcentro).html(vacantes_ebo);
   	$('#vacantesmat_tva_desk'+vidcentro).html(vacantes_tva);
   	var  npo_ebo=$('#vacantesmat_ebo_desk'+vidcentro).prev().text();
   	var  npo_tva=$('#vacantesmat_tva_desk'+vidcentro).prev().text();
	if(vestado_pulsado.indexOf('EBO')!=-1)
	{
		//$(this).closest('#vacantesmat_ebo_desk').prev().html(+npo_ebo+1);
		$('#vacantesmat_ebo_desk'+vidcentro).prev().html(+npo_ebo+1);
		$('#vacantesmat_tva_desk'+vidcentro).prev().html(+npo_tva-1);
		//$('#vacantesmat_tva_desk').prev().html(+npo_tva-1);
	}
	if(vestado_pulsado.indexOf('TVA')!=-1)
	{
		$('#vacantesmat_ebo_desk'+vidcentro).prev().html(+npo_ebo-1);
	   	$('#vacantesmat_tva_desk'+vidcentro).prev().html(+npo_tva+1);
	}
      },
      error: function() {
        alert('Problemas cambiando de estado!');
      }
});

});
//LISTADO SOLICITUDES FASEII
$(".show_tributantes").click(function () {  
  var vpdf='1';
  var vrol=$('#rol').attr("value");
  var vestado_convocatoria=$('#estado_convocatoria').val();
	$.ajax({
	  method: "POST",
	  url: "../guarderias/scripts/ajax/listados_tributantes.php",
	  data: {asignar:'0',rol:vrol,pdf:vpdf,estado_convocatoria:vestado_convocatoria},
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
