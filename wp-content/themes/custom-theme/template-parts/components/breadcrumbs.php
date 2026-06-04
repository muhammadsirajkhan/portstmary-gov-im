<?php
/**
 * Standalone breadcrumb navigation.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type array $items Breadcrumb items {label, url}.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'items' => array(),
    )
);

$items = array_values(array_filter($args['items'], static function ($item) {
    return is_array($item) && !empty($item['label']);
}));

if (empty($items)) {
    return;
}

$last = count($items) - 1;
?>
<nav class="psm-breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'cmd-theme'); ?>">
    <ol class="psm-breadcrumb__list">
        <?php foreach ($items as $index => $crumb) : ?>
            <?php
            $label = isset($crumb['label']) ? $crumb['label'] : '';
            $url   = isset($crumb['url']) ? $crumb['url'] : '';
            ?>
            <li class="psm-breadcrumb__item">
                <?php if ($url && $index !== $last) : ?>
                    <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a>
                <?php else : ?>
                    <span<?php echo $index === $last ? ' aria-current="page"' : ''; ?>><?php echo esc_html($label); ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
