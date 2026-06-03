<?php
/**
 * Reusable pill CTA button with arrow icon circle.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $text    Button label.
 *     @type string $url     Link URL.
 *     @type string $variant primary|secondary
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'text'    => '',
        'url'     => '#',
        'variant' => 'primary',
    )
);

$variant = 'secondary' === $args['variant'] ? 'secondary' : 'primary';
?>
<a href="<?php echo esc_url($args['url']); ?>" class="psm-btn-pill psm-btn-pill--<?php echo esc_attr($variant); ?>">
    <span class="psm-btn-pill__text"><?php echo esc_html($args['text']); ?></span>
    <span class="psm-btn-pill__icon" aria-hidden="true">
    <?php if ( 'secondary' === $variant ) : ?>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/btn-arrow-black.png'); ?>" alt="<?php esc_attr_e('Arrow', 'cmd-theme'); ?>">
    <?php else : ?>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/btn-arrow.png'); ?>" alt="<?php esc_attr_e('Arrow', 'cmd-theme'); ?>">
    <?php endif; ?>
    </span>
</a>
