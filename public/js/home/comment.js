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
                console.log(data);
                var child = $('.list-comment-child');
                var item = $( '.comment-list' ).find('.comment-item');
                var first = item[0];
                var html = '<li class="comment-item">' +
                            '<div class="comment-item-wrapper">' +
                                '<div class="comment-info">' +
                                    '<div class="comment-info-left">' +
                                        '<span class="author">' + data.author + '</span>' +
                                        '<span class="created-at ion-clock">' + data.time + '</span>' +
                                    '</div>' +
                                    '<a href="#" class="reply-comment ion-chatbubble" comment="' + data.parent_id + '">Reply</a>' +
                                 '</div>' +
                                '<span class="comment-content">' + data.content + '</span>' +
                                '<div class="reply-form"></div>' +
                            '</div>' +
                        '</li>';
                if ( data.parent_id == 0 ) {

                        $('.comments').prepend( html );
                        $('#input-comment').val('');


                } else {
                    child.each(function (index) {
                        var btn = $(this);
                        if ( btn.attr('data-comment') == data.parent_id ) {
                            btn.append( html );
                            form.remove();
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
    console.log(22);
});

