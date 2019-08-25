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
            beforeSend: function (data) {
                btn.addClass('eloading');

                $( '#shop-cart-sidebar' ).addClass('eloading');
            },
            success: function(data) {
                 $( '#shop-cart-sidebar' ).removeClass('eloading');
                console.log(data);
                var price = data.usd - data.discount_usd;
                btn.parents('.cart-item').remove();
                $('#shop-cart-sidebar .count').html(data.quantity);
                $('.icon-cart .count').html(data.quantity);
                $('.total-price').html(price);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});
