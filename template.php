<?php

/**
 * @file
 * The primary PHP file for this theme.
 */

function jirboot_preprocess_page(&$variables) {
    // Add information about the number of sidebars.
    if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
        $variables['content_column_class'] = ' class="col-sm-8"';
    }
    elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
        $variables['content_column_class'] = ' class="col-sm-8"';
    }
    else {
        $variables['content_column_class'] = ' class="col-sm-12"';
    }

    if(bootstrap_setting('fluid_container') === 1) {
        $variables['container_class'] = 'container-fluid';
    }
    else {
        $variables['container_class'] = 'container';
    }
}

function jirboot_preprocess_block(&$variables){
    if ($variables['block']->delta == 'menu-jobs-menu'){

        $jobs_menu = menu_load_links('menu-jobs-menu');

        $output = '<ul class="nav nav-tabs nav-justified">';

        foreach ($jobs_menu as $key => $menu){
            switch ($menu['link_path']){
                case 'jobs/featured':
                    $query1 = new EntityFieldQuery();
                    $featured = $query1->entityCondition('entity_type', 'node')
                        ->entityCondition('bundle', 'job')
                        ->propertyCondition('status', NODE_PUBLISHED)
                        ->fieldCondition('field_posting_type', 'tid', array(33, 34, 36), 'IN')
                        ->count()->execute();
                    $menu['jobs_count'] = $featured;
                    break;
                case 'jobs/all':
                    $query2 = new EntityFieldQuery();
                    $alljobs = $query2->entityCondition('entity_type', 'node')
                        ->entityCondition('bundle', 'job')
                        ->propertyCondition('status', NODE_PUBLISHED)
                        ->fieldCondition('field_offer_type', 'value', 'Job')
                        ->count()->execute();
                    $menu['jobs_count'] = $alljobs;
                    break;
                case 'jobs/tender':
                    $query3 = new EntityFieldQuery();
                    $tenders = $query3->entityCondition('entity_type', 'node')
                        ->entityCondition('bundle', 'job')
                        ->propertyCondition('status', NODE_PUBLISHED)
                        ->fieldCondition('field_offer_type', 'value', 'Tender')
                        ->count()->execute();
                    $menu['jobs_count'] = $tenders;
                    break;
                case 'jobs/consultancy':
                    $query8 = new EntityFieldQuery();
                    $consultancy = $query8->entityCondition('entity_type', 'node')
                        ->entityCondition('bundle', 'job')
                        ->propertyCondition('status', NODE_PUBLISHED)
                        ->fieldCondition('field_offer_type', 'value', 'Consultancy')
                        ->count()->execute();
                    $menu['jobs_count'] = $consultancy;
                    break;
                case 'jobs/internships':
                    $query4 = new EntityFieldQuery();
                    $intern = $query4->entityCondition('entity_type', 'node')
                        ->entityCondition('bundle', 'job')
                        ->propertyCondition('status', NODE_PUBLISHED)
                        ->fieldCondition('field_offer_type', 'value', 'Internship')
                        ->count()->execute();
                    $menu['jobs_count'] = $intern;
                    break;
                case 'jobs/public-adverts':
                    $query6 = new EntityFieldQuery();
                    $emps = $query6->entityCondition('entity_type', 'node')
                        ->entityCondition('bundle', 'employer')
                        ->propertyCondition('status', NODE_PUBLISHED)
                        ->fieldCondition('field_employer_public_employer', 'value', 1)->execute();
                    $publics = 0;
                    if (isset($emps['node'])) {
                        $emps_ids = array_keys($emps['node']);
                        $query7 = new EntityFieldQuery();
                        $publics = $query7->entityCondition('entity_type', 'node')
                            ->entityCondition('bundle', 'job')
                            ->propertyCondition('status', NODE_PUBLISHED)
                            ->fieldCondition('field_employer', 'target_id', $emps_ids, 'IN')
                            ->count()->execute();
                    }
                    $menu['jobs_count'] = $publics;
                    break;
                case 'jobs/others':
                    $query5 = new EntityFieldQuery();
                    $others = $query5->entityCondition('entity_type', 'node')
                        ->entityCondition('bundle', 'job')
                        ->propertyCondition('status', NODE_PUBLISHED)
                        ->fieldCondition('field_offer_type', 'value', 'Other')
                        ->count()->execute();
                    $menu['jobs_count'] = $others;
                    break;
            }

            if (intval($menu['jobs_count']) > 0) {
                $output .= '<li role="presentation"><a href="/'. $menu['link_path'] .'">' . $menu['link_title'] . ' <span class="badge">'. $menu['jobs_count'] .'</span></a></li>';
            }
        }
        $output .= '</ul>';
        $variables['content'] = $output;
    }
}