<?php
/**
 * News carousel card.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $category   Category label.
 *     @type string $time       Time label.
 *     @type string $title      Card title.
 *     @type string $excerpt    Short description.
 *     @type string $url        Read more URL.
 *     @type string $image      Image URL.
 *     @type string $image_alt  Image alt text.
 *     @type string $image_badge Badge on image.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'category'    => '',
        'time'        => '',
        'title'       => '',
        'excerpt'     => '',
        'url'         => '',
        'image'       => '',
        'image_alt'   => '',
        'image_badge' => '',
        'time_uppercase' => true,
    )
);

$category    = trim((string) $args['category']);
$time        = trim((string) $args['time']);
$title       = trim((string) $args['title']);
$excerpt     = trim((string) $args['excerpt']);
$url         = trim((string) $args['url']);
$image       = trim((string) $args['image']);
$image_badge = trim((string) $args['image_badge']);
$alt         = trim((string) $args['image_alt']) ?: $title;
$time_label  = $args['time_uppercase'] ? strtoupper($time) : $time;

if ('' === $category && '' === $time && '' === $title && '' === $excerpt && '' === $url && '' === $image) {
    return;
}

$has_image       = '' !== $image;
$has_image_badge = '' !== $image_badge;
$has_meta        = '' !== $category || '' !== $time;
$has_body        = '' !== $title || '' !== $excerpt || '' !== $url;
?>
<article class="psm-news-card">
    <?php if ($has_image) : ?>
        <div class="psm-news-card__media">
            <img
                src="<?php echo esc_url($image); ?>"
                alt="<?php echo esc_attr($alt); ?>"
                width="640"
                height="426"
                loading="lazy"
                decoding="async"
            >
            <?php if ($has_image_badge) : ?>
                <span class="psm-news-card__image-badge">
                    <span class="psm-news-card__image-badge-dot" aria-hidden="true"></span>
                    <?php echo esc_html(strtoupper($image_badge)); ?>
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($has_body || $has_meta) : ?>
        <div class="psm-news-card__body">
            <?php if ($has_meta) : ?>
                <div class="psm-news-card__meta">
                    <?php if ('' !== $category) : ?>
                        <span class="psm-news-card__cat"><?php echo esc_html(strtoupper($category)); ?></span>
                    <?php endif; ?>
                    <?php if ('' !== $time) : ?>
                        <span class="psm-news-card__time">
                            <span class="psm-news-card__clock" aria-hidden="true"></span>
                            <?php echo esc_html($time_label); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ('' !== $title) : ?>
                <h3 class="psm-news-card__title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>

            <?php if ('' !== $excerpt) : ?>
                <p class="psm-news-card__excerpt"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>

            <?php if ('' !== $url) : ?>
                <a class="psm-news-card__readmore" href="<?php echo esc_url($url); ?>">
                    <span><?php esc_html_e('Read More', 'cmd-theme'); ?></span>
                    <span class="psm-news-card__readmore-arrow" aria-hidden="true"></span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</article>
