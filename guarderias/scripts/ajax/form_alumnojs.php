<?php
$script="<script>
var cen_options = 
	{
	url: '../guarderias/datosweb/guarderias.json',
	getValue: 'nombre_centro',
		list: 
		{
			maxNumberOfElements: 10,
			match: 
			{
			enabled: true
			}
		}
	};
$('#buscar_centros').easyAutocomplete(cen_options);
$('input[id*=id_centro_destino]').easyAutocomplete(cen_options);

var loc_options = 
	{
	url: '../guarderias/datosweb/localidades.json',
	getValue: 'name',
		list: 
		{
			maxNumberOfElements: 10,
			match: 
			{
			enabled: true
			}
		}
	};
$('.localidad').easyAutocomplete(loc_options);
$('.loc').easyAutocomplete(loc_options);
$('#localidad_origen').easyAutocomplete(loc_options);
$('input[id*=loc_dfamiliar]').easyAutocomplete(loc_options);
$('input[id*=loc_centro_origen]').easyAutocomplete(loc_options);
$('input[id*=loc_centro_destino]').easyAutocomplete(loc_options);

var nac_options = 
	{
	url: '../guarderias/datosweb/nacionalidades.json',
	getValue: 'nome_pais_int',
		list: 
		{
			maxNumberOfElements: 10,
			match: 
			{
			enabled: true
			}
		}
	};
$('.nacionalidad').easyAutocomplete(nac_options);
</script>";
?>
