$(document).ready(function ($) {
    $( '.btn-update-cart' ).on( 'click', function (e) {
        e.preventDefault();
        var url = $('.update-cart').attr('action'),
            item = $('.qty');
            formData = new FormData();
            item.each(function (index) {
                var name = $(this).attr('name'),
                    quantity = $(this).val();
                formData.append(name, quantity);
            });
            formData.append('_method', 'PUT');
            formData.append('type','post');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function (data) {
                console.log(data);
            },
            success: function(data) {
                console.log(data);
                var price,
                    lang = $('html').attr('lang');
                console.log(data.discount_usd);
                if ( lang == 'en' ) {
                    price = data.usd - data.discount_usd ;
                    $( '.total-price' ).html( '$' + price );
                } else {
                    price = data.vnd - data.discount_vnd;
                    $( '.total-price' ).html( 'đ' + price );
                }

            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});
