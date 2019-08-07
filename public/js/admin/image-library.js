$(document).ready(function(){
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

    $('.btn-close').on('click', function (e) {
        $('.library-image-wrapper').removeClass('active');
    });

    $('.btn-images-choose').on('click', function () {

        var url = $('body').attr('data-src'),
            images = [],
            arrayImage = [],
            position = 0,
            val = $('#listImage').val();
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


});
