function handleDeviceChange(deviceMql, $) {
     if (deviceMql.matches){
         $('button#menu-toggle-btn').hide();
     } else {
         $('section#block-menu-menu-jobs-menu > ul.nav').removeClass('nav-tabs nav-justified').addClass('nav-pills');
     }
}

jQuery(document).ready(function($) {
    const pathName = window.location.pathname.toString();
    // if (pathName.startsWith('/job/')) {
    //     Cookies.set('name', 'value', { expires: 7, path: '' });
    // }

    let deviceMql = window.matchMedia("(min-width: 768px)");
    deviceMql.addListener(handleDeviceChange);
    handleDeviceChange(deviceMql, $);

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

    //Hide super featured jobs box when empty
    const superFeaturedBox = $('div.super-featured-jobs');
    if ($.trim(superFeaturedBox.text()) === '') {
        superFeaturedBox.hide();
    }

    $('section.block-simplenews').addClass('well well-sm');
    $('form.simplenews-subscribe input').addClass('input-sm');

    const table = $('section#block-system-main table');
    table.removeAttr('style');
    table.removeClass();
    table.addClass('table table-bordered table-condensed table-striped');

    $('input#edit-combine-search').attr('placeholder', 'Job title or company name e.g. manager, tigo, ...');
    $('div.views-exposed-widgets > div#edit-search-employer-wrapper').addClass('col-md-6');
    $('form.simplenews-unsubscribe > div > button').addClass('btn-sm btn-block');
    $('form.simplenews-subscribe > div > button').addClass('btn-sm btn-block');

    $('div#field-employer-add-more-wrapper > div.form-item').append('<a href="/node/add/employer">Can\'t find an employer? Create one.</a>');

    const topBannerImage = $('div.field-name-field-banner-code img');
    if (!topBannerImage.hasClass('img-responsive')) {
        topBannerImage.addClass('img-responsive');
    }
    if (!topBannerImage.hasClass('pull-right')) {
        topBannerImage.addClass('pull-right');
    }

});