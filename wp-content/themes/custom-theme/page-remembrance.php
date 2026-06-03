<?php
/**
 * Remembrance page template.
 *
 * Template Name: Remembrance Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-remembrance">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('remembrance-banner.jpg'),
            'image_seed' => 'psm-remembrance-banner',
        )
    );

    get_template_part('template-parts/sections/remembrance-respect');
    get_template_part('template-parts/sections/remembrance-honour');
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
