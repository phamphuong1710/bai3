$(document).ready(function(){
    $( '.discount-sidebar-input' ).on( 'change', function (e) {
        var lang  = $('html').attr('lang');
        var btn = $(this);
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
                btn.addClass('eloading');

                $( '#shop-cart-sidebar' ).addClass('eloading');
            },
            success: function(data) {
                console.log(data);
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

                                        '<span class="item_price">' +
                                            '<span class="currency">$</span>' +
                                            addCommas(usd) +
                                        '</span>' +
                                        '<del>' +
                                            '<span class="currency">$</span>' +
                                            addCommas(value.usd) +
                                        '</del>' +
                                    '</div>';
                            discount = '<span class="product-discount">' + value.on_sale + '%' + '</span>';
                        } else {

                            price = '<span class="item_price">' +
                                        '<span class="currency">$</span>' +
                                        addCommas(value.usd) +
                                    '</span>';
                        }
                    } else {
                        var add = 'Thêm vào giỏ hàng';
                        if ( value.on_sale != 0 ) {
                            var vnd = value.vnd - ( value.on_sale / 100 * value.vnd );
                            price = '<div class="info-product-price">' +

                                        '<span class="item_price">' +
                                            '<span class="currency">$</span>' +
                                            addCommas(vnd) +
                                        '</span>' +
                                        '<del>' +
                                            '<span class="currency">$</span>' +
                                            addCommas(value.vnd) +
                                        '</del>' +
                                    '</div>'
                            discount = '<span class="product-discount">' + value.on_sale + '%' + '</span>';
                        } else {
                            price = '<span class="item_price">' +
                                        '<span class="currency">$</span>' +
                                        addCommas(value.vnd) +
                                    '</span>';
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
                                        '<div class="wt-star-rating">' +
                                            '<span class="star-reviewed" style="width: ' + $avg + '%">' +
                                            '</span>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';




                } );
                $('#primary').html(html);

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
});
