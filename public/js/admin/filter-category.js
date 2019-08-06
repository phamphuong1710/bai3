$(document).ready(function(){

    $("#input-category").on('keyup', function (e) {
        var category = $(this).val();

        var formData = new FormData();
        formData.append("category", category);
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

    $('#sorting').on('change', function(e) {
        var sort = $(this).val(),
            formData = new FormData(),
            dataSorting = sort.split('-');
        console.log(dataSorting);
        formData.append('order', dataSorting[0]);
        formData.append('orderby', dataSorting[1]);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/filter-category",
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

    $('.sorting').on('click', function () {
        var btn = $(this),
            order = btn.attr('data-sort'),
            desc = btn.hasClass('desc'),
            asc = btn.hasClass('asc'),
            formData = new FormData(),
            orderby;
        if ( desc ) {
            btn.removeClass('desc').addClass('asc');
            orderby = "asc";
        }

        if ( asc ) {
            btn.removeClass('asc').addClass('desc');
            orderby = "desc";
        }

        formData.append('order', order);
        formData.append('orderby', orderby);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/filter-category",
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
