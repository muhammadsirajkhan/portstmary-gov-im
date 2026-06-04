<?php
/**
 * Single news article layout.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$post_id = (int) get_the_ID();
if ($post_id <= 0) {
    return;
}

$data = psm_get_news_single_data($post_id);
if (empty($data['title'])) {
    return;
}

$category = $data['category'];
$time     = $data['time'];
$title    = $data['title'];
$image    = $data['image'];
$alt      = $data['image_alt'];
$has_meta = '' !== $category || '' !== $time;
$has_image = '' !== $image;
?>
<article <?php post_class('psm-news-single'); ?> id="post-<?php echo esc_attr((string) $post_id); ?>">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/breadcrumbs',
            null,
            array('items' => $data['breadcrumb'])
        );
        ?>

        <?php if ($has_image) : ?>
            <div class="psm-news-single__media">
                <img
                    src="<?php echo esc_url($image); ?>"
                    alt="<?php echo esc_attr($alt); ?>"
                    width="1200"
                    height="675"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>
        <?php endif; ?>

        <header class="psm-news-single__header">
            <?php if ($has_meta) : ?>
                <div class="psm-news-card__meta psm-news-single__meta">
                    <?php if ('' !== $category) : ?>
                        <span class="psm-news-card__cat"><?php echo esc_html(strtoupper($category)); ?></span>
                    <?php endif; ?>
                    <?php if ('' !== $time) : ?>
                        <span class="psm-news-card__time">
                            <span class="psm-news-card__clock" aria-hidden="true"></span>
                            <?php echo esc_html(strtoupper($time)); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <h1 class="psm-news-single__title"><?php echo esc_html($title); ?></h1>
        </header>

        <?php if (get_the_content()) : ?>
            <div class="psm-news-single__content entry-content">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    </div>
</article>
