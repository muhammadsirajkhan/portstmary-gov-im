<?php
/**
 * Your Commissioners page template.
 *
 * Template Name: Your Commissioners Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-commissioners">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('commissioners-banner.jpg'),
            'image_seed' => 'psm-commissioners-banner',
            'heading_id' => 'psm-commissioners-page-title',
        )
    );

    get_template_part('template-parts/sections/commissioners-serving');
    get_template_part('template-parts/sections/commissioners-officers');
    get_template_part('template-parts/sections/commissioners-hours');
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
