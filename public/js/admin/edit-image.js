$(document).ready(function(){
// AJAX UPDATE IMAGE
    $(".gallery-image-list").on('change', '.input-update', function (e) {
        e.preventDefault();
        var $this = $(this);
        var fileData = $(this).prop("files");
        var token = $( 'input[name=_token]' ).val();
        var formData = new FormData();
        formData.append("image", fileData[0]);
        formData.append('_token', token);
        formData.append('_method', 'PUT');
        formData.append('type','post');
        var $imgID = $(this).attr('data-id');
        $.ajax({
            url: "/media-store/" + $imgID,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                var image = $this.parents( '.image-wrapper' ).find('img');
                image.attr('src', data.data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('#edit-popup').on('change', '.input-update', function (e) {
        e.preventDefault();
        var $this = $(this);
        var fileData = $(this).prop("files");
        var token = $( 'input[name=_token]' ).val();
        var formData = new FormData();
        formData.append("image", fileData[0]);
        formData.append('_token', token);
        formData.append('_method', 'PUT');
        formData.append('type','post');
        var $imgID = $(this).attr('data-id');
        $.ajax({
            url: "/media-store/" + $imgID,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                var image = $this.parents( '.image-wrapper' ).find('img');
                image.attr('src', data.data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});
