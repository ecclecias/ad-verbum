<?php

/**
 * Plugin Name: Bíblia Ad Verbum - Ecclesias
 * Description: Plugin com shortcode das Escrituras Sagradas.
 * Author: Ecclesias
 * Version: 1.0.0
 */

include(plugin_dir_path(__FILE__) . 'inc/register_bible_post.php');
include(plugin_dir_path(__FILE__) . 'inc/add_custom_fields.php');
include(plugin_dir_path(__FILE__) . 'inc/element_utils.php');
include(plugin_dir_path(__FILE__) . 'inc/ad_verbum_shortcode.php');

function single_page_bible($template)
{

    if (get_post_type() === "bible") {
        return plugin_dir_path(__FILE__) . 'single-bible.php';
    }

    return $template;
}

add_filter('template_include', 'single_page_bible');
