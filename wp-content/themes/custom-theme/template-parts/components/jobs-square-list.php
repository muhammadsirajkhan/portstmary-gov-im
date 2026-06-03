<?php
/**
 * Benefits list with red square bullets.
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
<ul class="psm-jobs-square-list">
    <?php foreach ((array) $args['items'] as $item) : ?>
        <li class="psm-jobs-square-list__item">
            <span class="psm-jobs-square-list__marker" aria-hidden="true"></span>
            <span class="psm-jobs-square-list__label"><?php echo esc_html($item); ?></span>
        </li>
    <?php endforeach; ?>
</ul>
