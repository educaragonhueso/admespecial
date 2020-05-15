<head>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDORxJ68R5GU5pNKhO0fT_icSShE9c94Ic&callback=initMap">
</script>
</head>

<body onload="initialize()">
        <div>
          <input id="address" type="text" value="Zaragoza">
          <input type="button" value="Geocode" onclick="codeAddress()">
        </div>
        <div id="map-canvas" style="height:90%;top:30px"></div>
 </body>
 <script>

 var geocoder;
 var map;
 function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(41.6520184,-0.8806809);
    var mapOptions = {
      zoom: 10,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);

    $.ajax({
         method: "POST",
         data: {},
         dataType: 'json',
         url:'../scripts/ajax/get_coord_centros.php',
         success: function(data) {
         data.forEach(function(elto) {
               { 
                  latitud=elto.coordenadas.split(":")[0]; 
                  longitud=elto.coordenadas.split(":")[1]; 
                  var latlong = {lat: parseFloat(latitud), lng:
parseFloat(longitud)};
                  var vacantes ="CENTRO: "+elto.nombre_centro+"\nVacantesEBO:"+elto.vacantes_ebo+"\nVacantes TVA:"+elto.vacantes_tva;
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
         console.log(results[0]);
         console.log(results[0].formatted_address);
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
</script>
