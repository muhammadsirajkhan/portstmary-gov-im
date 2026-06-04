<?php
/**
 * Public Amenities page template.
 *
 * Template Name: Public Amenities Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-public-amenities">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('public-amenities-banner.jpg'),
            'image_seed' => 'psm-public-amenities-banner',
        )
    );

    get_template_part('template-parts/sections/amenities-community-spaces');
    get_template_part('template-parts/sections/amenities-facilities');
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
