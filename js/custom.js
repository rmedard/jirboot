function handleOrientationChange(mql, $) {
    if (mql.matches){
        $('div#jir-footer > div > div').addClass('col-xs-6');
    }
}

function handleDeviceChange(deviceMql, $) {
    if (deviceMql.matches){
        $('button#menu-toggle-btn').hide();
    } else {
        $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-tabs nav-justified').addClass('nav-pills');
        if (window.matchMedia("(orientation: landscape)").matches){
            $('div#jir-footer > div > div').addClass('col-xs-6');
        }


        // let orientationMql = window.matchMedia("(orientation: landscape)");
        // orientationMql.addListener(handleOrientationChange);
        // handleOrientationChange(orientationMql, $);
    }
}

jQuery(document).ready(function($) {
    let deviceMql = window.matchMedia("(min-width: 768px)");
    deviceMql.addListener(handleDeviceChange);
    handleDeviceChange(deviceMql, $);

    // let orientationMql = window.matchMedia("(orientation: landscape)");
    // orientationMql.addListener(handleOrientationChange);
    // handleOrientationChange(orientationMql, $);

    // if (window.matchMedia("(min-width: 768px)").matches) {
    //     $('button#menu-toggle-btn').hide();
    // } else {
    //     $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-tabs nav-justified').addClass('nav-pills');
    //     // var mediaQueryListener = window.matchMedia("(orientation: landscape)");
    //     // mediaQueryListener.addListener(handleOrientationChange);
    //     // handleOrientationChange(mediaQueryListener, $);
    // }

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