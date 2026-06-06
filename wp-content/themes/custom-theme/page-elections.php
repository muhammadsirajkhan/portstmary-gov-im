<?php
/**
 * Elections page template.
 *
 * Template Name: Elections Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-elections">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('elections-banner.jpg'),
            'image_seed' => 'psm-elections-banner',
        )
    );

    get_template_part('template-parts/sections/election-results');
    get_template_part('template-parts/sections/elections-candidates');
    get_template_part('template-parts/sections/elections-voting');
    get_template_part('template-parts/sections/election-notice');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'badge'       => __('Stay Updated', 'cmd-theme'),
            'badge_style' => 'red',
        )
    );
    ?>
</main>

<?php
get_footer();
