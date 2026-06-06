<?php
/**
 * Featured gallery column image figure.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image Image URL.
 *     @type string $alt   Alt text.
 *     @type string $size  portrait|landscape|landscape-lg
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image' => '',
        'alt'   => '',
        'size'  => 'landscape',
    )
);

if ('' === trim((string) $args['image'])) {
    return;
}

$sizes = array('portrait', 'landscape', 'landscape-lg');
$size  = in_array($args['size'], $sizes, true) ? $args['size'] : 'landscape';
?>
<figure class="psm-gallery-columns__item psm-gallery-columns__item--<?php echo esc_attr($size); ?>">
    <img
        class="psm-gallery-columns__img"
        src="<?php echo esc_url($args['image']); ?>"
        alt="<?php echo esc_attr($args['alt']); ?>"
        width="600"
        height="400"
        loading="lazy"
        decoding="async"
    >
</figure>
