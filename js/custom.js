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

// function handleOrientationChange(mql, $) {
//     if (mql.matches){
//         $('div#jir-footer > div > div').addClass('col-xs-6');
//     }
// }