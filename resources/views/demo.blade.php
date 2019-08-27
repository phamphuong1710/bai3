<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
    <b>Mode of Travel: </b>
    <select id="mode">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <option value="BICYCLING">Bicycling</option>
      <option value="TRANSIT">Transit</option>
    </select>
    </div>
    <div id="map"></div>
    <script>
        function initMap() {
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {
                    lat: 37.77,
                    lng: -122.447
                }
            });
            directionsDisplay.setMap(map);

            calculateAndDisplayRoute(directionsService, directionsDisplay);
            document.getElementById('mode').addEventListener('change', function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            });
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var selectedMode = document.getElementById('mode').value;
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    console.log(position.coords.latitude);
                    console.log(position.coords.longitude);
                    directionsService.route({
                        origin: {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        },
                        destination: {
                            lat: 20,
                            lng: 105.78889860000001
                        }, // Ocean Beach.
                        // Note that Javascript allows us to access the constant
                        // using square brackets and a string value as its
                        // "property."
                        travelMode: google.maps.TravelMode[selectedMode]
                    }, function(response, status) {
                        if (status == 'OK') {
                            directionsDisplay.setDirections(response);
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    });

                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }

        }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('map.google_key') }}&callback=initMap"></script>
</body>
</html>
