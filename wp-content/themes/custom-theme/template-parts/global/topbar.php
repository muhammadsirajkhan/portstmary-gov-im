<?php
/**
 * Top bar — email + social (ACF Header Settings).
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$header = function_exists('psm_get_header_settings') ? psm_get_header_settings() : array();

if (!function_exists('psm_header_has_topbar') || !psm_header_has_topbar($header)) {
    return;
}

$email        = trim((string) ($header['email'] ?? ''));
$email_label  = trim((string) ($header['email_label'] ?? ''));
$social_label = trim((string) ($header['social_label'] ?? ''));
$social_links = isset($header['social_links']) && is_array($header['social_links']) ? $header['social_links'] : array();
$has_email    = '' !== $email;
$has_social   = !empty($social_links);
?>
<div class="psm-topbar">
    <div class="container psm-container psm-topbar__inner">
        <?php if ($has_email) : ?>
            <a class="psm-topbar__email" href="<?php echo esc_url('mailto:' . $email); ?>">
                <span class="psm-topbar__email" aria-hidden="true">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/h1.png'); ?>" alt="" decoding="async">
                </span>
                <span class="psm-topbar__email-text">
                    <?php if ('' !== $email_label) : ?>
                        <span class="psm-topbar__email-label"><?php echo esc_html($email_label); ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($email); ?>
                </span>
            </a>
        <?php endif; ?>

        <?php if ($has_social) : ?>
            <div class="psm-topbar__social-wrap">
                <?php if ('' !== $social_label) : ?>
                    <span class="psm-topbar__social-label"><?php echo esc_html($social_label); ?></span>
                <?php endif; ?>
                <ul class="psm-topbar__social list-unstyled mb-0">
                    <?php foreach ($social_links as $network) : ?>
                        <li>
                            <a
                                href="<?php echo esc_url($network['url']); ?>"
                                class="psm-topbar-social"
                                data-network="<?php echo esc_attr($network['icon']); ?>"
                                aria-label="<?php echo esc_attr($network['label']); ?>"
                                <?php echo 0 === strpos($network['url'], 'http') ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>
                            >
                                <span class="psm-topbar-social" aria-hidden="true">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . $network['icon'] . '.png'); ?>" alt="" decoding="async">
                                </span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
