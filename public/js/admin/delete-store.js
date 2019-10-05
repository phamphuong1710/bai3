$(document).ready(function(){
    var lang  = $('html').attr('lang');
    $(".list-store").on( 'click', '.btn-delete-store', function(e){
        e.preventDefault();
        var $delete = confirm( 'Delete Store' );
        if ( $delete === true ) {
            var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var btn = $(this);
            $.ajax(
            {
                url: "/stores/"+id,
                type: 'POST',
                data: {
                    "_method": 'delete',
                    "_token": token,
                    "id": id,
                },
                success: function ($data){
                    btn.parents('tr').remove();
                    if ( lang == 'en' ) {
                        alert( 'Store ' + $data['name'] + ' deleted successfully');
                    } else {
                        alert( 'Cửa Hàng ' + $data['name'] + ' đã được xóa thành công');
                    }
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
