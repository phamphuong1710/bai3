<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('test') }}"  method="POST">
        @csrf
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
        <button type="submit" id="button">Comment</button>
    </form>
    <ul id="list-comment">
        <li id="comment-">
            <ul id=""></ul>
        </li>

    </ul>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
// $( 'button' ).on('click', function (e) {
        //     e.preventDefault();
        //     var formData = new FormData();
        //     var  token = $('input[name=_token]').val();
        //     var comment = $('#comment').val();
        //     formData.append('_token', token);
        //     formData.append('comment', comment);
        //     console.log(comment);
        //     console.log(formData);
        // $.ajaxSetup({
        //     headers: {
        //       'X-CSRF-TOKEN': token,

        //     }
        // });
        //     $.ajax({
        //         url: '/test',
        //         type: 'POST',
        //         data: formData,
        //         contentType: false,
        //         success: function (data) {
        //             console.log(data);

        //         },
        //         error: function (xhr, status, error) {
        //             alert(xhr.responseText);
        //         }
        //     });

        // });

$(document).ready(function(){
    $( '#button' ).click( function (e) {
        e.preventDefault();
        var comment = $("#comment").val();
        var formData = new FormData();
        var url = $('form').attr('action');
        console.log(url);
        formData.append("comment", comment);
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            }
        });
        $.ajax({
            url: url+'?asd=jksdadkjas',
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                $("#list-comment")
                $("#comment").val("");


            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
});
    </script>
</body>
</html>
