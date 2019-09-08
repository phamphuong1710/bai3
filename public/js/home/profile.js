$(document).ready(function ($) {
    $('.profile').on('click', function () {

        var btn = $(this),
            id = btn.attr('data-user');

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: '/user/' + id + '/edit',
            type: 'GET',
            contentType: false,
            processData: false,
            beforeSend: function (data) {
                $( '.edit-popup-overlay' ).addClass( 'active' );
            },
            success: function (data) {
                $('.edit-popup-wrapper').html(data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    })

    $('body').on('click', '.btn-close-popup', function (e) {
        $('.edit-popup-overlay').removeClass('active');
    });

    $( 'body' ).on('change', '#logo', function () {
        var fileData = $(this);
        var formData = new FormData();
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
            success: function (data) {
                console.log(data);
                $('.avatar-wrapper').html(
                '<img src="' + data.image_path +'" data-id="'+ data.id +'">'
            );
                $('.id-logo').attr('value', data.id );
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('body').on( 'click', '.btn-delete-logo', function(e){
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
