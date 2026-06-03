<?php
/**
 * Home landing template.
 *
 * Template Name: Home Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main">
    <?php
    get_template_part('template-parts/sections/hero');
    get_template_part('template-parts/sections/quick-links');
    get_template_part('template-parts/sections/about');
    get_template_part('template-parts/sections/services');
    get_template_part('template-parts/sections/events');
    get_template_part('template-parts/sections/harbor-banner');
    get_template_part('template-parts/sections/news');
    ?>
</main>

<?php
get_footer();
