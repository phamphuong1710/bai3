$(document).ready(function(){
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

    $('#edit-popup').on( 'click', '.btn-delete-logo', function(e){
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
