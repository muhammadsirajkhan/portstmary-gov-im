<?php
/**
 * Venue zigzag row image — vertical label, rounded image, crest badge.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image       Image URL.
 *     @type string $image_seed  Placeholder seed.
 *     @type string $alt         Image alt text.
 *     @type string $layout      image-left|image-right — row image position.
 *     @type string $label       Vertical edge label text.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image'      => '',
        'image_seed' => 'psm-venue',
        'alt'        => '',
        'layout'     => 'image-left',
        'label'      => __('Port St Mary Commissioners', 'cmd-theme'),
    )
);

$layout = 'image-right' === $args['layout'] ? 'image-right' : 'image-left';
$image  = $args['image'] ?: psm_placeholder_image(800, 560, $args['image_seed']);
?>
<div class="psm-venue-zigzag__media psm-venue-zigzag__media--<?php echo esc_attr($layout); ?>">
    <!-- <span class="psm-venue-zigzag__vertical-label"><?php echo esc_html(strtoupper($args['label'])); ?></span> -->
    <div class="psm-venue-zigzag__image-wrap">
        <img
            class="psm-venue-zigzag__image img-fluid"
            src="<?php echo esc_url($image); ?>"
            alt="<?php echo esc_attr($args['alt']); ?>"
           
            loading="lazy"
            decoding="async"
        >
        <?php // get_template_part('template-parts/components/welcome-badge'); ?>
    </div>
</div>
