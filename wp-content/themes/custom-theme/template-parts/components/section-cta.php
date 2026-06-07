<?php
/**
 * Reusable section footer CTA: pill button + phone block.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $button_text   Primary CTA label.
 *     @type string $button_url    Primary CTA URL.
 *     @type string $button_target Link target attribute.
 *     @type string $phone_label   Phone label (default Call Us Now:).
 *     @type string $phone_display Display number.
 *     @type string $phone_href    tel: link.
 *     @type string $class         Optional extra footer class.
 *     @type string $align         center|left — horizontal alignment.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'button_text'   => '',
        'button_url'    => '',
        'button_target' => '',
        'phone_label'   => __('Call Us Now:', 'cmd-theme'),
        'phone_display' => '',
        'phone_href'    => '',
        'class'         => '',
        'align'         => 'center',
    )
);

$button_text   = trim((string) $args['button_text']);
$button_url    = trim((string) $args['button_url']);
$button_target = trim((string) $args['button_target']);
$phone_display = trim((string) $args['phone_display']);
$phone_href    = trim((string) $args['phone_href']);

$has_button = '' !== $button_url;
$has_phone  = '' !== $phone_display && '' !== $phone_href;

if (!$has_button && !$has_phone) {
    return;
}

$footer_class = 'psm-section-cta';
if ('left' === $args['align']) {
    $footer_class .= ' psm-section-cta--left';
}
if ($args['class']) {
    $footer_class .= ' ' . esc_attr($args['class']);
}

$button_target_attr = '';
$button_rel_attr    = '';
if ($button_target) {
    $button_target_attr = ' target="' . esc_attr($button_target) . '"';
    if ('_blank' === $button_target) {
        $button_rel_attr = ' rel="noopener noreferrer"';
    }
}
?>
<footer class="<?php echo esc_attr($footer_class); ?>">
    <?php if ($has_button) : ?>
        <a class="psm-section-cta__button" href="<?php echo esc_url($button_url); ?>"<?php echo $button_target_attr . $button_rel_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
            <?php if ('' !== $button_text) : ?>
                <span class="psm-section-cta__button-text"><?php echo esc_html($button_text); ?></span>
            <?php endif; ?>
            <span class="psm-section-cta__button-icon" aria-hidden="true">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/btn-arrow.webp'); ?>" alt="<?php esc_attr_e('Arrow', 'cmd-theme'); ?>">
            </span>
        </a>
    <?php endif; ?>
    <?php if ($has_phone) : ?>
        <a class="psm-section-cta__phone" href="<?php echo esc_url($phone_href); ?>">
            <span class="" aria-hidden="true">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/btn-phone.webp'); ?>" alt="<?php esc_attr_e('Phone', 'cmd-theme'); ?>">
            </span>
            <span class="psm-section-cta__phone-copy">
                <?php if ('' !== trim((string) $args['phone_label'])) : ?>
                    <span class="psm-section-cta__phone-label"><?php echo esc_html($args['phone_label']); ?></span>
                <?php endif; ?>
                <span class="psm-section-cta__phone-number"><?php echo esc_html($phone_display); ?></span>
            </span>
        </a>
    <?php endif; ?>
</footer>
