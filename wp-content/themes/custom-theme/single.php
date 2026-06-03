<?php
/**
 * Single post template.
 *
 * @package The_Black_Door_Oven
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main oven-main oven-inner-page container py-5">
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <div class="mb-4">
                <?php the_post_thumbnail('full', array('class' => 'img-fluid rounded')); ?>
            </div>
        <?php endif; ?>
        <header class="mb-4">
            <h1 class="oven-title"><?php the_title(); ?></h1>
        </header>
        <div class="entry-content oven-prose">
            <?php the_content(); ?>
        </div>
    </article>

<?php
get_footer();
