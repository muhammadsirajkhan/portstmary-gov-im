<?php
/**
 * Meeting Minutes page template.
 *
 * Template Name: Minutes Page
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
            'image'      => psm_theme_image('minutes-banner.jpg'),
            'image_seed' => 'psm-minutes-banner',
        )
    );

    get_template_part('template-parts/sections/minutes');
    get_template_part('template-parts/sections/news');
    ?>
</main>

<?php
get_footer();
