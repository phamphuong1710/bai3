$(document).ready(function ($) {
     var lang  = $('html').attr('lang');
    $(".search-product-in-store").on('keyup', function (e) {
        var product = $(this).val(),
            store = $('.store-id').val();
        var formData = new FormData();
        formData.append("product", product);
        formData.append("store", store);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/store/search-product",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                var html = '';
                var price;
                $.each( data, function(index, value){
                    var $rating = value.rating_average;
                    var $avg = ( $rating / 5 ) * 100;
                    if ( lang == 'en' ) {

                        if ( value.on_sale != 0 ) {
                            price = '<div class="info-goods-price">' +
                                        '<span class="item_price">' + value.usd - ( value.on_sale / 100 * value.usd ) + '$</span>' +
                                        '<del>' + value.usd + '$</del>' +
                                    '</div>';
                        } else {
                            price = '<div class="info-goods-price">' +
                                        '<span class="item_price">' + value.usd + '$</span>' +
                                    '</div>';
                        }
                    } else {
                        if ( value.on_sale != 0 ) {
                            price = '<div class="info-goods-price">' +
                                        '<span class="item_price">' + value.vnd - ( value.on_sale / 100 * value.vnd ) + '$</span>' +
                                        '<del>' + value.vnd + '$</del>' +
                                    '</div>';
                        } else {
                            price = '<div class="info-goods-price">' +
                                        '<span class="item_price">' + value.vnd + '$</span>' +
                                    '</div>';
                        }

                    }
                    html += '<div id="product-' + value.id + '" class="product">' +
                                '<div class="item-info-product ">' +
                                    '<div class="goods-thumb-item">' +
                                        '<a href="/products/' + value.slug +'">' +
                                            '<img src="' + value.logo + '" alt="Image Product">' +
                                        '</a>' +
                                    '</div>' +
                                    '<div class="good-main-info">' +
                                        '<h4 class="goods-name">' +
                                            '<a href="/products/' + value.slug + '">' + value.name + '</a>' +
                                        '</h4>' +

                                        '<div class="wt-star-rating">' +
                                            '<span class="star-reviewed" style="width:' + $avg + '%">' +
                                            '</span>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="product-right">' +
                                    price +
                                    '<div class="goods-add-to-cart">' +
                                        '<form action="/add-to-cart" method="post" class="add-to-cart-form">' +

                                            '<input type="hidden" name="product_id" value="' + value.id + '" class="add-product">' +
                                            '<input type="hidden" name="quantity" value="1"  class="add-quantity">' +
                                            '<input type="hidden" name="usd_to_vnd" class="usd-to-vnd">' +
                                            '<button type="submit" class="button btn-add-to-cart btn-shop-add-to-cart"></button>' +
                                        '</form>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';


                });
                $('.ajax-search-html').html(html);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
})

