<?php
/**
 * Facility feature card — icon, title, description.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $icon       CSS icon fallback when icon_image is empty.
 *     @type string $icon_image Optional uploaded icon URL.
 *     @type string $title      Card title.
 *     @type string $text       Description.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'icon'       => 'mooring',
        'icon_image' => '',
        'title'      => '',
        'text'       => '',
    )
);

$icons = array(
    'mooring',
    'slipway',
    'parking',
    'services',
    'community',
    'voice',
    'transparency',
    'safe-access',
    'coastal',
    'maintenance',
    'community-representation',
    'local-services',
    'transparent-decisions',
    'community-led',
);
$icon       = in_array($args['icon'], $icons, true) ? $args['icon'] : 'mooring';
$icon_image = trim((string) $args['icon_image']);

if (!$args['title']) {
    return;
}
?>
<article class="psm-facility-icon-card">
    <?php if ('' !== $icon_image) : ?>
        <img
            class="psm-facility-icon-card__icon-img"
            src="<?php echo esc_url($icon_image); ?>"
            alt=""
            width="48"
            height="48"
            loading="lazy"
            decoding="async"
        >
    <?php else : ?>
        <span class="psm-facility-icon-card__icon psm-facility-icon-card__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
    <?php endif; ?>
    <h3 class="psm-facility-icon-card__title"><?php echo esc_html($args['title']); ?></h3>
    <?php if ($args['text']) : ?>
        <p class="psm-facility-icon-card__text"><?php echo esc_html($args['text']); ?></p>
    <?php endif; ?>
</article>
