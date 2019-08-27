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
    // calculateAndDisplayRoute(directionsService, directionsDisplay);


    // function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    //     var selectedMode = 'DRIVING';
    //     var listAddress = $('.origin');
    //     var destination = [];
    //     var list = [];
    //     $('.origin').each(function (index) {
    //         var data = $(this).val(),

    //             store = $(this).attr('store');
    //             if ( ! list.includes(data) ) {
    //                 console.log(333);
    //                 data = data.split(",");
    //                 list.push(data);
    //             }
    //             console.log( list );
    //     });
    //     for (var i = 0; i < list.length; i++) {
    //         list[i];
    //         var key = 'origin' + i;
    //         destination['origin'] = {
    //             lat: parseFloat(list[i][0]),
    //             lng: parseFloat(list[i][1])
    //         };

    //         console.log(destination);
    //         if (navigator.geolocation) {
    //             navigator.geolocation.getCurrentPosition(function(position) {
    //

    //                 destination['destination'] = {
    //                         lat: position.coords.latitude,
    //                         lng: position.coords.longitude
    //                     };
    //                     destination['travelMode'] = google.maps.TravelMode[selectedMode];
    //                     destination = Object.assign({}, destination);
    //                 directionsService.route( destination, function(response, status) {
    //                     if (status == 'OK') {
    //                         directionsDisplay.setDirections(response);
    //                     } else {
    //                         window.alert('Directions request failed due to ' + status);
    //                     }
    //                 });

    //             }, function() {
    //                 handleLocationError(true, infoWindow, map.getCenter());
    //             });
    //         } else {
    //             // Browser doesn't support Geolocation
    //             handleLocationError(false, infoWindow, map.getCenter());
    //         }
    //     }
    // }
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


        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }


    function callback(response, status) {
        // if (status == 'OK') {
        //     var origins = response.originAddresses;
        //     var destinations = response.destinationAddresses;
        //     for (var i = 0; i < origins.length; i++) {
        //         var results = response.rows[i].elements;
        //         console.log(results);
        //         for (var j = 0; j < results.length; j++) {
        //             var element = results[j];
        //             var distance = element.distance.text;
        //             var duration = element.duration.text;
        //             var from = origins[i];
        //             var to = destinations[j];
        //         }
        //     }
        // }


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
      function deleteMarkers(markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
          markersArray[i].setMap(null);
        }
        markersArray = [];
      }
});
