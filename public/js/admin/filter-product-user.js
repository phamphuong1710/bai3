$(document).ready(function(){
    $("#input-product").on('keyup', function (e) {
        var product = $(this).val();

        var formData = new FormData();
        formData.append("product", product);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/search-product-user",
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

    $("#product-category").on('change', function (e) {
        var category = $(this).val(),
            sort = $('#sorting').val();
            dataSorting = sort.split('-');
            formData = new FormData();
        formData.append("category", category);
        formData.append('order', dataSorting[0]);
        formData.append('orderby', dataSorting[1]);
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

    $("#sorting").on('change', function (e) {
        var sort = $(this).val(),
            category = $('#product-category').val(),
            formData = new FormData(),
            dataSorting = sort.split('-');
        formData.append('order', dataSorting[0]);
        formData.append('orderby', dataSorting[1]);
        formData.append('category', category);
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

});
