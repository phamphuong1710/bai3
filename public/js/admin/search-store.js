$(document).ready(function(){

    $("#input-store").on('keyup', function (e) {
        var store = $(this).val();

        var formData = new FormData();
        formData.append("store", store);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/search-store",
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
