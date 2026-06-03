<?php
/**
 * General Public page template.
 *
 * Template Name: General Public Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-general-public">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('general-public-banner.jpg'),
            'image_seed' => 'psm-general-public-banner',
            'heading_id' => 'psm-general-public-page-title',
        )
    );

    get_template_part('template-parts/sections/general-public-housing');
    get_template_part('template-parts/sections/general-public-applying');
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
