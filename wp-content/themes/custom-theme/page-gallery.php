<?php
/**
 * Community Gallery page template.
 *
 * Template Name: Gallery Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-gallery">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
            'title'      => __('Community Gallery', 'cmd-theme'),
            'ribbon'     => __('Celebrating Coastal Community Life', 'cmd-theme'),
            'intro'      => __(
                'Explore photographs and moments from Port St Mary — our harbor, events, and community life.',
                'cmd-theme'
            ),
            'image'      => psm_theme_image('gallery-banner.jpg'),
            'image_seed' => 'psm-gallery-banner',
            'heading_id' => 'psm-gallery-page-title',
            'breadcrumb' => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('Gallery', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
        )
    );

    get_template_part('template-parts/sections/gallery-community-life');
    get_template_part('template-parts/sections/gallery-featured');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'badge'       => __('Stay in the Loop', 'cmd-theme'),
            'badge_style' => 'line',
        )
    );
    ?>
</main>

<?php
get_footer();
