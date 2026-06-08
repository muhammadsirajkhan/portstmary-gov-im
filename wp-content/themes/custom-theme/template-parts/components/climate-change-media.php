<?php
/**
 * Climate Change — layered image with frame, badge, and contact action bar.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image        Main image URL.
 *     @type string $image_alt    Image alt text.
 *     @type string $phone        Display phone number.
 *     @type string $phone_href   tel: link.
 *     @type array  $social_links Footer social links {url, label, icon}.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image'        => '',
        'image_alt'    => __('Port St Mary Commissioners', 'cmd-theme'),
        'phone'        => '',
        'phone_href'   => '',
        'social_links' => array(),
    )
);

$image        = trim((string) $args['image']);
$phone        = trim((string) $args['phone']);
$phone_href   = trim((string) $args['phone_href']);
$social_links = isset($args['social_links']) && is_array($args['social_links']) ? $args['social_links'] : array();

if ('' === $image) {
    return;
}

$badge_img   = psm_theme_image('badge.webp');
$icon_base   = get_template_directory_uri() . '/assets/images/';
$phone_icon  = psm_theme_image('c-phone.webp') ?: $icon_base . 'c-phone.webp';
$has_phone   = '' !== $phone && '' !== $phone_href;
$has_social  = !empty($social_links);
$has_action  = $has_social || $has_phone;
?>
<div class="psm-climate-change-media">
    <span class="psm-climate-change-media__frame" aria-hidden="true"></span>
    <span class="psm-climate-change-media__accent" aria-hidden="true"></span>

    <div class="psm-climate-change-media__inner">
        <div class="psm-climate-change-media__img-wrap">
            <img
                class="psm-climate-change-media__img"
                src="<?php echo esc_url($image); ?>"
                alt="<?php echo esc_attr($args['image_alt']); ?>"
                width="600"
                height="720"
                loading="lazy"
                decoding="async"
            >

            <?php if ($badge_img) : ?>
                <div class="psm-climate-change-media__badge">
                    <img
                        src="<?php echo esc_url($badge_img); ?>"
                        alt=""
                        width="128"
                        height="128"
                        decoding="async"
                    >
                </div>
            <?php endif; ?>

            <?php if ($has_action) : ?>
                <div class="psm-climate-change-media__action">
                    <?php if ($has_social) : ?>
                        <div class="psm-climate-change-media__action-social" role="navigation" aria-label="<?php esc_attr_e('Social media', 'cmd-theme'); ?>">
                            <?php foreach ($social_links as $social) : ?>
                                <a
                                    class="psm-climate-change-media__action-social-btn"
                                    href="<?php echo esc_url($social['url']); ?>"
                                    aria-label="<?php echo esc_attr($social['label']); ?>"
                                    <?php echo 0 === strpos($social['url'], 'http') ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>
                                >
                                    <img src="<?php echo esc_url($social['icon']); ?>" alt="" decoding="async">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($has_phone) : ?>
                        <a class="psm-climate-change-media__action-phone" href="<?php echo esc_url($phone_href); ?>">
                            <span class="psm-climate-change-media__action-phone-icon" aria-hidden="true">
                                <img src="<?php echo esc_url($phone_icon); ?>" alt="" decoding="async">
                            </span>
                            <span class="psm-climate-change-media__action-phone-copy">
                                <span class="psm-climate-change-media__action-phone-label"><?php esc_html_e('Call Us Now:', 'cmd-theme'); ?></span>
                                <span class="psm-climate-change-media__action-phone-number"><?php echo esc_html($phone); ?></span>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
