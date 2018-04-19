jQuery(document).ready(function($) {
    if (window.matchMedia("(min-width: 400px)").matches) {
        /* the viewport is at least 400 pixels wide */
    } else {
        $('body.front').css('background-color', 'red');
        $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-justified');
        /* the viewport is less than 400 pixels wide */
    }

    var currentUrl = window.location.href;
    console.log("Current Url: " + currentUrl);
});