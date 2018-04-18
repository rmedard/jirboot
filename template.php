<?php

include ('parser/simple_html_dom.php');
/**
 * @file
 * The primary PHP file for this theme.
 */

function jirboot_preprocess_block(&$variables){
    if ($variables['block']->delta == 'menu-jobs-menu'){
        print_r($variables['content']);
        $jobs_menu = menu_load_links('menu-jobs-menu');

        $output = '<ul class="nav nav-tabs">';

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
            }

            $output .= '<li role="presentation"><a href="'. $menu['link_path'] .'">' . $menu['link_title'] . ' <span class="badge">'. $menu['jobs_count'] .'</span></a></li>';

//            $query8 = new EntityFieldQuery();
//            $consultancy = $query8->entityCondition('entity_type', 'node')
//                ->entityCondition('bundle', 'job')
//                ->propertyCondition('status', NODE_PUBLISHED)
//                ->fieldCondition('field_offer_type', 'value', 'Consultancy')
//                ->count()->execute();
//
//            $query3 = new EntityFieldQuery();
//            $tenders = $query3->entityCondition('entity_type', 'node')
//                ->entityCondition('bundle', 'job')
//                ->propertyCondition('status', NODE_PUBLISHED)
//                ->fieldCondition('field_offer_type', 'value', 'Tender')
//                ->count()->execute();
//
//            $query4 = new EntityFieldQuery();
//            $intern = $query4->entityCondition('entity_type', 'node')
//                ->entityCondition('bundle', 'job')
//                ->propertyCondition('status', NODE_PUBLISHED)
//                ->fieldCondition('field_offer_type', 'value', 'Internship')
//                ->count()->execute();
//
//            $query5 = new EntityFieldQuery();
//            $others = $query5->entityCondition('entity_type', 'node')
//                ->entityCondition('bundle', 'job')
//                ->propertyCondition('status', NODE_PUBLISHED)
//                ->fieldCondition('field_offer_type', 'value', 'Other')
//                ->count()->execute();
//
//            $query6 = new EntityFieldQuery();
//            $emps = $query6->entityCondition('entity_type', 'node')
//                ->entityCondition('bundle', 'employer')
//                ->propertyCondition('status', NODE_PUBLISHED)
//                ->fieldCondition('field_employer_public_employer', 'value', 1)->execute();
//
//            $publics = 0;
//            if (isset($emps['node'])) {
//                $emps_ids = array_keys($emps['node']);
//                $query7 = new EntityFieldQuery();
//                $publics = $query7->entityCondition('entity_type', 'node')
//                    ->entityCondition('bundle', 'job')
//                    ->propertyCondition('status', NODE_PUBLISHED)
//                    ->fieldCondition('field_employer', 'target_id', $emps_ids, 'IN')
//                    ->count()->execute();
//            }
        }
        $output .= '</ul>';
        $variables['content'] = $output;
    }
}