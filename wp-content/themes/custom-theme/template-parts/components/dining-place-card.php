<?php
/**
 * Dining place card — image, title, location, phone.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $title         Venue name.
 *     @type string $location      Address or area label.
 *     @type string $location_url  Optional map link.
 *     @type string $phone         Display phone number.
 *     @type string $phone_href    tel: link.
 *     @type string $image         Image URL.
 *     @type string $image_seed    Placeholder seed.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'        => '',
        'location'     => '',
        'location_url' => '',
        'phone'        => '',
        'phone_href'   => '',
        'image'        => '',
        'image_seed'   => 'psm-dining-place',
    )
);

if (!$args['title']) {
    return;
}

$image = $args['image'] ?: psm_placeholder_image(400, 300, $args['image_seed']);
?>
<article class="psm-dining-place-card">
    <img
        class="psm-dining-place-card__image"
        src="<?php echo esc_url($image); ?>"
        alt="<?php echo esc_attr($args['title']); ?>"
        width="400"
        height="300"
        loading="lazy"
        decoding="async"
    >
    <div class="psm-dining-place-card__body">
        <h3 class="psm-dining-place-card__title"><?php echo esc_html($args['title']); ?></h3>
        <div class="psm-dining-place-card__meta">
            <?php if ($args['location']) : ?>
                <p class="psm-dining-place-card__meta-row">
                    <span class="psm-dining-place-card__icon psm-dining-place-card__icon--pin" aria-hidden="true"></span>
                    <?php if ($args['location_url']) : ?>
                        <a href="<?php echo esc_url($args['location_url']); ?>"><?php echo esc_html($args['location']); ?></a>
                    <?php else : ?>
                        <span><?php echo esc_html($args['location']); ?></span>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
            <?php if ($args['phone']) : ?>
                <p class="psm-dining-place-card__meta-row">
                    <span class="psm-dining-place-card__icon psm-dining-place-card__icon--phone" aria-hidden="true"></span>
                    <?php if ($args['phone_href']) : ?>
                        <a href="<?php echo esc_url($args['phone_href']); ?>"><?php echo esc_html($args['phone']); ?></a>
                    <?php else : ?>
                        <span><?php echo esc_html($args['phone']); ?></span>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</article>
