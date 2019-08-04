$(document).ready(function(){
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
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

});
