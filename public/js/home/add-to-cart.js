$(document).ready(function(){
    $( '.btn-add-to-cart' ).on( 'click', function (e) {
        e.preventDefault();
        var btn = $(this),
            form = $(this).parents('.add-to-cart-form'),
            product = form.find('.add-product').val(),
            quantity = form.find('.add-quantity').val(),
            action = form.attr('action'),
            formData = new FormData();
            formData.append('product_id', product);
            formData.append('quantity', quantity);
            console.log(product);
            // console.log(data);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: action,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function (data) {
                btn.addClass('eloading');
                $( '#shop-cart-sidebar' ).addClass( 'showcart' );
                $( '#shop-overlay' ).addClass( 'show' );
                $( '#shop-cart-sidebar' ).removeClass('added').addClass('eloading');
            },
            success: function (data) {
                btn.removeClass('eloading');
                $( '#shop-cart-sidebar' ).addClass('added').removeClass('eloading');
                console.log(data);
                var html = '',
                    total = 0;
                    price = 0;
                $.each(data.product, function (index,value) {
                    unit = value.usd - value.discount_usd;
                    html += '<li class="mini-cart-item cart-item">' +
                                '<div class="product-minnicart-info">' +
                                    '<span class="mincart-product-name">' + value.name + '</span>' +
                                    '<span class="product-quantity">' +
                                        '<span class="minicart-product-quantity">' + value.quantity + '</span> x <span class="minicart-product-price">$' + unit +'</span>' +
                                    '</span>' +
                                '</div>' +
                                '<div class="product-minicart-logo">' +
                                    '<img src="' + value.logo + '" alt="' + value.name + '">' +
                                '</div>' +
                                '<span class="remove_from_cart_button ion-android-close delete-product" product="' + value.id + '"></span>'
                            '</li>';
                    total = total + parseInt(value.quantity);
                    price = price + value.quantity * unit;

                });
                $('.list-product-in-cart').html(html);
                $('.count').html(total);
                $('.total-price').html(price);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $( '.user-login' ).on( 'click', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: '/user-login',
            type: 'GET',
            contentType: false,
            processData: false,
            beforeSend: function (data) {
                $('#shop-overlay').addClass('show');
                $('#login').addClass('active');
                $('#login').addClass('loading');

            },
            success: function (data) {
                $('#login').removeClass('loading');
                $('.login-form').html(data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    } );

    $( '.btn-register' ).on( 'click', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: '/user-register',
            type: 'GET',
            contentType: false,
            processData: false,
            beforeSend: function (data) {
                $('#shop-overlay').addClass('show');
                $('#register').addClass('active');
                $('#register').addClass('loading');

            },
            success: function (data) {
                $('#register').removeClass('loading');
                $('.register-form').html(data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $( '.login-wrapper' ).on( 'click', '.close-form-login', function (e) {
        $( '#shop-overlay' ).removeClass( 'show' );
        $( '.login-wrapper' ).removeClass( 'active' );
    } );

    $( '.register-wrapper' ).on( 'click', '.close-form-register', function (e) {
        $( '#shop-overlay' ).removeClass( 'show' );
        $( '.register-wrapper' ).removeClass( 'active' );
    } )

    $('.cart-sidebar-head').on('click','#close-cart-sidebar', function (e) {
        $( '#shop-cart-sidebar' ).removeClass( 'showcart' );
        $( '#shop-overlay' ).removeClass( 'show' );
    });

    $('#shop-overlay').on('click', function (e) {
        $( '#shop-cart-sidebar' ).removeClass( 'showcart' );
        $( this ).removeClass( 'show' );
    });

    $('.icon-cart').on('click', function (e) {
        $( '#shop-overlay' ).addClass( 'show' );
        $( '#shop-cart-sidebar' ).addClass( 'showcart' );
    });
});
