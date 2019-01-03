function initMap() {
    var myCenter = new google.maps.LatLng(-7.5548117,110.7300676);
    var mapCanvas = document.getElementById("map");
    var mapOptions = {center: myCenter, zoom: 16.8};
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({
    position: myCenter,
    animation: google.maps.Animation.BOUNCE
    });
    marker.setMap(map);
}