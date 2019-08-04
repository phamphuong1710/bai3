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
            store = $('#store-id').val(),
            formData = new FormData(),
            dataSorting = sort.split('-');
        console.log(dataSorting);
        console.log(category);
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
});
