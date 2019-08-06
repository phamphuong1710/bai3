$(document).ready(function(){
    $( '#edit-popup' ).on( 'change', '#postImage', function () {
        var val = $('#listImage').val();
        var url = $('body').attr('data-src');
        var arrayImage = [];
        var position = 0;
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
        var fileData = $(this).prop("files");
        var token = $( 'input[name=_token]' ).val();

        var formData = new FormData();
        for (var x = 0; x < fileData.length; x++) {
            formData.append("image[]", fileData[x]);
        }
        formData.append('_token', token);
        if ( fileData.length == 0 ) {
            return;
        }
        $.ajax({
            url: "/media-store",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                $.each(data.data, function(index, value) {
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
                });
                $('#listImage').val(arrayImage);
            },
            error: function (xhr, status, error) {
                alert('Something wrong! Please try again later!');
            }
        });
    });

    $( '#postImage' ).change( function () {
        var val = $('#listImage').val();
        var url = $('body').attr('data-src');
        var arrayImage = [];
        var position = 0;
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
        var fileData = $(this).prop("files");
        var token = $( 'input[name=_token]' ).val();

        var formData = new FormData();
        for (var x = 0; x < fileData.length; x++) {
            formData.append("image[]", fileData[x]);
        }
        formData.append('_token', token);
        if ( fileData.length == 0 ) {
            return;
        }
        $.ajax({
            url: "/media-store",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                $.each(data.data, function(index, value) {
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
                });
                $('#listImage').val(arrayImage);
            },
            error: function (xhr, status, error) {
                alert('Something wrong! Please try again later!');
            }
        });
    });
});
