$(document).ready(function(){
    // AJAX DELETE IMAGE
    $(".gallery-image-list").on( 'click', '.action-delete-image', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var token = $("meta[name='csrf-token']").attr("content");
        var btn = $(this);
        var val = $('#listImage').val();
        var arrayImage = [];
        if ( val !== '' ) {
            arrayImage = val.split(',');
        }
        $.ajax(
        {
            url: "/media-store/"+id,
            type: 'POST',
            data: {
                "_method": 'delete',
                "_token": token,
                "id": id,
            },
            success: function ($data){
                btn.parents('.image-item').remove();
                arrayImage.remove(id);
                $('#listImage').val(arrayImage);
                $.each(arrayImage, function (index, value) {
                    $('.image-item').each(function(){
                        if ( $(this).attr('data-item') == value ) {
                            $(this).find('.image-position').attr('val', index + 1);
                            $(this).find('.image-position').html(index + 1);
                        }
                    });
                });
                alert("Image Deleted Success");
            }
        });
    });

    $("#edit-popup").on( 'click', '.action-delete-image', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var token = $("meta[name='csrf-token']").attr("content");
        var btn = $(this);
        var val = $('#listImage').val();
        var arrayImage = [];
        if ( val !== '' ) {
            arrayImage = val.split(',');
        }
        $.ajax(
        {
            url: "/media-store/"+id,
            type: 'POST',
            data: {
                "_method": 'delete',
                "_token": token,
                "id": id,
            },
            success: function ($data){
                btn.parents('.image-item').remove();
                arrayImage.remove(id);
                $('#listImage').val(arrayImage);
                $.each(arrayImage, function (index, value) {
                    $('.image-item').each(function(){
                        if ( $(this).attr('data-item') == value ) {
                            $(this).find('.image-position').attr('val', index + 1);
                            $(this).find('.image-position').html(index + 1);
                        }
                    });
                });
                alert("Image Deleted Success");
                $('#listImage').val(arrayImage);
            }
        });
    });
});
