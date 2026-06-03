<?php
/**
 * Remembrance honour grid card — image, title, body copy.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string   $title      Card heading.
 *     @type string[] $paragraphs Body paragraphs.
 *     @type string   $image      Image URL (optional).
 *     @type string   $image_seed Placeholder seed.
 *     @type string   $image_alt  Image alt text.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'       => '',
        'paragraphs'  => array(),
        'image'       => '',
        'image_seed'  => 'psm-remembrance-card',
        'image_alt'   => '',
    )
);

if (!$args['title']) {
    return;
}

$image = $args['image'] ?: psm_placeholder_image(640, 480, $args['image_seed']);
$alt   = $args['image_alt'] ?: $args['title'];
?>
<article class="psm-remembrance-card">
    <img
        class="psm-remembrance-card__image"
        src="<?php echo esc_url($image); ?>"
        alt="<?php echo esc_attr($alt); ?>"
        width="640"
        height="480"
        loading="lazy"
        decoding="async"
    >
    <div class="psm-remembrance-card__body">
        <h3 class="psm-remembrance-card__title"><?php echo esc_html($args['title']); ?></h3>
        <?php if (!empty($args['paragraphs'])) : ?>
            <div class="psm-remembrance-card__text">
                <?php foreach ((array) $args['paragraphs'] as $paragraph) : ?>
                    <p><?php echo esc_html($paragraph); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</article>
