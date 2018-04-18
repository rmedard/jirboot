<?php

include ('parser/simple_html_dom.php');
/**
 * @file
 * The primary PHP file for this theme.
 */

function jirboot_preprocess_block($variables){
    if ($variables['block']->delta == 'menu-jobs-menu'){
//        $all_menu = menu_load_all();
        $jobs_menu = menu_tree_all_data('menu-jobs-menu');
        print_r($jobs_menu);
    }
}