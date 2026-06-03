<?php
/**
 * Local Info page template.
 *
 * Template Name: Local Info Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-local-info">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Explore the Heart of Our Community', 'cmd-theme'),
            'title'      => __('Local Info', 'cmd-theme'),
            'ribbon'     => __('History, Community & Coastal Living', 'cmd-theme'),
            'intro'      => __(
                'Learn about Port St Mary — our history, community, and coastal heritage on the Isle of Man.',
                'cmd-theme'
            ),
            'image'      => psm_theme_image('local-info-banner.jpg'),
            'image_seed' => 'psm-local-info-banner',
            'heading_id' => 'psm-local-info-page-title',
            'breadcrumb' => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('Local Info', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
        )
    );

    get_template_part('template-parts/sections/local-info-about');
    get_template_part('template-parts/sections/local-info-timeline');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'badge'       => __('Stay in the Know', 'cmd-theme'),
            'badge_style' => 'red',
        )
    );
    ?>
</main>

<?php
get_footer();
