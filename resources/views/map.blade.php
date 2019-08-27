<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
        <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 13
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            console.log(position);
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('quan an ngon found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('map.google_key') }}&callback=initMap"></script>
<!-- <script>
var from = new google.maps.LatLng(46.5610058, 26.9098054);
var fromName = 'Bacau';
var dest = new google.maps.LatLng(44.391403, 26.1157184);
var destName = 'Bucuresti';

var service = new google.maps.DistanceMatrixService();
service.getDistanceMatrix(
    {
        origins: [from, fromName],
        destinations: [destName, dest],
        travelMode: 'DRIVING'
    }, callback);

function callback(response, status) {
    if (status == 'OK') {
        var origins = response.originAddresses;
        var destinations = response.destinationAddresses;
        console.log(origins);
        console.log(destinations);

        for (var i = 0; i < origins.length; i++) {
            var results = response.rows[i].elements;
            // console.log(results);
            for (var j = 0; j < results.length; j++) {
                var element = results[j];
                var distance = element.distance.text;
                var duration = element.duration.text;
                var from = origins[i];
                var to = destinations[j];
            }
        }
    }
}
</script> -->
</body>
</html>
