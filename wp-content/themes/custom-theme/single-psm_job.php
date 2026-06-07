<?php
/**
 * Single job vacancy template.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-job-single">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/sections/job-single');
    endwhile;
    ?>
</main>

<?php
get_footer();
