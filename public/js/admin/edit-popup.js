$(document).ready(function(){
    $( '.btn-edit' ).on('click', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.attr('data-id'),
            control = btn.attr('controller') ;
            console.log(control);

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: '/' + control + '/' + id + '/edit',
            type: 'GET',
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-popup').addClass('active');
                $('.edit-popup-wrapper').html(data);

                video();
                chooseImages();
                showLibraryImage();
                closeLibraryImage();
                if ( control == 'stores' || control == 'products' ) {
                   sortImage();
                }
                if (control == 'stores') {
                    storeAddress();
                }


            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('.edit-popup').on('click', '.btn-close-popup', function (e) {
        $('#edit-popup').removeClass('active');
    });

    function sortImage() {
        var popup = $('#edit-popup'),
            list = popup.find('.gallery-image-list');

        $(list).sortable({
            cursor: "move",
            update: function(event, ui) {
                var result = $(this).sortable('toArray', {attribute: 'data-item'});
                $('#listImage').val(result);
                $.each(result, function(index, value){
                    $('.image-item').each(function(){
                        if ( $(this).attr('data-item') == value ) {
                            $(this).find('.image-position').attr('val', index + 1);
                            $(this).find('.image-position').html(index + 1);
                        }
                    });
                })
            }
        });
    }

    function video() {
        $( '.btn-video' ).on( 'click', function () {
            var url = $('body').attr('data-src');
            var video = prompt( 'Link Youtube: ' );
            var link = 'https://www.youtube.com/watch?v=';
            var start = link.length;
            var id = video.substr( start, 11 );
            var path = 'https://img.youtube.com/vi/' + id +'/sddefault.jpg';
            var token = $( 'input[name=_token]' ).val();
            var formData = new FormData();
            formData.append('_token', token);
            formData.append('image_path', path);
            formData.append('video_path', video);
            var val = $('#listImage').val();
            var arrayImage = [];
            var position = 1;
            if ( val !== '' ) {
                arrayImage = val.split(',');
                position = arrayImage.length + 1;
            }
            $.ajax({
                url: "/video-store",
                data: formData,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    arrayImage.push(data.id);
                    $('#listImage').val(arrayImage);
                    $('#image-preview').append(
                        '<li data-item="' + data.id + '" class="image-item ui-sortable-handle">'
                        + '<div class="image-wrapper">'
                            + '<div class="preview-action">'
                                +'<span val="' + position + '" class="image-position">' + position
                                + '</span>'
                                + '<a href="#" class="action-delete-image fa fa-times" data-id="'+ data.id + '">'
                                + '</a>'
                            + '</div>'
                            + '<div class="image image-video">'
                                + '<img src="' + url + data.image_path +'">'
                            + '</div>'
                        + '</div>'
                        + '</li>'
                    );
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        } );
    }

    function showLibraryImage() {
        $('.btn-image-library').on('click', function (e) {
            e.preventDefault();
            var id = $('input[name=user_id]').val();
            $.ajax(
            {
                url: "/library/",
                type: 'GET',
                data: {
                    'id': id,
                },
                beforeSend : function ( xhr ) {
                    $('.library-image-wrapper').addClass('active');
                    $('#image-library').addClass('loading');
                },
                success: function ($data){
                    $('#image-library').removeClass('loading');
                    $('#image-library').html($data);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });
    }

    function closeLibraryImage() {
        $('.library-image-wrapper').removeClass('active');
    }

    function chooseImages() {
        $('.btn-images-choose').on('click', function () {

            var url = $('body').attr('data-src'),
                images = [],
                arrayImage = [],
                position = 0,
                val = $('#listImage').val();

                console.log(val);
            if ( val !== '' ) {
                arrayImage = val.split(',');
                position = arrayImage.length;
                $.each(arrayImage, function(index, value) {
                    $('.image-item').each(function(){
                        if ( $(this).attr('data-item') == value ) {
                            $(this).find('.image-position').attr('val', index + 1);
                            $(this).find('.image-position').html(index + 1);
                        }
                    });
                });
            };
            $('input[name=image_item]:checked').each(function(i){
              images[i] = $(this).val();
            });

            var token = $("meta[name='csrf-token']").attr("content"),
                formData = new FormData();
                formData.append('list_path', images);
                formData.append('_token', token);
            $.ajax(
            {
                url: "/library/",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend : function ( xhr ) {

                },
                success: function ($data){
                    console.log($data);
                    var listId = [];
                    $.each( $data, function (index, value) {
                        arrayImage.push(value.id);
                        position = position + 1;
                        $('#image-preview').append(
                            '<li data-item="' + value.id + '" class="image-item ui-sortable-handle">'
                                + '<div class="image-wrapper">'
                                    + '<div class="preview-action">'
                                        +'<span val="' + position + '" class="image-position">' + position
                                        + '</span>'
                                        + '<a href="#" class="action-delete-image fa fa-times" data-id="'+ value.id + '">'
                                        + '</a>'
                                        + '<span class="action-update-image  fa fa-undo"><input type="file" class="input-update" name="image" data-id="' + value.id + '">'
                                    + '</span>'
                                + '</div>'
                                + '<div class="image">'
                                    + '<img src="' + url +value.image_path+'">'
                                + '</div>'
                            + '</div>'
                            + '</li>'
                        );
                    } );
                    $('#listImage').attr('value',arrayImage );
                    $('.library-image-wrapper').removeClass('active');
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });

        });
    }

    function storeAddress() {
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
    }
});
