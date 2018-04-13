<!DOCTYPE html>
<html>
<body>

<h1>Mapa Estação Limel</h1>

<div id="map" style="width:100%;height:400px;"></div>

<script>
function myMap() {
    var myCenter = new google.maps.LatLng(-1.7764,-55.8622);
    var mapCanvas = document.getElementById("map");
    var mapOptions = {center: myCenter, zoom: 10};
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({position:myCenter});
    marker.setMap(map);


//var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBT36RiLM5utat025x31OZn8ShhcH_GwNs&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>