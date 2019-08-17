$(document).ready(function(){
    $('.slider-hero').slick({
        dots: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        nextArrow: $( '.btn-slide-next' ),
        prevArrow: $( '.btn-slide-prev' ),
        pauseOnFocus: true

    });

})
