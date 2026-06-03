<?php
/**
 * Remembrance image with external red accent bar (Figma).
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image      Image URL.
 *     @type string $image_seed Placeholder seed.
 *     @type string $alt        Alt text.
 *     @type string $bar        left|right — accent bar position.
 *     @type int    $width      Image width attribute.
 *     @type int    $height     Image height attribute.
 *     @type string $class      Optional extra class on frame.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image'      => '',
        'image_seed' => 'psm-remembrance',
        'alt'        => '',
        'bar'        => 'left',
        'width'      => 600,
        'height'     => 720,
        'class'      => '',
    )
);

$bar = 'right' === $args['bar'] ? 'right' : 'left';
$image = $args['image'] ?: psm_placeholder_image((int) $args['width'], (int) $args['height'], $args['image_seed']);

$frame_class = 'psm-remembrance-media psm-remembrance-media--bar-' . $bar;
if ($args['class']) {
    $frame_class .= ' ' . esc_attr($args['class']);
}
?>
<figure class="<?php echo esc_attr($frame_class); ?>">
    <span class="psm-remembrance-media__bar" aria-hidden="true"></span>
    <img
        class="psm-remembrance-media__img"
        src="<?php echo esc_url($image); ?>"
        alt="<?php echo esc_attr($args['alt']); ?>"
        width="<?php echo (int) $args['width']; ?>"
        height="<?php echo (int) $args['height']; ?>"
        loading="lazy"
        decoding="async"
    >
</figure>
