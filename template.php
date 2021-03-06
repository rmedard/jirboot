<?php

/**
 * @file
 * The primary PHP file for this theme.
 */

/**
 * Implements hook_preprocess_HOOK().
 */
function jirboot_preprocess_html(&$variables)
{
    $variables['check_js_enabled'] = false;
    if (substr(current_path(), 0, strlen('node/')) === 'node/') {
        $variables['check_js_enabled'] = true;
    }
}

function jirboot_preprocess_page(&$variables)
{
    $full_pages = array('services', 'post-advert');
    $management_pages = array('job-applications', 'jobs', 'employers', 'banners', 'faq-manage', 'testimonials-manage', 'news-management');
    if (in_array(current_path(), $full_pages)) {
        $variables['content_column_class'] = ' class="col-sm-12"';
        $variables['display_sidebars'] = 0;
    } elseif (in_array(current_path(), $management_pages)) {
        $variables['content_column_class'] = ' class="col-sm-12"';
        $variables['container_class'] = 'container-fluid';
        $variables['display_sidebars'] = 0;
        $variables['hide_banners'] = 0;
    } else {
        if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
            $variables['content_column_class'] = ' class="col-sm-8"';
        } elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
            $variables['content_column_class'] = ' class="col-sm-8"';
        } else {
            $variables['content_column_class'] = ' class="col-sm-12"';
        }

        if (bootstrap_setting('fluid_container') === 1) {
            $variables['container_class'] = 'container-fluid';
        } else {
            $variables['container_class'] = 'container';
        }
    }
}

function jirboot_preprocess_node(&$variables)
{
    if ($variables['node']->type == 'job') {
        $job_node = $variables['node'];
        if(isset($job_node->field_application_form_type['und'][0]['tid'])) {
            switch (intval($job_node->field_application_form_type['und'][0]['tid'])) {
                case 26:
                    $variables['application_url'] = '/apply-now?field_job=' . $job_node->nid;
                    $variables['target_page'] = '_parent';
                    break;
                case 28:
                    $variables['application_url'] = $job_node->field_external_application_link['und'][0]['url'];
                    $variables['target_page'] = '_blank';
                    break;
                default:
                    $variables['hide_application_btn'] = 0;
                    break;
            }
        } else {
            $variables['hide_application_btn'] = 0;
        }
    }
}

function jirboot_preprocess_block(&$variables)
{
//    var_dump('ID: ' . $variables['block']->delta . ' Title: ' . $variables['block']->subject);
    if ($variables['block']->delta == 'menu-jobs-menu') {

        $jobs_menu = menu_load_links('menu-jobs-menu');

        $output = '<ul class="nav nav-tabs nav-justified" role="tablist">';

        foreach ($jobs_menu as $key => $menu) {
            $menu['jobs_count'] = 0;
            switch ($menu['link_path']) {
                case 'jobs/featured':
                    $query1 = new EntityFieldQuery();
                    $featured = $query1->entityCondition('entity_type', 'node')
                        ->entityCondition('bundle', 'job')
                        ->propertyCondition('status', NODE_PUBLISHED)
                        ->fieldCondition('field_posting_type', 'tid', [
                            33,
                            34,
                            36,
                        ], 'IN')
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
//                        ->fieldCondition('field_offer_type', 'value', 'Consultancy')
                        ->addTag('consultancy_or_freelance')
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
                        ->fieldCondition('field_employer_public_employer', 'value', 1)
                        ->execute();
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
                $output .= '<li role="presentation" style="white-space: nowrap"><a href="/' . $menu['link_path'] . '" role="tab" aria-controls="' . strtolower($menu['link_title']) . '">' . $menu['link_title'] . ' <span class="badge">' . $menu['jobs_count'] . '</span></a></li>';
            }
        }
        $output .= '</ul>';
        $variables['content'] = $output;
    } elseif ($variables['block']->delta == 'jir_realtime') {
        $output = '<div class="panel panel-success">';
        $output .= '<div class="panel-heading"><i class="fa fa-bolt"></i> ';
        $output .= $variables['block']->subject;
        $output .= '</div>';
        $output .= $variables['content'];
        $output .= '</div>';
        $variables['content'] = $output;
    } elseif (in_array($variables['block']->delta, array('5', '13', '14'))) {
        $icons = array('5' => 'fa-home', '13' => 'fa-briefcase', '14' => 'fa-globe');
        $output = '<div class="panel panel-success">';
        $output .= '<div class="panel-heading"><i class="fa ' . $icons[$variables['block']->delta] . '"></i> ';
        $output .= $variables['block']->subject;
        $output .= '</div>';
        $output .= '<div class="panel-body">';
        $output .= $variables['content'];
        $output .= '</div></div>';
        $variables['content'] = $output;
    }
}

/**
 * Implements hook_query_TAG_alter().
 */
function jirboot_query_consultancy_or_freelance_alter(QueryAlterableInterface $query) {
    $query->leftjoin('field_data_field_offer_type', 'o', 'nid = o.entity_id');
    $query->leftjoin('field_data_field_contrat_type', 'c', 'nid = c.entity_id');
    $query->leftjoin('taxonomy_term_data', 'n', 'n.tid = c.field_contrat_type_tid');
    $or = db_or();
    $or->condition('o.field_offer_type_value', 'Consultancy')
        ->condition('n.name', 'Freelance');
    $query->condition($or);
}