$(document).ready(function(){

    $("#input-product").on('keyup', function (e) {
        var product = $(this).val(),
            store = $('#store-id').val();

        var formData = new FormData();
        formData.append("product", product);
        formData.append("store", store);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/search-product",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {

                var html = '';
                $.each(data, function (index, value) {
                    html += '<div id="product-' + value.id +'" class="product product-admin">' +
                            '<div class="product-content">' +
                                '<div class="image-product-wrapper">' +
                                    '<a href="/products/' + value.id + '">' +
                                        '<img src="'+ value.logo.image_path + '" alt="Image Feature">' +
                                    '</a>' +
                                '</div>' +
                                '<div class="product-info">' +
                                    '<a href="/products/' + value.id + '">' +
                                        '<h3 class="product-name">' + value.name + '</h3>' +
                                    '</a>' +
                                    '<div class="info-product-price">' +

                                        '<span class="sale-price">' +
                                            'Price: ' + numberFormat(value.usd, 2) + '<sup>USD</sup>' +
                                        '</span>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="product-action">'
                                    '<a href="/products/' + value.id + '/edit" class="btn-action btn-edit">Edit</a>' +
                                    '<form action="/products/' + value.id + '" method="POST" class="form-delete">' +
                                        '<input type="hidden" name="_method" value="delete">' +
                                        '<button type="submit" class="btn-action btn-delete btn-delete-product" data-id="' + value.id + '">Delete</button>' +
                                    '</form>' +
                                '</div>' +
                            '</div>' +
                        '</div>';
                })
                $('.ajax-search-html').html(html);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
    $("#product-category").on('change', function (e) {
        var category = $(this).val(),
            sort = $('#sorting').val(),
            store = $('#store-id').val(),
            dataSorting = sort.split('-');
            formData = new FormData();
        formData.append("category", category);
        formData.append("store", store);
        formData.append('order', dataSorting[0]);
        formData.append('orderby', dataSorting[1]);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/search-category",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {

                var html = '';
                $.each(data, function (index, value) {
                    html += '<div id="product-' + value.id +'" class="product product-admin">' +
                            '<div class="product-content">' +
                                '<div class="image-product-wrapper">' +
                                    '<a href="/products/' + value.id + '">' +
                                        '<img src="'+ value.logo.image_path + '" alt="Image Feature">' +
                                    '</a>' +
                                '</div>' +
                                '<div class="product-info">' +
                                    '<a href="/products/' + value.id + '">' +
                                        '<h3 class="product-name">' + value.name + '</h3>' +
                                    '</a>' +
                                    '<div class="info-product-price">' +

                                        '<span class="sale-price">' +
                                            'Price: ' + numberFormat(value.usd, 2) + '<sup>USD</sup>' +
                                        '</span>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="product-action">' +
                                    '<a href="/products/' + value.id + '/edit" class="btn-action btn-edit">Edit</a>' +
                                    '<form action="/products/' + value.id + '" method="POST" class="form-delete">' +
                                        '<input type="hidden" name="_method" value="delete">' +
                                        '<button type="submit" class="btn-action btn-delete btn-delete-product" data-id="' + value.id + '">Delete</button>' +
                                    '</form>' +
                                '</div>' +
                            '</div>' +
                        '</div>';
                })
                $('.ajax-search-html').html(html);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $("#sorting").on('change', function (e) {
        var sort = $(this).val(),
            category = $('#product-category').val(),
            store = $('#store-id').val(),
            formData = new FormData(),
            dataSorting = sort.split('-');
        formData.append('order', dataSorting[0]);
        formData.append('orderby', dataSorting[1]);
        formData.append('category', category);
        formData.append("store", store);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/search-category-user",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                $('.ajax-search-html').html(data);
                var product = $('.list-product .product').length;
                $('.product-number').html(product);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    function numberFormat($number, $lenght) {
        var ex = Math.pow(10, $lenght ) ;
        $number = parseInt( $number * ex );
        $number = $number / ex;

        return $number;
    }
});
