$(document).ready(function(){
    var $lat = Number($('#lat').attr('value')),
        $lng = Number($('#lng').attr('value'));
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: $lat, lng: $lng},
        zoom: 13,
    });

    var markers = [];
    var pos = new google.maps.LatLng($lat, $lng);
    markers.push(new google.maps.Marker({
        map: map,
        position: pos,
    }));
    // Create the search box and link it to the UI element.
    var input = document.getElementById('address');
    var searchBox = new google.maps.places.SearchBox(input);
    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }
        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];
        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            console.log(place.formatted_address);

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                title: place.name,
                position: place.geometry.location
            }));
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
        });
         map.fitBounds(bounds);
    });
});
