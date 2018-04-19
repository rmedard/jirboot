jQuery(document).ready(function($) {
    if (window.matchMedia("(min-width: 400px)").matches) {
        /* the viewport is at least 400 pixels wide */
    } else {
        $('body.front').css('background-color', 'red');
        $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-justified');
        /* the viewport is less than 400 pixels wide */
    }

    const pathName = window.location.pathname.toString();
    $('section#block-menu-menu-jobs-menu > ul.nav > li').each(function (index, value) {
        let link = $(this).find('a').attr('href');
        if (pathName === '/'){
            $(this).last().tab('show');
        } else {
            if (link === pathName){
                $(this).tab('show');
            }
        }
    });
});