<?php
/**
 * Mooring application step card.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $number Display number (e.g. 01).
 *     @type string $icon   submit|review|allocation.
 *     @type string $title  Row title.
 *     @type string $text   Row description.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'number' => '01',
        'icon'   => 'submit',
        'title'  => '',
        'text'   => '',
    )
);

$icons = array('submit', 'review', 'allocation');
$icon  = in_array($args['icon'], $icons, true) ? $args['icon'] : 'submit';

if (!$args['title']) {
    return;
}
?>
<article class="psm-mooring-step">
    <span class="psm-mooring-step__icon psm-mooring-step__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
    <div class="psm-mooring-step__body">
        <h3 class="psm-mooring-step__title"><?php echo esc_html($args['title']); ?></h3>
        <?php if ($args['text']) : ?>
            <p class="psm-mooring-step__text"><?php echo esc_html($args['text']); ?></p>
        <?php endif; ?>
    </div>
    <span class="psm-mooring-step__number" aria-hidden="true"><?php echo esc_html($args['number']); ?></span>
</article>
