<?php
/**
 * Venue Hire page template.
 *
 * Template Name: Venue Hire Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-venue-hire">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('venue-hire-banner.jpg'),
            'image_seed' => 'psm-venue-hire-banner',
        )
    );

    get_template_part('template-parts/sections/venue-hire');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'background' => 'white',
        )
    );
    ?>
</main>

<?php
get_footer(
    null,
    array(
        'variant' => 'white',
    )
);
