function handleDeviceChange(deviceMql, $) {
    if (deviceMql.matches){
        $('button#menu-toggle-btn').hide();
    } else {
        $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-tabs nav-justified').addClass('nav-pills');
    }
}

jQuery(document).ready(function($) {
    let deviceMql = window.matchMedia("(min-width: 768px)");
    deviceMql.addListener(handleDeviceChange);
    handleDeviceChange(deviceMql, $);

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

    let jirFooterBlockMaxHeight = 0;

    $('div#jir-footer > div.row > div.col-sm-3').each(function () {
        console.log('height: ' + $(this).height());
        if ($(this).height() > jirFooterBlockMaxHeight) {
            jirFooterBlockMaxHeight = $(this).height();
        }
    });

    console.log('Max height: ' + jirFooterBlockMaxHeight);

});