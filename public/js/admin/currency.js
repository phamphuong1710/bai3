$(document).ready(function(){
    const now = new Date();
    $.ajax(
    {

        url: "http://e.cafef.vn/rate.ashx?rd=1564503549803&fbclid=IwAR0WB-4qp7caoaCYkIybyjp7CUxEL6Kfb7PnuTqCtx36T1bfXFE5N00i0sk",
        type: 'GET',
        data: {
            'time': now.getTime()
        },
        success: function ($data){

            data = JSON.parse($data);
            var usd = data[0];
            var i = parseInt(usd['buy'].replace(',', ''));
            var prices = $('.price');
            prices.each(function (index) {
                var $price = parseInt($(this).attr('price'));
                console.log($(this).html());
                var $convert = parseFloat($price/i);
                $(this).html($convert.toFixed(2));
            })
        }
    });

});
