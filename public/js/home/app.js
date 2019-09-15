$(document).ready(function(){
    $(window).scroll(function() {
        if ( $(window).scrollTop()  > 100 ) {
            $( '.btn-back-to-top' ).removeClass('btn-hidden');
            $( '.btn-back-to-top' ).addClass( 'btn-show' );
        }
        else {
            $( '.btn-back-to-top' ).removeClass('btn-show');
            $( '.btn-back-to-top' ).addClass('btn-hidden');
        }
    } );

    $( '.btn-back-to-top' ).on( 'click', function() {
        $('html, body').animate({ scrollTop: 0 }, 500);
    } );
})
