$(document).ready(function(){
    $( '.btn-edit' ).on('click', function (e) {
        e.preventDefault();
        var btn = $(this),
            id = btn.attr('data-id'),
            control = btn.attr('controller') ;
            console.log(control);

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: control + '/' + id + '/edit',
            type: 'GET',
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-popup').addClass('active');
                $('.edit-popup-wrapper').html(data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    $('.edit-popup').on('click', '.btn-close-popup', function (e) {
        $('#edit-popup').removeClass('active');
    });
});
