$(document).ready(function(){

    $( 'body' ).on('change', '#logo', function () {
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
            url: "/logo",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function (data) {
                $('.logo-wrapper').addClass('loading');

            },
            success: function (data) {
                setTimeout(function(){
                    $('.logo-wrapper').removeClass('loading');
                    $('.logo-wrapper').html(
                        '<img src=' + url + data.image_path +' data-id="'+ data.id +'">'
                    );
                    $('.id-logo').attr('value', data.id );
                },1000);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});
