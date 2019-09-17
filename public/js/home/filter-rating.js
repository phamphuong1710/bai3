$(document).ready(function(){
    var lang  = $('html').attr('lang');
    $( '.rating-sidebar-input' ).on( 'change', function (e) {
        var btn = $(this);
        $( '.list-rating' ).find('.is-selected').removeClass('is-selected');
        btn.addClass('is-selected');
        var rating = btn.val();
        var formData = {
            rating: rating,
        };

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: 'GET',
            url: '/store/rating/' + rating,
            data: formData,
            beforeSend: function (data) {
                $( '.page-loading' ).addClass('loading');
                $( '.loading' ).fadeIn();
            },
            success: function(data) {
                $('.loading').delay(500).fadeOut();
                $( '.page-loading' ).removeClass('loading');
                var html = '<div class="list-store content-ajax"><div class="wrapper row  justify-content-center">';

                html += storeTemplate(data);
                html += '</div></div>'
                $('#primary').html(html);
                var page = 1;
                var contentHeight = $('.content-ajax').height();
                var position = $('.content-ajax').height() + $('.content-ajax').offset().top;
                $(window).scroll(function() {
                    var scroll = $(window).scrollTop();
                    if( scroll > position + ( contentHeight / 3 ) ) {
                        position = position + contentHeight;
                        page++;
                        loadMoreStore(page, rating);
                    }
                });
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }

    function loadMoreStore(page, rating){
        $.ajax(
        {
            url: 'store/rating/' + rating + '?page=' + page,
            type: "get",
            beforeSend: function()
            {
                $('.content-ajax').addClass('loading');
            },
            success: function(data) {
                $('.content-ajax').delay(500).removeClass('loading');
                $( '.page-loading' ).removeClass('loading');
               var html = storeTemplate(data);

                $("body .product-wrapper").append(html);

            },
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                $('.ajax-load').hide();
            alert('server not responding...');

            });
    };

    function storeTemplate(data) {
        html = '';
        $.each( data.data, function (index, value) {
            var avg = value.rating_average;
            var score = ( avg / 5 ) * 100;

            html += '<div class="col-md-4 store-item-wrapper">' +
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
                                '<div class="wt-star-rating">' +
                                    '<span class="star-reviewed" style="width: ' + score + '%">' +
                                    '</span>' +
                                '</div>' +

                            '</div>' +
                        '</div>' +
                    '</div>';
        } );


        return html;
    }
});
