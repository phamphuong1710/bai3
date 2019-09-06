$(document).ready(function ($) {
// Rating
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
                console.log(data);
                var html = '';
                var price;
                $.each( data, function(index, value){
                    if ( lang == 'en' ) {
                        if ( value.on_sale != 0 ) {
                            price = '<span class="item_price">' +
                                    value.usd - ( value.on_sale / 100 * value.usd ) +
                                        '<span class="currency">$</span>' +
                                '</span>' +
                                '<del>' +
                                    value.usd +
                                    '<span class="currency">$</span>' +
                                '</del>';
                        } else {
                            price = '<span class="item_price">' +
                                        value.usd +
                                        '<span class="currency">$</span>' +
                                    '</span>';
                        }
                    } else {
                        if ( value.on_sale != 0 ) {
                            price = '<span class="item_price">' +
                                        value.vnd - ( value.on_sale / 100 * value.vnd ) +
                                            '<span class="currency">đ</span>' +
                                    '</span>' +
                                    '<del>' +
                                        value.vnd +
                                        '<span class="currency">đ</span>' +
                                    '</del>';
                        } else {
                            price = '<span class="item_price">' +
                                        value.vnd +
                                        '<span class="currency">đ</span>' +
                                    '</span>';
                        }

                    }
                    html += '<div id="product-' + value.id +'" class="product">' +
                                '<div class="product-content">' +
                                    '<div class="image-product-wrapper">' +
                                        '<a href="/products/' + value.slug + '">' +
                                            '<img src="' + value.logo + '" alt="Image Feature">' +
                                        '</a>' +
                                '</div>' +
                                '<div class="product-info">' +
                                    '<a href="/products/' + value.slug + '">' +
                                        '<h3 class="product-name">' + value.name + '</h3>' +
                                    '</a>' +
                                    '<div class="info-product-price">' +
                                        price +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>';

                    $('.ajax-search-html').html(html);
                });
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
})

