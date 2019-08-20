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
                console.log(data);
                var html = '';
                $.each( data, function (index, value) {
                    html += '<div class="col-md-4">' +
                                '<div class="card mb-4 box-shadow">' +
                                    '<img class="card-img-top" src="' + value.logo.image_path + '" alt="Card image cap">' +
                                    '<div class="card-body">' +
                                        '<h4 class="store-name">' + value.name + '</h4>' +
                                        '<span class="store-phone store-text">' +
                                            '<span class="label">Phone: </span>' +
                                            value.phone +
                                        '</span>' +
                                        '<span class="store-address store-text">' +
                                            '<span class="label">Address: </span>' +
                                            value.address +
                                        '</span>' +
                                        '<span class="store-description store-text">' +
                                            '<span class="label">Description: </span>' +
                                            value.description +
                                        '</span>' +
                                        '<div class="d-flex justify-content-between align-items-center btn-group" >' +
                                            '<a href="/stores/' + value.id + '" class="btn-action btn-action btn-view"> View </a>' +
                                            '<a href="/stores/' + value.id + '/edit" class="btn-action btn-edit">Edit</a>' +
                                            '<form action="/stores/' + value.id + '" method="POST" class="form-delete">' +
                                                '<input type="hidden" name="_method" value="delete">' +
                                                '<button type="submit" class="btn-action btn-delete btn-delete-store" data-id="' + value.id + '">Delete</button>' +
                                            '</form>' +
                                        '</div>' +
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
            url: "/filter-store",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                var html = '';
                $.each( data, function (index, value) {
                    html += '<div class="col-md-4">' +
                                '<div class="card mb-4 box-shadow">' +
                                    '<img class="card-img-top" src="' + value.logo.image_path + '" alt="Card image cap">' +
                                    '<div class="card-body">' +
                                        '<h4 class="store-name">' + value.name + '</h4>' +
                                        '<span class="store-phone store-text">' +
                                            '<span class="label">Phone: </span>' +
                                            value.phone +
                                        '</span>' +
                                        '<span class="store-address store-text">' +
                                            '<span class="label">Address: </span>' +
                                            value.address +
                                        '</span>' +
                                        '<span class="store-description store-text">' +
                                            '<span class="label">Description: </span>' +
                                            value.description +
                                        '</span>' +
                                        '<div class="d-flex justify-content-between align-items-center btn-group" >' +
                                            '<a href="/stores/' + value.id + '" class="btn-action btn-action btn-view"> View </a>' +
                                            '<a href="/stores/' + value.id + '/edit" class="btn-action btn-edit">Edit</a>' +
                                            '<form action="/stores/' + value.id + '" method="POST" class="form-delete">' +
                                                '<input type="hidden" name="_method" value="delete">' +
                                                '<button type="submit" class="btn-action btn-delete btn-delete-store" data-id="' + value.id + '">Delete</button>' +
                                            '</form>' +
                                        '</div>' +
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
});
