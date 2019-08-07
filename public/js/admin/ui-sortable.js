$(document).ready(function(){
    // UI SORTABLE
    $('.gallery-image-list').sortable({
        cursor: "move",
        update: function(event, ui) {
            var result = $(this).sortable('toArray', {attribute: 'data-item'});
            $('#listImage').val(result);
            $.each(result, function(index, value){
                $('.image-item').each(function(){
                    if ( $(this).attr('data-item') == value ) {
                        $(this).find('.image-position').attr('val', index + 1);
                        $(this).find('.image-position').html(index + 1);
                    }
                });
            })
        }
    });


})
