$(document).ready(function ($) {
     var lang  = $('html').attr('lang');
    $(".input-serach-header").on('keyup', function (e) {
        var keyword = $(this).val(),
            store = $('.store-id').val();
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: "/ajax-search?search=" + keyword,
            type: 'GET',
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                html = '';
                $.each(data, function (index, value) {

                    html += '<div class="store-found-item-wrapper">' +
                        '<div class="store-item item-pro">' +
                            '<div class="men-thumb-item">' +
                                '<a href="/store/' + value.slug + '">' +
                                    '<img src="' + value.logo + '" alt="' + value.name + '">' +
                                '</a>' +
                            '</div>' +
                            '<div class="item-info-store ">' +
                                '<h4 class="item-name">' +
                                    '<a href="/store/' + value.slug + '">' + value.name + '</a>' +
                                '</h4>' +
                                '<span class="store-address">' +
                                    value.address.address +
                                '</span>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
                });

                $('.list-store-find').append(html);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
})

