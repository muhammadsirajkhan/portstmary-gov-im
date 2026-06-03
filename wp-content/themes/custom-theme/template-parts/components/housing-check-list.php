<?php
/**
 * Housing zigzag checklist with red checkmark bullets.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string[] $items List labels.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'items' => array(),
    )
);

if (empty($args['items'])) {
    return;
}
?>
<ul class="psm-housing-checklist">
    <?php foreach ((array) $args['items'] as $item) : ?>
        <li class="psm-housing-checklist__item">
            <span class="psm-housing-checklist__icon" aria-hidden="true"></span>
            <span class="psm-housing-checklist__label"><?php echo esc_html($item); ?></span>
        </li>
    <?php endforeach; ?>
</ul>
