<?php

include ('parser/simple_html_dom.php');
/**
 * @file
 * The primary PHP file for this theme.
 */

function jirboot_preprocess_block($variables){
    if ($variables['block']->delta == 'menu-jobs-menu'){
//        $all_menu = menu_load_all();
//        $jobs_menu = menu_tree_all_data('menu-jobs-menu');
        $jobs_menu = menu_load_links('menu-jobs-menu');

        foreach ($jobs_menu as $key => $menu){
            var_dump('Title: ' . $menu['link_title'] . ' Path: ' . $menu['link_path']);
        }
    }
}