$(document).ready(function ($) {
    $( '#comment' ).on( 'click', '.btn-post-comment', function (e) {
        e.preventDefault();
        var form = $(this).parents('.form-comment');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            url: form.attr('action'),
            data: form.serialize(),
            success: function(data) {
                $('.comment-list').html(data);
                $('#input-comment').val('');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});

