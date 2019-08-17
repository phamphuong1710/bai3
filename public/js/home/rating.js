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
                var star = '',
                    no = '';
                for (var i = 0; i < data.star; ++i) {
                    star += '<li class="star selected">' +
                                '<span class="ion-android-star"></span>' +
                          ' </li>'
                }
                for (var i = 0; i < ( 5 - data.star ); ++i) {
                    no += '<li class="star">' +
                                '<span class="ion-android-star"></span>' +
                          ' </li>'
                }
                alert('Ban da danh gia bai viet '+ data.star +' sao');
                $('.rating-star').html(
                    '<ul id="stars" class="rating">' +
                        star +
                        no +

                    '</ul>'+
                    '<span>Bạn đã đánh giá sản phẩm ' + data.star + ' sao</span>'
                );
                $('.rating-average').html(numberFormat(data.rating_average, 1));
                $('.number-rating span').html(data.number + ' đánh giá');
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

    function numberFormat($number, $lenght) {
        var ex = Math.pow(10, $lenght ) ;
        $number = parseInt( $number * ex );
        $number = $number / ex;

        return $number;
    }
})

