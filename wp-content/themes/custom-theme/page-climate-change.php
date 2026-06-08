<?php
/**
 * Climate Change page template.
 *
 * Template Name: Climate Change Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-climate-change">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
            'title'      => __('Climate Change', 'cmd-theme'),
            'ribbon'     => __('Environment & Sustainability', 'cmd-theme'),
            'intro'      => __(
                'We are committed to addressing climate change through responsible local action, protecting our coastal environment, and supporting sustainable practices within the community.',
                'cmd-theme'
            ),
            'image_seed' => 'psm-climate-change-banner',
            'heading_id' => 'psm-climate-change-page-title',
        )
    );

    get_template_part('template-parts/sections/climate-change-commitment');
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
get_footer(
    null,
    array(
        'variant' => 'white',
    )
);
