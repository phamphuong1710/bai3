$(document).ready(function(){
    var lang  = $('html').attr('lang');
    $( '.discount-sidebar-input' ).on( 'change', function (e) {
        var btn = $(this);
        $( '.list-discount' ).find('.is-selected').removeClass('is-selected');
        btn.addClass('is-selected');

        var discount = btn.val();
        var formData = {
            discount: discount,
        };

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: 'GET',
            url: '/products/discount/' + discount,
            data: formData,
            beforeSend: function (data) {
                $( '.page-loading' ).addClass('loading');
                $( '.loading' ).fadeIn();
            },
            success: function(data) {
                $('.loading').delay(500).fadeOut();
                $( '.page-loading' ).removeClass('loading');

                var html = '<div class="products content-ajax"><div class="product-wrapper wrapper row justify-content-center">';
                html += productTemplate(data);
                html += '</div></div>';
                $('#primary').html(html);
                var page = 1;
                var contentHeight =$('.content-ajax').height();
                var position = $('.content-ajax').height() + $('.content-ajax').offset().top;
                $(window).scroll(function() {
                    var scroll = $(window).scrollTop();
                    if( scroll > position + ( contentHeight / 2 ) ) {

                        position = position + contentHeight;
                        page++;
                        loadMoreData(page, discount);
                    }
                });

            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }

    function loadMoreData(page, discount){
        $.ajax(
        {
            url: 'products/discount/' + discount + '?page=' + page,
            type: "get",
            beforeSend: function()
            {
                $('.content-ajax').addClass('loading');
            },
            success: function(data) {
                $('.content-ajax').delay(500).removeClass('loading');
                $( '.page-loading' ).removeClass('loading');
               var html = productTemplate(data);

                $("body .product-wrapper").append(html);

            },
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                $('.ajax-load').hide();
            alert('server not responding...');

            });
    }

    function productTemplate(data) {
        var html = '';
        var discount = '';
        $.each( data.data, function (index, value) {
            var $rating = value.rating_average;
            var $avg = ( $rating / 5 ) * 100;
            if ( lang == 'en' ) {
                var add = 'Add To Cart';

                if ( value.on_sale != 0 ) {
                    var usd = value.usd - ( value.on_sale / 100 * value.usd );
                    price = '<div class="info-product-price">' +
                                '<del>' +
                                    '<span class="currency">$</span>' +
                                    addCommas(value.usd) +
                                '</del>' +
                                '<span class="item_price item-sale">' +
                                    '<span class="currency">$</span>' +
                                    addCommas(usd) +
                                '</span>' +

                            '</div>';
                    discount = '<span class="product-discount">' + value.on_sale + '%' + '</span>';
                } else {

                    price = '<div class="info-product-price">' +
                                '<span class="item_price">' +
                                    '<span class="currency">$</span>' +
                                    addCommas(value.usd) +
                                '</span>' +
                            '</div>';
                }
            } else {
                var add = 'Thêm vào giỏ hàng';
                if ( value.on_sale != 0 ) {
                    var vnd = value.vnd - ( value.on_sale / 100 * value.vnd );
                    price = '<div class="info-product-price">' +

                                '<span class="item_price">' +
                                    '<span class="currency">đ</span>' +
                                    addCommas(vnd) +
                                '</span>' +
                                '<del>' +
                                    '<span class="currency">đ</span>' +
                                    addCommas(value.vnd) +
                                '</del>' +
                            '</div>'
                    discount = '<span class="product-discount">' + value.on_sale + '%' + '</span>';
                } else {
                    price = '<div class="info-product-price">' +
                                '<span class="item_price">' +
                                    '<span class="currency">đ</span>' +
                                    addCommas(value.vnd) +
                                '</span>' +
                            '</div>';
                }

            }

            html += '<div class="col-md-4 product-men">' +
                        '<div class="men-pro-item item-pro">' +
                            '<div class="men-thumb-item">' +
                                '<a href="/products/' + value.slug + '">' +

                                    '<img src="' + value.logo + '" alt="' + value.name + '">' +
                                '</a>' +
                                discount +

                                '<div class="add-to-cart-wrapper">' +
                                    '<form action="/add-to-cart" method="post" class="add-to-cart-form">' +
                                        '<input type="hidden" name="product_id" value="' + value.id + '" class="add-product">' +
                                        '<input type="hidden" name="quantity" value="1"  class="add-quantity">' +
                                        '<input type="hidden" name="usd_to_vnd" class="usd-to-vnd">' +
                                        '<button type="submit" class="button btn-add-to-cart ion-ios-cart">' + add + '</button>' +
                                    '</form>' +
                                '</div>' +
                            '</div>' +
                            '<div class="item-info-product ">'+
                                '<h4 class="item-name">' +
                                    '<a href="/products/' + value.slug + '">' + value.name + '</a>' +
                                '</h4>' +
                                price +
                                '<div class="wt-star-rating">' +
                                    '<span class="star-reviewed" style="width: ' + $avg + '%">' +
                                    '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
        } );


        return html;
    }
});
