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

        arrayImage = arrayImage.concat(images); //gộp 2 mảng
        $('#listImage').attr('value',arrayImage );

        $.each(images, function (index, value) {
            $('#image-library .image-checkbox ').each(function (index) {
                if ( $(this).attr('data-id') == value ) {
                    var imagepath = $(this).find('img').attr('src');
                    $('#image-preview').append(
                        '<li data-item="' + value + '" class="image-item ui-sortable-handle">'
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
                                + '<img src="' + url + imagepath+'">'
                            + '</div>'
                        + '</div>'
                        + '</li>'
                    );

                }
            })
        });

    });
});
