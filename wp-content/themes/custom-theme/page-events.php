<?php
/**
 * Events page template.
 *
 * Template Name: Events Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-events">
    <?php
    get_template_part('template-parts/sections/inner-banner');

    get_template_part('template-parts/sections/events-archive');
    ?>
</main>

<?php
get_footer();
