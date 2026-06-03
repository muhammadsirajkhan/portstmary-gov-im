<?php
/**
 * Refuse Services page template.
 *
 * Template Name: Refuse Services Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-refuse-services">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('refuse-services-banner.jpg'),
            'image_seed' => 'psm-refuse-services-banner',
        )
    );

    get_template_part('template-parts/sections/refuse-services');
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
