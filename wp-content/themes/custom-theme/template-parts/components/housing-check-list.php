<?php
/**
 * Housing zigzag checklist with red checkmark bullets.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string[] $items      List labels.
 *     @type string   $list_class Optional extra class on ul.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'items'      => array(),
        'list_class' => '',
    )
);

if (empty($args['items'])) {
    return;
}

$list_class = 'psm-housing-checklist';
if ($args['list_class']) {
    $list_class .= ' ' . esc_attr($args['list_class']);
}
?>
<ul class="<?php echo esc_attr($list_class); ?>">
    <?php foreach ((array) $args['items'] as $item) : ?>
        <li class="psm-housing-checklist__item">
            <span class="psm-housing-checklist__icon" aria-hidden="true"></span>
            <span class="psm-housing-checklist__label"><?php echo esc_html($item); ?></span>
        </li>
    <?php endforeach; ?>
</ul>
