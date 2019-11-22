$(document).ready(function(){

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
                $('.href').val(data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    })
})
