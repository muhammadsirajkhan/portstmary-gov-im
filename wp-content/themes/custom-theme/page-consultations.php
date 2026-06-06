<?php
/**
 * Consultations page template.
 *
 * Template Name: Consultations Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-consultations">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('consultations-hero-bg.jpg'),
            'image_seed' => 'psm-consultations-hero-bg',
        )
    );

    get_template_part('template-parts/sections/consultation-engagement');
    get_template_part('template-parts/sections/consultation-current');
    get_template_part('template-parts/sections/consultation-feedback');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'badge'       => __('Our Latest News', 'cmd-theme'),
            'badge_style' => 'red',
        )
    );
    ?>
</main>

<?php
get_footer();
