$(document).ready(function(){
    "use strict";
    var pull = $( '.menu-toggle' );
    var menu = $( '#primary-menu' );
    $(pull).on( 'click' , function(){
        menu.slideToggle();
        $('li.menu-item-has-children>a').on('click',function(event){

            event.preventDefault()

            $(this).parent().find('ul').first().toggle();
            $(this).parent().siblings().find('ul').hide(200);

        //Hide menu when clicked outside
            $(this).parent().find('ul').mouseleave(function(){
                var thisUI = $(this);
                $('html').click(function(){
                    thisUI.hide();
                    $('html').unbind('click');
                });
            });

        } );

    });


    var w = $(window).width();
    $(window).resize( function() {
        if (w>992 && menu.is(':hidden')) {
            menu.removeAttr('style');
            menu.find('.style').removeClass('style');
        }
    } );


})
