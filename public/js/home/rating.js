$(document).ready(function ($) {
// Rating
    $( 'input[type=radio][name=star]' ).change(function () {

        var onStar = $(this).val();
        $(this).parents('#stars').children('.item-star').each(function(e){

            if (e < onStar) {
                $(this).addClass('selected');
            }
            else {
                $(this).removeClass('selected');
            }
        });
            console.log($('#form-rating').attr('action'));
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            url: $('#form-rating').attr('action'),
            data: $('#form-rating').serialize(),
            success: function(data) {
              console.log(data);

               console.log(data.star);
              alert('Ban da danh gia bai viet '+data.star+' sao');
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    })

    $('#stars .item-star').on('mouseover', function(){
        var input = $(this).find('input[type=radio]');
        var onStar = parseInt($(this).find('input[type=radio]').val(), 10);

        $(this).parent().children('.item-star').each(function(e){

          if (e < onStar) {
            $(this).addClass('hover');
          }
          else {
            $(this).removeClass('hover');
          }
        });


      }).on('mouseout', function(){
        $(this).parent().children('li.item-star').each(function(e){
          $(this).removeClass('hover');
        });
      });
    })
