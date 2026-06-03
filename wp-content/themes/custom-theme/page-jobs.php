<?php
/**
 * Jobs / Careers page template.
 *
 * Template Name: Jobs Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-jobs">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
            'title'      => __('Careers With Us', 'cmd-theme'),
            'ribbon'     => __('Opportunities to Grow, Work That Matters', 'cmd-theme'),
            'intro'      => __(
                'Explore careers with Port St Mary Commissioners and find opportunities to contribute to our community.',
                'cmd-theme'
            ),
            'image'      => psm_theme_image('jobs-banner.jpg'),
            'image_seed' => 'psm-jobs-banner',
            'heading_id' => 'psm-jobs-page-title',
            'breadcrumb' => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('Careers', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
        )
    );

    get_template_part('template-parts/sections/jobs-work-with-us');
    get_template_part('template-parts/sections/jobs-how-to-apply');
    get_template_part('template-parts/sections/jobs-opportunities');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'badge'       => __('Stay Informed', 'cmd-theme'),
        )
    );
    ?>
</main>

<?php
get_footer();
