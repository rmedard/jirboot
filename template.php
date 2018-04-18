<?php

/**
 * @file
 * The primary PHP file for this theme.
 */

function jirboot_status_messages($variables){
    $display = $variables['display'];
    $output = '';

    $status_heading = array(
        'status' => t('Status message'),
        'error' => t('Error message'),
        'warning' => t('Warning message'),
    );
    foreach (drupal_get_messages($display) as $type => $messages) {
        $output .= "<div class=\"messages $type\">\n";
        if (!empty($status_heading[$type])) {
            $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
        }
        if (count($messages) > 1) {
            $output .= " <ul>\n";
            foreach ($messages as $message) {
                $output .= '  <li>' . $message . "</li>\n";
            }
            $output .= " </ul>\n";
        }
        else {
            $output .= reset($messages);
        }
        $output .= "</div>\n";
    }
    return $output;
}