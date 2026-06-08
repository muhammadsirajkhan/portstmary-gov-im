<?php
/**
 * Climate Change — layered image with frame, badge, and contact action bar.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image      Main image URL.
 *     @type string $image_alt  Image alt text.
 *     @type string $phone_href tel: link.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image'      => '',
        'image_alt'  => __('Port St Mary Commissioners', 'cmd-theme'),
        'phone_href' => 'tel:+441624832101',
    )
);

$image = trim((string) $args['image']);
if ('' === $image) {
    $image = psm_theme_image('c-image.webp') ?: psm_placeholder_image(600, 720, 'psm-climate-change-commitment');
}

$badge_img = psm_theme_image('badge.webp');
$phone_href = trim((string) $args['phone_href']) ?: 'tel:+441624832101';

$icon_base = get_template_directory_uri() . '/assets/images/';

$action_social = array(
    array(
        'url'   => '#',
        'label' => __('Facebook', 'cmd-theme'),
        'icon'  => psm_theme_image('c-facebook.webp') ?: $icon_base . 'c-facebook.webp',
    ),
    array(
        'url'   => '#',
        'label' => __('Instagram', 'cmd-theme'),
        'icon'  => psm_theme_image('c-insta.webp') ?: $icon_base . 'c-insta.webp',
    ),
    array(
        'url'   => '#',
        'label' => __('LinkedIn', 'cmd-theme'),
        'icon'  => psm_theme_image('c-linkendin.webp') ?: $icon_base . 'c-linkendin.webp',
    ),
);

$phone_icon = psm_theme_image('c-phone.webp') ?: $icon_base . 'c-phone.webp';
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

            <div class="psm-climate-change-media__action">
                <div class="psm-climate-change-media__action-social" role="navigation" aria-label="<?php esc_attr_e('Social media', 'cmd-theme'); ?>">
                    <?php foreach ($action_social as $social) : ?>
                        <a
                            class="psm-climate-change-media__action-social-btn"
                            href="<?php echo esc_url($social['url']); ?>"
                            aria-label="<?php echo esc_attr($social['label']); ?>"
                        >
                            <img src="<?php echo esc_url($social['icon']); ?>" alt="" decoding="async">
                        </a>
                    <?php endforeach; ?>
                </div>

                <a class="psm-climate-change-media__action-phone" href="<?php echo esc_url($phone_href); ?>">
                    <span class="psm-climate-change-media__action-phone-icon" aria-hidden="true">
                        <img src="<?php echo esc_url($phone_icon); ?>" alt="" decoding="async">
                    </span>
                    <span class="psm-climate-change-media__action-phone-copy">
                        <span class="psm-climate-change-media__action-phone-label"><?php esc_html_e('Call Us Now:', 'cmd-theme'); ?></span>
                        <span class="psm-climate-change-media__action-phone-number"><?php esc_html_e('(01624) 832101', 'cmd-theme'); ?></span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
