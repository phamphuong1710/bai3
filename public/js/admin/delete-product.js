$(document).ready(function(){
    $(".btn-delete-product").on( 'click', function(e){
        e.preventDefault();
        var $delete = confirm( 'Delete Product' );
        if ( $delete === true ) {
            var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var btn = $(this);
            $.ajax(
            {
                url: "/products/"+id,
                type: 'POST',
                data: {
                    "_method": 'delete',
                    "_token": token,
                    "id": id,
                },
                success: function ($data){
                    btn.parents('.product').remove();
                    alert( 'Product ' + $data['name'] + ' deleted successfully');
                },
                error: function (e){
                    alert( 'Opps!, Something went wrong, please try again later.' );
                    console.log(e);
                }
            });
        }
    });
});
