
<?php
while (have_posts()) : the_post();

    get_header();

    $abbrev = get_post_meta(get_the_ID(), "abbrev", true);
    $ad_verbum = do_shortcode('[ad_verbum_shortcode translation="' . $abbrev . '"][/ad_verbum_shortcode]');
    
    echo $ad_verbum;

    get_footer();

endwhile;
