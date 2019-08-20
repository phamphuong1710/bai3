$(document).ready(function(){

    $("#input-user").on('keyup', function (e) {
        var user = $(this).val();

        var formData = new FormData();
        formData.append("user", user);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/search-user",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {

                var html = '';
                $.each(data, function (index, value) {
                    html += '<tr>' +
                                '<td><a href="/users/' + value.id + '">' + value.name + '</a></td>' +
                                '<td>' + value.phone + '</td>' +
                                '<td>' + value.email + '</td>' +
                                '<td>' + value.created_at + '</td>' +
                                '<td>' +
                                    '<a href="/users/' + value.id + '/edit" class="btn-action btn-edit">Edit</a>' +
                                    '<form action="/users/ '+ value.id + '" method="POST" class="form-delete"' +
                                        '<input type="hidden" name="_method" value="delete">' +
                                        '<button type="submit" class="btn-action btn-delete">Delete</button>' +
                                    '</form>' +
                                '</td>' +
                            '</tr>';
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
            url: "/filter-user",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                var html = '';
                $.each(data, function (index, value) {
                    html += '<tr>' +
                                '<td><a href="/users/' + value.id + '">' + value.name + '</a></td>' +
                                '<td>' + value.phone + '</td>' +
                                '<td>' + value.email + '</td>' +
                                '<td>' + value.created_at + '</td>' +
                                '<td>' +
                                    '<a href="/users/' + value.id + '/edit" class="btn-action btn-edit">Edit</a>' +
                                    '<form action="/users/ '+ value.id + '" method="POST" class="form-delete"' +
                                        '<input type="hidden" name="_method" value="delete">' +
                                        '<button type="submit" class="btn-action btn-delete">Delete</button>' +
                                    '</form>' +
                                '</td>' +
                            '</tr>';
                })
                $('.ajax-search-html').html(html);
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
            url: "/filter-user",
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
