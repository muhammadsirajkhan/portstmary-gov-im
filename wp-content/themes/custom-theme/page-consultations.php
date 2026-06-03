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
            'variant'        => 'featured',
            'kicker'         => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
            'title'          => __('Consultations', 'cmd-theme'),
            'ribbon'         => __('Helping Shape Local Decisions', 'cmd-theme'),
            'intro'          => __(
                'Share your views on local projects and proposals. Your feedback helps Port St Mary Commissioners make informed community decisions.',
                'cmd-theme'
            ),
            'image'          => psm_theme_image('consultations-hero-bg.jpg'),
            'image_seed'     => 'psm-consultations-hero-bg',
            'featured_image' => psm_theme_image('consultations-hero-featured.jpg'),
            'featured_seed'  => 'psm-consultations-hero-featured',
            'heading_id'     => 'psm-consultations-page-title',
            'breadcrumb'     => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('Consultations', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
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
