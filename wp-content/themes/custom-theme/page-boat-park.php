<?php
/**
 * Boat Park page template.
 *
 * Template Name: Boat Park Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-boat-park">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('boat-park-banner.jpg'),
            'image_seed' => 'psm-boat-park-banner',
        )
    );

    get_template_part('template-parts/sections/boat-park-community');
    get_template_part('template-parts/sections/boat-park-facilities');
    get_template_part('template-parts/sections/boat-park-mooring');
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
