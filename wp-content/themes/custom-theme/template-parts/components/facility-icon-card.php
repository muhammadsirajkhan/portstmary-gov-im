<?php
/**
 * Facility feature card — icon, title, description.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $icon  mooring|slipway|parking|services|community|voice|transparency.
 *     @type string $title Card title.
 *     @type string $text  Description.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'icon'  => 'mooring',
        'title' => '',
        'text'  => '',
    )
);

$icons = array('mooring', 'slipway', 'parking', 'services', 'community', 'voice', 'transparency');
$icon  = in_array($args['icon'], $icons, true) ? $args['icon'] : 'mooring';

if (!$args['title']) {
    return;
}
?>
<article class="psm-facility-icon-card">
    <span class="psm-facility-icon-card__icon psm-facility-icon-card__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
    <h3 class="psm-facility-icon-card__title"><?php echo esc_html($args['title']); ?></h3>
    <?php if ($args['text']) : ?>
        <p class="psm-facility-icon-card__text"><?php echo esc_html($args['text']); ?></p>
    <?php endif; ?>
</article>
