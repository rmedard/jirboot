jQuery(document).ready(function($) {
    if (window.matchMedia("(min-width: 400px)").matches) {
        /* the viewport is at least 400 pixels wide */
    } else {
        $('body.front').css('background-color', 'red');
        $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-justified');
        /* the viewport is less than 400 pixels wide */
    }

    console.log(window.location.pathname);

    $('section#block-menu-menu-jobs-menu > ul.nav > li').each(function (index, value) {
        var link = $(this).find('a').attr('href');
        if (link === window.location.pathname.toString()){
            $(this).tab('show');
        }
    });
});