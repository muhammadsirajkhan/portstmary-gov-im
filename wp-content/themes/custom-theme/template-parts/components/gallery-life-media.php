<?php
/**
 * Capturing Community Life — vertical + overlapping horizontal images.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image_main Main image URL.
 *     @type string $image_sub  Overlapping sub image URL.
 *     @type string $seed_main  Placeholder seed for main.
 *     @type string $seed_sub   Placeholder seed for sub.
 *     @type string $alt_main   Main image alt.
 *     @type string $alt_sub    Sub image alt.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image_main' => '',
        'image_sub'  => '',
        'seed_main'  => 'psm-gallery-life-main',
        'seed_sub'   => 'psm-gallery-life-sub',
        'alt_main'   => __('Community life in Port St Mary', 'cmd-theme'),
        'alt_sub'    => __('Local event in Port St Mary', 'cmd-theme'),
    )
);

$img_main = $args['image_main'] ?: psm_placeholder_image(520, 640, $args['seed_main']);
$img_sub  = $args['image_sub'] ?: psm_placeholder_image(480, 300, $args['seed_sub']);
?>
<div class="psm-gallery-life-media">
    <span class="psm-gallery-life-media__dots" aria-hidden="true"></span>
    <img
        class="psm-gallery-life-media__main"
        src="<?php echo esc_url($img_main); ?>"
        alt="<?php echo esc_attr($args['alt_main']); ?>"
        width="520"
        height="640"
        loading="lazy"
        decoding="async"
    >
    <img
        class="psm-gallery-life-media__sub"
        src="<?php echo esc_url($img_sub); ?>"
        alt="<?php echo esc_attr($args['alt_sub']); ?>"
        width="480"
        height="300"
        loading="lazy"
        decoding="async"
    >
    <div class="psm-gallery-life-media__badge">
        <?php get_template_part('template-parts/components/welcome-badge'); ?>
    </div>
</div>
