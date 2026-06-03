<?php
/**
 * Where to Eat page template.
 *
 * Template Name: Where to Eat Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-where-to-eat">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
            'title'      => __('Where to Eat', 'cmd-theme'),
            'ribbon'     => __('Discover Local Places to Eat in Port St Mary', 'cmd-theme'),
            'intro'      => __(
                'Explore local cafes, restaurants, and takeaways in Port St Mary. Whether you\'re after a quick coffee, a casual meal, or a convenient takeaway.',
                'cmd-theme'
            ),
            'image'      => psm_theme_image('where-to-eat-banner.jpg'),
            'image_seed' => 'psm-where-to-eat-banner',
            'heading_id' => 'psm-where-to-eat-page-title',
            'breadcrumb' => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('Where to Eat', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
        )
    );

    get_template_part('template-parts/sections/where-to-eat-places');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'badge'       => __('Community News', 'cmd-theme'),
            'badge_style' => 'pill',
        )
    );
    ?>
</main>

<?php
get_footer();
