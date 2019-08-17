$(document).ready(function ($) {
// Rating
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

                $('.ajax-search-html').html(data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
})
