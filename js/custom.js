$(document).ready(function(){
    var isMobile = window.matchMedia("only screen and (max-width: 480px)");

    if (isMobile.matches) {
        $('body').css('background-color', 'red');
        $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-justified');
    }
});