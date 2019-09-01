$(document).ready(function ($) {
    $( '.item-link' ).on( 'click', function (e) {
        e.preventDefault();
        var $currentTab = $(e.target);
        var $currentTabContent = $(e.target.hash);
        var $tabs = $('.list-tab');
        var $content = $('.store-content');

        $($tabs.find('.item-link')).removeClass('active');
        $($content.find('.stores-wrapper')).removeClass('is-selected');

        $currentTab.addClass('active');
        $currentTabContent.addClass('is-selected');
    });
});
