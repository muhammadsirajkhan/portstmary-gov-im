<?php
/**
 * Mooring application numbered row.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $number Display number (e.g. 01).
 *     @type string $icon   form|documents|assessment|offer.
 *     @type string $title  Row title.
 *     @type string $text   Row description.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'number' => '01',
        'icon'   => 'form',
        'title'  => '',
        'text'   => '',
    )
);

$icons = array('form', 'documents', 'assessment', 'offer');
$icon  = in_array($args['icon'], $icons, true) ? $args['icon'] : 'form';

if (!$args['title']) {
    return;
}
?>
<div class="psm-mooring-step">
    <span class="psm-mooring-step__icon psm-housing-step-card__icon psm-housing-step-card__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
    <div class="psm-mooring-step__body">
        <h3 class="psm-mooring-step__title"><?php echo esc_html($args['title']); ?></h3>
        <?php if ($args['text']) : ?>
            <p class="psm-mooring-step__text"><?php echo esc_html($args['text']); ?></p>
        <?php endif; ?>
    </div>
    <span class="psm-mooring-step__number" aria-hidden="true"><?php echo esc_html($args['number']); ?></span>
</div>
