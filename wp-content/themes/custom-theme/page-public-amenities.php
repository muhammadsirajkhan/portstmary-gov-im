<?php
/**
 * Public Amenities page template.
 *
 * Template Name: Public Amenities Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-public-amenities">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
            'title'      => __('Public Amenities', 'cmd-theme'),
            'ribbon'     => __('Facilities for Modern Day Living', 'cmd-theme'),
            'intro'      => __(
                'Discover parks, allotments, parking, and public facilities maintained for the Port St Mary community.',
                'cmd-theme'
            ),
            'image'      => psm_theme_image('public-amenities-banner.jpg'),
            'image_seed' => 'psm-public-amenities-banner',
            'heading_id' => 'psm-public-amenities-page-title',
            // 'breadcrumb' => array(
            //     array(
            //         'label' => __('Home', 'cmd-theme'),
            //         'url'   => home_url('/'),
            //     ),
            //     array(
            //         'label' => __('Public Amenities', 'cmd-theme'),
            //         'url'   => '',
            //     ),
            // ),
        )
    );

    get_template_part('template-parts/sections/amenities-community-spaces');
    get_template_part('template-parts/sections/amenities-facilities');
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
