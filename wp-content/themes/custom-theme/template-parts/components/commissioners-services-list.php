<?php
/**
 * Commissioners services grid with red checkmark bullets.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string[] $items Service labels.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'items' => array(),
    )
);

$items = !empty($args['items']) ? (array) $args['items'] : psm_get_commissioners_services();

if (empty($items)) {
    return;
}
?>
<ul class="psm-commissioners-services">
    <?php foreach ($items as $item) : ?>
        <li class="psm-commissioners-services__item">
            <span class="psm-commissioners-services__icon" aria-hidden="true"></span>
            <span class="psm-commissioners-services__label"><?php echo esc_html($item); ?></span>
        </li>
    <?php endforeach; ?>
</ul>
