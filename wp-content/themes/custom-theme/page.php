<?php
/**
 * Default page template.
 *
 * @package The_Black_Door_Oven
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main container py-5">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article <?php post_class(); ?> id="page-<?php the_ID(); ?>">
            <header class="mb-4">
                <h1 class="oven-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content oven-prose">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
    ?>

<?php
get_footer();
