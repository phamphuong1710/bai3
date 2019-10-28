$(document).ready(function ($) {
    var lang = $('html').attr('lang');
    const now = new Date();
    var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 21.0166589, lng: 105.7818972},
        zoom: 13
    });
    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');

    var input = document.getElementById('address');
    var searchBox = new google.maps.places.SearchBox(input);
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });
    var responses = [];

    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }

            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 21.0166589, lng: 105.7818972},
                zoom: 13
            });

            if (place.geometry.viewport) {
            // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();

            $('#lat').attr('value', lat);
            $('#lng').attr('value', lng);

            var pointA = new google.maps.LatLng(lat, lng);
            markerA = new google.maps.Marker({
                position: pointA,
                title: "Khách đặt hàng",
                label: "Khách đặt hàng",
                map: map
            });

            var point = [];
            var marker = [];
            var dataStores = $('#stores').val();
            dataStores = JSON.parse(dataStores);

            $("#quangduong").html('');

            if(directionsDisplay != null) {
                directionsDisplay.setMap(null);
                directionsDisplay = null;
            }

            $.each(dataStores, function(i,row){
                point[i] = new google.maps.LatLng(row.lat, row.lng);
                marker[i] = new google.maps.Marker({
                    position: point[i],
                    title: row.name,
                    label: row.name,
                    map: map
                });

                calculateAndDisplayRoute(directionsService, map, point[i], pointA);

            });


        });
        map.fitBounds(bounds);
    });

    function showSteps(directionResult) {
        var myRoute = directionResult.routes[0].legs[0];
        var km = numberFormat( myRoute.distance.value/1000, 1);
        var instructions = '<h3 class="distance" total-ship="' + myRoute.distance.value + '">' + km + 'km</h3><br>';
        document.getElementById("quangduong").innerHTML += instructions;

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
                });
                var responses = [];

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

    $('#quangduong').bind("DOMSubtreeModified",function(){
        var sum = 0;
        var current = $('.usd-to-vnd').val();
        $(".distance").each(function() {
            var cost = parseFloat($(this).attr('total-ship'))/1000;
            sum += numberFormat(cost, 1);
        });
        $("#km").text(sum);
        var cartUsd, cartVnd, shipUsd, shipVnd, totalVnd, totalUsd;
        cartUsd = parseFloat($(".total-price").attr('usd')),
        shipUsd = parseFloat($(".ship").attr('usd'));
        cartVnd = parseFloat($(".total-price").attr('vnd')),
        shipVnd = parseFloat($(".ship").attr('vnd'));
        totalUsd = sum*shipUsd + cartUsd;
        totalVnd = sum*shipVnd + cartVnd
        totalUsd = numberFormat( totalUsd, 1 );
        totalVnd = numberFormat( totalVnd, 1 );
        $("#total_usd").val(totalUsd);
        $("#total_vnd").val(totalVnd);
        if ( lang == 'vn' ) {
            $(".total-price").html( 'đ' + totalVnd);
        } else {
            $(".total-price").html( '$' + totalUsd);
        }
        total = 0;
        sum = 0;
    });


    $.ajax(
    {
        url: "http://e.cafef.vn/rate.ashx?rd=" + now.getTime() + "&fbclid=IwAR0WB-4qp7caoaCYkIybyjp7CUxEL6Kfb7PnuTqCtx36T1bfXFE5N00i0sk",
        type: 'GET',

        success: function ($data){

            data = JSON.parse($data);
            var usd = data[0];
            var price = parseInt(usd['buy'].replace(',', ''));
            $('.usd-to-vnd').val(price);
            var ship = $('.ship').attr('vnd');
            var shipUsd = ship/price;
            shipUsd = numberFormat(shipUsd, 1);
            $('.ship').attr('usd', shipUsd);
            if ( lang == 'en' ) {
                $('.cost').html(shipUsd);
            } else {
                $('.cost').html(ship);
            }

        }
    });

    function numberFormat($number, $lenght) {
        var ex = Math.pow(10, $lenght ) ;
        $number = parseInt( $number * ex );
        $number = $number / ex;

        return $number;
    }


});
