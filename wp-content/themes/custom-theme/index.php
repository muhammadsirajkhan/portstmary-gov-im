<?php
/**
 * Blog posts index.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main container psm-container py-5">
    <?php if (have_posts()) : ?>
        <header class="mb-4">
            <h1><?php esc_html_e('News', 'cmd-theme'); ?></h1>
        </header>
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article <?php post_class('mb-5 pb-4 border-bottom'); ?> id="post-<?php the_ID(); ?>">
                <h2 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="text-muted small mb-2"><?php echo esc_html(get_the_date()); ?></p>
                <div class="entry-summary"><?php the_excerpt(); ?></div>
                <a class="btn btn-primary mt-2" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'cmd-theme'); ?></a>
            </article>
            <?php
        endwhile;
        the_posts_navigation();
    else :
        ?>
        <p><?php esc_html_e('No posts yet.', 'cmd-theme'); ?></p>
    <?php endif; ?>
</main>

<?php
get_footer();
