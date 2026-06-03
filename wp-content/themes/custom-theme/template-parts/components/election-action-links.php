<?php
/**
 * Red underlined action links with icons.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type array[] $links { label, url, icon } icon: arrow|phone|email.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'links' => array(),
    )
);

if (empty($args['links'])) {
    return;
}
?>
<ul class="psm-election-action-links">
    <?php foreach ((array) $args['links'] as $link) : ?>
        <?php
        $link = wp_parse_args(
            (array) $link,
            array(
                'label' => '',
                'url'   => '#',
                'icon'  => 'arrow',
            )
        );
        if (!$link['label']) {
            continue;
        }
        $icons = array('arrow', 'phone', 'email');
        $icon  = in_array($link['icon'], $icons, true) ? $link['icon'] : 'arrow';
        ?>
        <li class="psm-election-action-links__item">
            <a class="psm-election-action-links__link" href="<?php echo esc_url($link['url']); ?>">
                <span class="psm-election-action-links__icon psm-election-action-links__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
                <span><?php echo esc_html($link['label']); ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
