<?php
/**
 * Accommodation place card — image, title, contact details, Read More CTA.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $title         Venue name.
 *     @type string $location      Address label.
 *     @type string $phone         Display phone number.
 *     @type string $phone_href    tel: link.
 *     @type string $contact       Email or website display text.
 *     @type string $contact_href  Link href for email/website row.
 *     @type string $read_more_url Read More button URL.
 *     @type string $image         Image URL.
 *     @type string $image_seed    Placeholder seed.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'         => '',
        'location'      => '',
        'phone'         => '',
        'phone_href'    => '',
        'contact'       => '',
        'contact_href'  => '',
        'read_more_url' => '',
        'image'         => '',
        'image_seed'    => 'psm-accommodation-place',
    )
);

if (!$args['title']) {
    return;
}

$image        = $args['image'] ?: psm_placeholder_image(480, 320, $args['image_seed']);
$has_location  = '' !== trim((string) $args['location']);
$has_phone     = '' !== trim((string) $args['phone']);
$has_contact   = '' !== trim((string) $args['contact']);
$read_more_url = trim((string) $args['read_more_url']);
$has_read_more = '' !== $read_more_url;
?>
<article class="psm-accommodation-card">
    <img
        class="psm-accommodation-card__image"
        src="<?php echo esc_url($image); ?>"
        alt="<?php echo esc_attr($args['title']); ?>"
        width="480"
        height="320"
        loading="lazy"
        decoding="async"
    >
    <div class="psm-accommodation-card__body">
        <h3 class="psm-accommodation-card__title"><?php echo esc_html($args['title']); ?></h3>
        <div class="psm-accommodation-card__meta">
            <?php if ($has_location) : ?>
                <p class="psm-accommodation-card__meta-row">
                    <span class="psm-accommodation-card__icon-wrap" aria-hidden="true">
                        <span class="psm-accommodation-card__icon psm-accommodation-card__icon--pin"></span>
                    </span>
                    <span><?php echo esc_html($args['location']); ?></span>
                </p>
            <?php endif; ?>
            <?php if ($has_phone) : ?>
                <p class="psm-accommodation-card__meta-row">
                    <span class="psm-accommodation-card__icon-wrap" aria-hidden="true">
                        <span class="psm-accommodation-card__icon psm-accommodation-card__icon--phone"></span>
                    </span>
                    <?php if ($args['phone_href']) : ?>
                        <a href="<?php echo esc_url($args['phone_href']); ?>"><?php echo esc_html($args['phone']); ?></a>
                    <?php else : ?>
                        <span><?php echo esc_html($args['phone']); ?></span>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
            <?php if ($has_contact) : ?>
                <p class="psm-accommodation-card__meta-row">
                    <span class="psm-accommodation-card__icon-wrap" aria-hidden="true">
                        <span class="psm-accommodation-card__icon psm-accommodation-card__icon--mail"></span>
                    </span>
                    <?php if ($args['contact_href']) : ?>
                        <a href="<?php echo esc_url($args['contact_href']); ?>"<?php echo false === strpos($args['contact'], '@') ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html($args['contact']); ?></a>
                    <?php else : ?>
                        <span><?php echo esc_html($args['contact']); ?></span>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </div>
        <?php if ($has_read_more) : ?>
        <div class="psm-accommodation-card__cta">
            <?php
            get_template_part(
                'template-parts/components/button-pill',
                null,
                array(
                    'text'    => __('Read More', 'cmd-theme'),
                    'url'     => $read_more_url,
                    'variant' => 'primary',
                )
            );
            ?>
        </div>
        <?php endif; ?>
    </div>
</article>
