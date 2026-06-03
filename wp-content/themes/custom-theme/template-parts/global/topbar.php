<?php
/**
 * Top bar — email + social.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$email        = 'commissioners@portstmary.gov.im';
$email_label  = __('Email Now:', 'cmd-theme');
$social_label = __('Follow Us Online:', 'cmd-theme');

$social_networks = array(
    array('id' => 'h2', 'label' => 'Facebook'),
    array('id' => 'h3', 'label' => 'X'),
    array('id' => 'h4', 'label' => 'YouTube'),
    array('id' => 'h5', 'label' => 'LinkedIn'),
    array('id' => 'h6', 'label' => 'Instagram'),
    array('id' => 'h7', 'label' => 'TikTok'),
);
?>
<div class="psm-topbar">
    <div class="container psm-container psm-topbar__inner">
        <a class="psm-topbar__email" href="mailto:<?php echo esc_attr($email); ?>">
            <span class="psm-topbar__email" aria-hidden="true">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/h1.png'); ?>" alt="" decoding="async">
            </span>
            <span class="psm-topbar__email-text">
                <span class="psm-topbar__email-label"><?php echo esc_html($email_label); ?></span>
                <?php echo esc_html($email); ?>
            </span>
        </a>
        <div class="psm-topbar__social-wrap">
            <span class="psm-topbar__social-label"><?php echo esc_html($social_label); ?></span>
            <ul class="psm-topbar__social list-unstyled mb-0">
                <?php foreach ($social_networks as $network) : ?>
                    <li>
                        <a href="#" class="psm-topbar-social" data-network="<?php echo esc_attr($network['id']); ?>" aria-label="<?php echo esc_attr($network['label']); ?>">
                            <span class="psm-topbar-social" aria-hidden="true">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/' . esc_attr($network['id']) . '.png'); ?>" alt="" decoding="async">
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
