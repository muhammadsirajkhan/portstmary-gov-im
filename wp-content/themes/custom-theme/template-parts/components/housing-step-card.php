<?php
/**
 * Housing application process step card.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $step       Step label e.g. 01.
 *     @type string $icon       form|documents|review|waiting (CSS fallback).
 *     @type string $icon_image PNG icon URL from ACF or theme.
 *     @type string $title      Card title.
 *     @type string $text       Description.
 *     @type string $url        Link URL.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'step'       => '',
        'icon'       => 'form',
        'icon_image' => '',
        'title'      => '',
        'text'       => '',
        'url'        => '#',
    )
);

if (!$args['title']) {
    return;
}

$icons = array('form', 'documents', 'review', 'waiting', 'assessment', 'offer');
$icon  = in_array($args['icon'], $icons, true) ? $args['icon'] : 'form';

if ('assessment' === $icon) {
    $icon = 'review';
}
if ('offer' === $icon) {
    $icon = 'waiting';
}

$icon_image = trim((string) $args['icon_image']);
$has_png    = '' !== $icon_image;
?>
<a class="psm-housing-step-card" href="<?php echo esc_url($args['url']); ?>">
    <?php if ($args['step']) : ?>
        <div class="psm-housing-step-card__step">
            <span class="psm-housing-step-card__step-num"><?php echo esc_html($args['step']); ?></span>
            <span class="psm-housing-step-card__step-line" aria-hidden="true"></span>
        </div>
    <?php endif; ?>

    <div class="psm-housing-step-card__icon-wrap">
        <?php if ($has_png) : ?>
            <img
                class="psm-housing-step-card__icon-img"
                src="<?php echo esc_url($icon_image); ?>"
                alt=""
                
                loading="lazy"
                decoding="async"
            >
        <?php else : ?>
            <span class="psm-housing-step-card__icon psm-housing-step-card__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
        <?php endif; ?>
    </div>

    <div class="psm-housing-step-card__title-wrap">
        <span class="psm-housing-step-card__title-accent" aria-hidden="true"></span>
        <h3 class="psm-housing-step-card__title"><?php echo esc_html($args['title']); ?></h3>
    </div>

    <?php if ($args['text']) : ?>
        <p class="psm-housing-step-card__text"><?php echo esc_html($args['text']); ?></p>
    <?php endif; ?>

    <span class="psm-housing-step-card__link">
        <span class="psm-housing-step-card__link-text"><?php esc_html_e('Learn More', 'cmd-theme'); ?></span>
        <span class="psm-housing-step-card__link-arrow" aria-hidden="true"></span>
    </span>
</a>
