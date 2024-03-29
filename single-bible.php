
<?php
while (have_posts()) : the_post();

    get_header();

    $args = array(
        'post_type' => 'bible',
        'posts_per_page' => -1,
    );

    $bibles = get_posts($args);

    $abbrev = get_post_meta(get_the_ID(), "abbrev", true);

    if ( count($bibles) > 1 ) {
        echo '<div class="wrapper-buttons">';

        foreach ($bibles as $bible) {
            $translation = get_post_meta( $bible->ID, "abbrev", true );
    
            if ( $translation === $abbrev ) {
                echo '<button class="active">' . $translation . '</button>';
            } else {
                $href = get_permalink($bible->ID);

                echo '<a href="' . $href . '">';
                echo '<button>' . $translation . '</button>';
                echo '</a>';
            }
        }
    
        echo '</div>';
    }

    $ad_verbum = do_shortcode('[ad_verbum_shortcode translation="' . $abbrev . '"][/ad_verbum_shortcode]');

    echo $ad_verbum;

    get_footer();

endwhile;
