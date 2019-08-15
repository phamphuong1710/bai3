$(document).ready(function(){
    $( '#logo' ).change( function () {
        var fileData = $(this);
        var formData = new FormData();
        var url = $('body').attr('data-src');
        formData.append("logo", fileData[0].files[0]);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/image-slider",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                $('.logo-wrapper').html(
                '<img src=' + url + data.image_path +' data-id="'+ data.id +'">'
            );
                $('.id-logo').attr('value', data.id );
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
    $(".btn-delete-logo").on( 'click', function(e){
        e.preventDefault();
        var $delete = confirm( 'Delete Post' );
        if ( $delete === true ) {
            var id = $('.logo-wrapper img').attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var btn = $(this);
            $.ajax(
            {
                url: "/logo/"+id,
                type: 'POST',
                data: {
                    "_method": 'delete',
                    "_token": token,
                    "id": id,
                },
                success: function ($data){
                    $('.logo-wrapper').html('<img src="/images/logo-placeholder.png" alt="Logo Placeholder">');
                }
            });
        }
    });

});
