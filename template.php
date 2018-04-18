<?php

include ('parser/simple_html_dom.php');
/**
 * @file
 * The primary PHP file for this theme.
 */

function jirboot_preprocess_block($variables){
    if ($variables['block']->delta == 'menu-jobs-menu'){
        print_r($variables['block']->module);
    }
}