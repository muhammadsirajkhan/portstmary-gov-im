<?php
/**
 * Housing Services page template.
 *
 * Template Name: Housing Services Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-housing-services">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('housing-services-banner.jpg'),
            'image_seed' => 'psm-housing-services-banner',
        )
    );

    get_template_part('template-parts/sections/housing-services');
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
get_footer();
?>
