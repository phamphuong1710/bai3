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
                var price = parseInt(usd['buy'].replace(',', ''));
                $('.usd-to-vnd').val(price);
            }
        });


});
