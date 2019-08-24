$(document).ready(function ($) {
    $( '.product-item-action' ).on( 'click','.delete-product', function (e) {
        e.preventDefault();
        var btn = $( this );
        var product = $(this).attr('product');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: 'POST',
            url: '/delete-cart/' + product,
            data: {
                'id': product,
                '_method': 'delete',
            },
            success: function(data) {
                btn.parents('.cart-item').remove();
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});
