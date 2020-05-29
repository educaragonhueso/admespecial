<?php
$script="<script>
var cen_options = 
	{
	url: '../datosweb/guarderias.json',
	getValue:'nombre_centro',
		list: 
		{
			onSelectItemEvent: function() {
			var nombre = $('#fcentrosadmin').getSelectedItemData().nombre_centro;
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
$('.inputcdefinitivo').easyAutocomplete(cen_options);
</script>";
?>
