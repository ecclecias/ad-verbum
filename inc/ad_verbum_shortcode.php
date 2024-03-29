<?php

// Shortcode for the Bibles
function ad_verbum_shortcode($atts)
{
    // Get Bible
    $atts = shortcode_atts(array(
        'translation' => 'ACF',
    ), $atts);

    $args = array(
        'post_type' => 'bible',
        'posts_per_page' => 1,
        'query_meta' => array(
            'abbrev' => $atts['translation']
        )
    );

    $bibles = get_posts($args);

    if (!$bibles[0]) return;

    // Insert Style and Script
    $plugin_dir = plugin_dir_url(__FILE__);

    wp_enqueue_script(
        basename($plugin_dir . "../js/bible-navigator.js"),
        $plugin_dir . "../js/bible-navigator.js",
        array(),
        null,
        true
    );

    wp_enqueue_style(
        'holy-bible',
        $plugin_dir . '../css/bible-navigator.css',
        array(),
        '1.0.0',
        'all'
    );

    // Create Elements
    $output = createBibleElement($bibles[0]);
    $output .= createFloatButton();

    return $output;
}

add_shortcode("ad_verbum_shortcode", "ad_verbum_shortcode");
