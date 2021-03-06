$(document).ready(function ($) {

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

var bounds = new google.maps.LatLngBounds;
        var markersArray = [];
        var geocoder = new google.maps.Geocoder;

    var service = new google.maps.DistanceMatrixService();
    var list = [], origin = [], destination = [];
    var destinationIcon = 'https://chart.googleapis.com/chart?' +
        'chst=d_map_pin_letter&chld=D|FF0000|000000';
    var originIcon = 'https://chart.googleapis.com/chart?' +
        'chst=d_map_pin_letter&chld=O|FFFF00|000000';

    $('.origin').each(function (index) {
        var data = $(this).val();
            if ( ! list.includes(data) ) {
                console.log(333);
                data = data.split(", ");
                list.push(data);
            }
            console.log( list );
    });
    for (var i = 0; i < list.length; i++) {
        var lat = parseFloat(list[i][0]),
                lng = parseFloat(list[i][1]);
        origin[i] = new google.maps.LatLng(list[i][0], list[i][1]);
    }
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {

            console.log(position.coords.latitude);
            for (var i = 0; i < list.length; i++) {
                destination[i] = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            }
            console.log( destination );

        service.getDistanceMatrix(
            {
                origins: origin,
                destinations: destination,
                travelMode: 'DRIVING'
            }, callback);

        calculateAndDisplayRoute(directionsService, directionsDisplay);


        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }


    function callback(response, status) {
        if (status == 'OK') {
            var originList = response.originAddresses;
            var destinationList = response.destinationAddresses;

            deleteMarkers(markersArray);

            var showGeocodedAddressOnMap = function(asDestination) {
              var icon = asDestination ? destinationIcon : originIcon;
              return function(results, status) {
                if (status === 'OK') {
                  map.fitBounds(bounds.extend(results[0].geometry.location));
                  markersArray.push(new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: icon
                  }));
                } else {
                  alert('Geocode was not successful due to: ' + status);
                }
              };
            };

            for (var i = 0; i < originList.length; i++) {
              var results = response.rows[i].elements;
              geocoder.geocode({'address': originList[i]},
                  showGeocodedAddressOnMap(false));
              for (var j = 0; j < results.length; j++) {
                geocoder.geocode({'address': destinationList[j]},
                    showGeocodedAddressOnMap(true));
              }
            }
        }
    }

    function deleteMarkers(markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
          markersArray[i].setMap(null);
        }
        markersArray = [];
    }

    function calculateAndDisplayRoute(directionsService, map, pointA, pointB) {
        directionsService.route({
            origin: pointA,
            destination: pointB,
            avoidTolls: false,
            avoidHighways: false,
            travelMode: google.maps.TravelMode.DRIVING
        }, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                var directionsDisplay = new google.maps.DirectionsRenderer({
                    map: map,
                    suppressMarkers: true,
                    // preserveViewprot: true
                });
                responses.push(response);
                if (responses.length > 0) {
                    for (var i = 0; i < (responses.length - 1); i++) {
                        response.routes[0].bounds.union(responses[i].routes[0].bounds)
                        for (var j = 0; j < responses[i].routes[0].legs.length; j++)
                            response.routes[0].legs.push(responses[i].routes[0].legs[j]);
                    }
                    directionsDisplay.setDirections(response);
                }
                showSteps(response);
            } else {
                console.error('Directions request failed due to ' + status);
            }
        });

    }
});
