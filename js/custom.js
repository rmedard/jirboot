jQuery(document).ready(function($) {
    if (window.matchMedia("(min-width: 768px)").matches) {
        $('button#menu-toggle-btn').hide();
    } else {
        $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-tabs nav-justified').addClass('nav-pills');
    }

    const pathName = window.location.pathname.toString();
    $('section#block-menu-menu-jobs-menu > ul.nav > li').each(function (index, value) {
        let link = $(this).find('a').attr('href');
        if (pathName === '/'){
            $(this).first().tab('show');
            return false;
        } else {
            if (link === pathName){
                $(this).tab('show');
                return false;
            }
        }
    });
});