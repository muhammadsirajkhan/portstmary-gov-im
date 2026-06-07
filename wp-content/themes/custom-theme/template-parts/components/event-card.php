<?php
/**
 * Event list card — date bar, content, image.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $day       Day number.
 *     @type string $month     Month label.
 *     @type string $title     Event title.
 *     @type string $excerpt   Short description.
 *     @type string $url       Details link URL.
 *     @type string $image     Image URL.
 *     @type string $image_alt Image alt text.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'day'       => '',
        'month'     => '',
        'title'     => '',
        'excerpt'   => '',
        'url'       => '',
        'image'     => '',
        'image_alt' => '',
    )
);

$day     = trim((string) $args['day']);
$month   = trim((string) $args['month']);
$title   = trim((string) $args['title']);
$excerpt = trim((string) $args['excerpt']);
$url     = trim((string) $args['url']);
$image   = trim((string) $args['image']);
$alt     = trim((string) $args['image_alt']);

if ('' === $day && '' === $month && '' === $title && '' === $excerpt && '' === $url && '' === $image) {
    return;
}

$has_date    = '' !== $day || '' !== $month;
$has_title   = '' !== $title;
$has_excerpt = '' !== $excerpt;
$has_url     = '' !== $url;
$has_image   = '' !== $image;
$has_content = $has_title || $has_excerpt || $has_url;

$crest = psm_theme_image('header-logo.webp') ?: psm_theme_image('logo-placeholder.svg');
$alt   = $alt ?: $title;

$date_label = '';
if ($has_date) {
    $date_label = trim($day . ' ' . $month);
}
?>
<article class="psm-event-card">
    <?php if ($has_date) : ?>
        <div class="psm-event-card__date"<?php echo $date_label ? ' aria-label="' . esc_attr($date_label) . '"' : ''; ?>>
            <?php if ($crest) : ?>
                <img class="psm-event-card__crest" src="<?php echo esc_url($crest); ?>" alt="" width="44" height="44" decoding="async">
            <?php endif; ?>
            <?php if ('' !== $day) : ?>
                <span class="psm-event-card__day"><?php echo esc_html($day); ?></span>
            <?php endif; ?>
            <?php if ('' !== $month) : ?>
                <span class="psm-event-card__month"><?php echo esc_html(strtoupper($month)); ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($has_content) : ?>
        <div class="psm-event-card__content">
            <?php if ($has_title) : ?>
                <h3 class="psm-event-card__title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>
            <?php if ($has_excerpt) : ?>
                <p class="psm-event-card__excerpt"><?php echo esc_html($excerpt); ?></p>
            <?php endif; ?>
            <?php if ($has_url) : ?>
                <a class="psm-event-card__link" href="<?php echo esc_url($url); ?>">
                    <span class="psm-event-card__link-text"><?php esc_html_e('View All Event Details', 'cmd-theme'); ?></span>
                    <span class="psm-event-card__link-icon" aria-hidden="true"></span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($has_image) : ?>
        <div class="psm-event-card__media">
            <img
                src="<?php echo esc_url($image); ?>"
                alt="<?php echo esc_attr($alt); ?>"
                width="520"
                height="340"
                loading="lazy"
                decoding="async"
            >
        </div>
    <?php endif; ?>
</article>
