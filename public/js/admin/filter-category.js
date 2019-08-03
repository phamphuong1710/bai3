$(document).ready(function(){

    $("#product-category").on('change', function (e) {
        var category = $(this).val(),
            store = $('#store-id').val(),
            formData = new FormData();
        formData.append("category", category);
        formData.append("store", store);
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
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

});
