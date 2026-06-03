<?php
/**
 * News & Updates page template.
 *
 * Template Name: News Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-news">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('news-banner.jpg'),
            'image_seed' => 'psm-news-banner',
            'breadcrumb' => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('News & Updates', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
        )
    );

    get_template_part('template-parts/sections/news-archive');
    ?>
</main>

<?php
get_footer();
