$(document).ready(function(){
    // AJAX Video
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
});
