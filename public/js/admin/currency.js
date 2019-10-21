$(document).ready(function(){
    const now = new Date();
    $.ajax(
    {
        url: "http://e.cafef.vn/rate.ashx?rd=" + now.getTime() + "&fbclid=IwAR0WB-4qp7caoaCYkIybyjp7CUxEL6Kfb7PnuTqCtx36T1bfXFE5N00i0sk",
        type: 'GET',
        success: function ($data){
            data = JSON.parse($data);
            var usd = data[0];
            var price = parseInt(usd['buy'].replace(',', ''));
            console.log(price);
            $('body').find('.usd-to-vnd').val(price);
            console.log($('body').find('.usd-to-vnd'));
        }
    });
});
