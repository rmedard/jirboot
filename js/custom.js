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

    const table = $('table');

    if (!table.hasClass('table')) {
        table.addClass('table');
    }

    if (!table.hasClass('table-bordered')) {
        table.addClass('table-bordered');
    }

    if (!table.hasClass('table-condensed')) {
        table.addClass('table-condensed');
    }

    $('input#edit-combine-search').attr('placeholder', 'Job title or company name e.g. manager, tigo, ...');
    $('a.apply-btn').removeClass('btn-link btn-').addClass('btn-success btn-sm btn-block');
    $('div.views-exposed-widgets > div#edit-search-employer-wrapper').addClass('col-md-6');
    $('form.simplenews-unsubscribe > div > button').addClass('btn-sm btn-block');
    $('form.simplenews-subscribe > div > button').addClass('btn-sm btn-block');

});