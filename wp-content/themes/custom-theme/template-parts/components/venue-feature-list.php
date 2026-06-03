<?php
/**
 * Venue hire timeline list — hollow circles with vertical connector line.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string[] $items Feature labels.
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
<ul class="psm-venue-timeline">
    <?php foreach ((array) $args['items'] as $index => $item) : ?>
        <li class="psm-venue-timeline__item<?php echo 0 === $index ? ' psm-venue-timeline__item--first' : ''; ?>">
            <span class="psm-venue-timeline__marker" aria-hidden="true"></span>
            <span class="psm-venue-timeline__label"><?php echo esc_html($item); ?></span>
        </li>
    <?php endforeach; ?>
</ul>
