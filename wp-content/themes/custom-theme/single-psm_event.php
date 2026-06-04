<?php
/**
 * Single event template.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-event-single">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/sections/event-single');
    endwhile;
    ?>
</main>

<?php
get_footer();
