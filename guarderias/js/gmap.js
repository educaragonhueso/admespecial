$(document).ready(function(){
var geocoder;
 var map;

$('body').on('click', '#show_mapacentros', function(e){
$("#map-canvas").show();
   $("#mapcontrol").show(); 
   initialize();
});

 function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(41.6520184,-0.8806809);
    var mapOptions = {
      zoom: 12,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

    $.ajax({
         method: "POST",
         data: {},
         dataType: 'json',
         url:'../guarderias/scripts/ajax/get_coord_centros.php',
         success: function(data) {
         $(".row").hide(); 
         data.forEach(function(elto) {
               {
                  latitud=elto.coordenadas.split(":")[0]; 
                  longitud=elto.coordenadas.split(":")[1]; 
                  var latlong = {lat: parseFloat(latitud), lng:
parseFloat(longitud)};
                  var vacantes ="CENTRO: "+elto.nombre_centro+"\nVacantes 2020:"+elto.vuno+"\nVacantes 2019:"+elto.vdos+"\nVacantes 2018:"+elto.vtres;
                  var marker = new google.maps.Marker({
                  map: map,
                  position: latlong,
                  title:  vacantes
                  });
                  var infowindow = new google.maps.InfoWindow({
                   content: vacantes
                  });

                  marker.addListener('click', function() {
                   infowindow.open(map, marker);
                  });
               }
            });
            },
error: function() {
          alert('Problemas obteniendo coordenadas!');
       }
});

}
function codeAddress() {
   var address = document.getElementById('address').value;
   geocoder.geocode( { 'address': address}, function(results, status) {
         if (status == google.maps.GeocoderStatus.OK) {
         map.setCenter(results[0].geometry.location);
         var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location,
title: results[0].formatted_address
});
         } else {
         alert('Geocode was not successful for the following reason: ' + status);
         }
         });
}
});
