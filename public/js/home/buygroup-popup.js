$(document).ready(function(){
    var lang = $('html').attr('lang');
    $('.btn-buygroup').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log(url);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: url,
            type: 'GET',
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                $('.link-buy-group-popup').addClass('active');
                $('#shop-overlay').addClass('show');
                if ( data.status == 'success' ) {
                    $('.popup-wrapper').html(
                        '<h4 class="title">Share</h4>' +
                            '<div class="link-share">' +
                            '<span class="text">Copy</span>'+
                            '<input type="text" class="href" value="' + data.link + '">'+
                        '</div>'
                    );
                } else {
                    $('.popup-wrapper').html('');
                    if ( lang == 'en' ) {
                        $('.popup-wrapper').html('<h4 class="error-link">Please place an order in the cart (or delete the cart) before starting group ordering</h4>');
                    } else {
                        $('.popup-wrapper').html('<h4 class="error-link">Vui lòng đặt hàng có trong giỏ hàng ( hoặc xóa giỏ hàng )trước khi bắt đầu  đặt hàng theo nhóm</h4>');
                    }
                }

            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    })
})
