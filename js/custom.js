function handleDeviceChange(deviceMql, $) {
    if (deviceMql.matches){
        $('button#menu-toggle-btn').hide();
    } else {
        $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-tabs nav-justified').addClass('nav-pills');
        window.addEventListener('orientationchange', function (event) {
            console.log('I am in...' + window.orientation);
            if (event.orientation === 'landscape'){
                let footGridParent = $('div#jir-footer > div');
                footGridParent.removeClass('row');
                $('div#jir-footer > div > div.jir-footer-block').each(function () {
                    $(this).removeClass('col-sm-3');
                });
                footGridParent.css({ "width": "100%", "display": "grid", "grid-template-areas": "a a", "grid-gap": "15px" });



                // let jirFooterBlockMinHeight = 0;
                // let jirFooterBlock = $('div.col-sm-3.jir-footer-block');
                // jirFooterBlock.each(function () {
                //     if ($(this).height() > jirFooterBlockMinHeight) {
                //         jirFooterBlockMinHeight = $(this).height();
                //     }
                // });
                // jirFooterBlock.css('min-height', jirFooterBlockMinHeight);
            }
        });
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

    $('div.views-exposed-widgets > div#edit-search-employer-wrapper').addClass('col-md-6');

});