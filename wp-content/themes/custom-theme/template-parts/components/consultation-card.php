<?php
/**
 * Current consultation thumbnail card.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $title      Consultation title.
 *     @type string $url       Link URL.
 *     @type string $image     Image URL.
 *     @type string $image_seed Placeholder seed.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'      => '',
        'url'        => '#',
        'image'      => '',
        'image_seed' => 'psm-consultation',
    )
);

if (!$args['title']) {
    return;
}

$image = $args['image'] ?: psm_placeholder_image(400, 280, $args['image_seed']);
?>
<a class="psm-consultation-card" href="<?php echo esc_url($args['url']); ?>">
    <img
        class="psm-consultation-card__image"
        src="<?php echo esc_url($image); ?>"
        alt="<?php echo esc_attr($args['title']); ?>"
        width="400"
        height="280"
        loading="lazy"
        decoding="async"
    >
    <div class="psm-consultation-card__footer">
        <h3 class="psm-consultation-card__title"><?php echo esc_html($args['title']); ?></h3>
    </div>
</a>
