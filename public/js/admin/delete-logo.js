$(document).ready(function(){
    var lang  = $('html').attr('lang');

    $('body').on( 'click', '.btn-delete-logo', function(e){
        e.preventDefault();
        if ( lang == 'en' ) {
            $delete = confirm( 'Delete Image' );
        } else {
            $delete = confirm( 'Xóa Ảnh' );
        }
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
                },
                error: function (e){
                    if ( lang == 'en' ) {
                        alert( 'Opps!, Something went wrong, please try again later.' );

                    } else {
                        alert( 'Opps!, Đã xảy ra lỗi, vui lòng thử lại sau.');
                    }
                }
            });
        }
    });
});
