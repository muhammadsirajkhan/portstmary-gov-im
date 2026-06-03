<?php
/**
 * Boat Park page template.
 *
 * Template Name: Boat Park Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-boat-park">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
            'title'      => __('Our Boat Park', 'cmd-theme'),
            'ribbon'     => __('Your Community Boat Park', 'cmd-theme'),
            'intro'      => __(
                'Moorings, slipway access, and harbour facilities managed for the Port St Mary boating community.',
                'cmd-theme'
            ),
            'image'      => psm_theme_image('boat-park-banner.jpg'),
            'image_seed' => 'psm-boat-park-banner',
            'heading_id' => 'psm-boat-park-page-title',
            'breadcrumb' => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('Boat Park', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
        )
    );

    get_template_part('template-parts/sections/boat-park-community');
    get_template_part('template-parts/sections/boat-park-facilities');
    get_template_part('template-parts/sections/boat-park-mooring');
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
