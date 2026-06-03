<?php
/**
 * Service grid card — compact by default, expanded on hover.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $title   Card title.
 *     @type string $url     Link URL.
 *     @type string $excerpt Optional description (shown on hover).
 *     @type string $image   Image URL.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'   => '',
        'url'     => '',
        'excerpt' => '',
        'image'   => '',
    )
);

$title   = trim((string) $args['title']);
$url     = trim((string) $args['url']);
$excerpt = trim((string) $args['excerpt']);
$image   = trim((string) $args['image']);

if ('' === $image && '' === $title && '' === $excerpt && '' === $url) {
    return;
}

$has_url     = '' !== $url;
$has_image   = '' !== $image;
$has_title   = '' !== $title;
$has_excerpt = '' !== $excerpt;
$has_overlay = $has_title || $has_excerpt || $has_url;
$tag         = $has_url ? 'a' : 'div';
$card_attr   = $has_url ? ' href="' . esc_url($url) . '"' : '';
$arrow_src   = get_template_directory_uri() . '/assets/images/arrow-red.png';
?>
<<?php echo $tag; ?> class="psm-service-card"<?php echo $card_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
    <?php if ($has_image) : ?>
        <img
            class="psm-service-card__image"
            src="<?php echo esc_url($image); ?>"
            alt="<?php echo esc_attr($title); ?>"
            width="800"
            height="520"
            loading="lazy"
            decoding="async"
        >
    <?php endif; ?>

    <?php if ($has_overlay) : ?>
        <div class="psm-service-card__overlay">
            <div class="psm-service-card__body">
                <?php if ($has_title) : ?>
                    <h3 class="psm-service-card__title"><?php echo esc_html($title); ?></h3>
                <?php endif; ?>
                <?php if ($has_excerpt) : ?>
                    <p class="psm-service-card__excerpt"><?php echo esc_html($excerpt); ?></p>
                <?php endif; ?>
                <?php if ($has_url) : ?>
                    <span class="psm-service-card__readmore">
                        <span class="psm-service-card__readmore-text"><?php esc_html_e('Read More', 'cmd-theme'); ?></span>
                        <span class="psm-service-card__readmore-icon" aria-hidden="true">
                            <img src="<?php echo esc_url($arrow_src); ?>" alt="">
                        </span>
                    </span>
                <?php endif; ?>
            </div>
            <span class="psm-service-card__corner-arrow" aria-hidden="true">
                    <img src="<?php echo esc_url($arrow_src); ?>" alt="">
                </span>
            <?php if ($has_url) : ?>
                <span class="psm-service-card__corner-arrow" aria-hidden="true">
                    <img src="<?php echo esc_url($arrow_src); ?>" alt="">
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</<?php echo $tag; ?>>
