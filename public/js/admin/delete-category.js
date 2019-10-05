$(document).ready(function(){
    var lang  = $('html').attr('lang');
    $(".btn-delete-cat").on( 'click', function(e){
        e.preventDefault();
        var $delete = confirm( 'Delete Category' );
        if ( $delete === true ) {
            var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var btn = $(this);
            $.ajax(
            {
                url: "/categories/"+id,
                type: 'POST',
                data: {
                    "_method": 'delete',
                    "_token": token,
                    "id": id,
                },
                success: function ($data){
                    btn.parents('tr').remove();
                    alert( 'Category ' + $data['name'] + ' deleted successfully');
                    if ( lang == 'en' ) {
                        alert( 'Category ' + $data['name'] + ' deleted successfully');

                    } else {
                        alert( 'Danh Mục ' + $data['name'] + ' đã được xóa thành công');
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
