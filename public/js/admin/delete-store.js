$(document).ready(function(){
    $(".btn-delete-store").on( 'click', function(e){
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
                    alert( 'Store ' + $data['name'] + ' deleted successfully');
                },
                error: function (e){
                    alert( 'Opps!, Something went wrong, please try again later.' );
                    console.log(e);
                }
            });
        }
    });
});
