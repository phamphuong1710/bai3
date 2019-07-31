$(document).ready(function(){
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
                    console.log(btn.parents('td'));
                    alert( 'Category ' + $data['name'] + ' deleted successfully');


                },
                error: function (e){
                    alert( 'Opps!, Something went wrong, please try again later.' );
                    console.log(e);
                }
            });
        }
    });
});
