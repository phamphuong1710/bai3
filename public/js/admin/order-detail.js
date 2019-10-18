$(document).ready(function(){
    $( '.btn-show-order' ).on('click', function (e) {
        e.preventDefault();
        var btn = $(this),
            url = $(this).attr('href');

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
            beforeSend: function (data) {
                $( '#order-detail' ).addClass( 'active' );
            },
            success: function (data) {
                $('#order-detail-wrapper').html(data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('.order-detail').on('click', '.btn-close-popup', function (e) {
        $('#order-detail').removeClass('active');
    });

    $('#order-detail').on('change', '#order-status', function(){
        var status = $(this).val();
        var id = $(this).attr('order');
        var formData = new FormData();
        formData.append('status', status);
        formData.append('_method', 'PUT');
        formData.append('type','post');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: 'order/' + id,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function (data) {
                $( '#order-detail' ).addClass( 'active' );
            },
            success: function (data) {
                $('#order-detail-wrapper').html(data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});
