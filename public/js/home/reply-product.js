$(document).ready(function ($) {

    $('#comment').on('click', '.reply-comment', function (e) {
        e.preventDefault();
        var parentId = $(this).attr('comment'),
            productId = $('#product-id').val(),
            replyForm = $(this).parents('.comment-item-wrapper').find('.reply-form'),
            form = '<form action="/comment-product" method="POST" class="form-comment">' +
                    '<textarea name="comment" class="input-comment" rows="5" placeholder="Enter Comment"></textarea>' +
                    '<button class="btn btn-post-comment" type="submit">' +
                        '<span class="btn-main">' +
                            '<span class="btn-default">Comment</span>' +
                            '<span class="text-hover">Comment</span>' +
                            '<span class="btn-hover"></span>' +
                        '</span> ' +
                    '</button>' +
                    '<input type="hidden" name="product_id" value="' + productId + '">' +
                    '<input type="hidden" name="parent_id" value="' + parentId + '">' +
                '</form>';
        replyForm.find('.form-comment').remove();
        replyForm.append(form);
        var textarea = replyForm.find('.input-comment');
        $(textarea, this).focus();
    })
});
