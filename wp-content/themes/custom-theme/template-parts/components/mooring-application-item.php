<?php
/**
 * Mooring application step card.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $number     Display number (e.g. 01).
 *     @type string $icon       CSS icon fallback when icon_image is empty.
 *     @type string $icon_image Optional uploaded icon URL.
 *     @type string $title      Row title.
 *     @type string $text       Row description.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'number'     => '01',
        'icon'       => 'submit',
        'icon_image' => '',
        'title'      => '',
        'text'       => '',
    )
);

$icons      = array('submit', 'review', 'allocation');
$icon       = in_array($args['icon'], $icons, true) ? $args['icon'] : 'submit';
$icon_image = trim((string) $args['icon_image']);

if (!$args['title']) {
    return;
}
?>
<article class="psm-mooring-step">
    <?php if ('' !== $icon_image) : ?>
        <img
            class="psm-mooring-step__icon-img"
            src="<?php echo esc_url($icon_image); ?>"
            alt=""
            width="48"
            height="48"
            loading="lazy"
            decoding="async"
        >
    <?php else : ?>
        <span class="psm-mooring-step__icon psm-mooring-step__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
    <?php endif; ?>
    <div class="psm-mooring-step__body">
        <h3 class="psm-mooring-step__title"><?php echo esc_html($args['title']); ?></h3>
        <?php if ($args['text']) : ?>
            <p class="psm-mooring-step__text"><?php echo esc_html($args['text']); ?></p>
        <?php endif; ?>
    </div>
    <span class="psm-mooring-step__number" aria-hidden="true"><?php echo esc_html($args['number']); ?></span>
</article>
