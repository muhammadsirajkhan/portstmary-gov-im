<?php
/**
 * Freedom of Information page template.
 *
 * Template Name: FOI Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('foi-banner.jpg'),
            'image_seed' => 'psm-foi-banner',
        )
    );

    get_template_part('template-parts/sections/foi');
    get_template_part('template-parts/sections/news');
    ?>
</main>

<?php
get_footer();
