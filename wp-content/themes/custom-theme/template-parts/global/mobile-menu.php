<?php
/**
 * Mobile navigation drawer.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$header   = function_exists('psm_get_header_settings') ? psm_get_header_settings() : array();
$cta      = isset($header['cta']) && is_array($header['cta']) ? $header['cta'] : array();
$show_cta = !empty($header['show_cta']) && '' !== ($cta['url'] ?? '') && '' !== ($cta['title'] ?? '');

$mobile_walker = class_exists('PSM_Mobile_Nav_Walker') ? new PSM_Mobile_Nav_Walker() : null;
?>
<div class="mobile-nav-overlay" aria-hidden="true"></div>
<aside id="mobile-nav-panel" class="mobile-nav-panel" aria-hidden="true">
    <div class="psm-mobile-panel__head">
        <button type="button" class="mobile-menu-close psm-mobile-close" aria-label="<?php esc_attr_e('Close menu', 'cmd-theme'); ?>">&times;</button>
    </div>
    <nav class="mobile-navigation" aria-label="<?php esc_attr_e('Mobile menu', 'cmd-theme'); ?>">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary_left',
                'container'      => false,
                'menu_class'     => 'psm-mobile-menu',
                'fallback_cb'    => false,
                'depth'          => 2,
                'walker'         => $mobile_walker,
            )
        );
        wp_nav_menu(
            array(
                'theme_location' => 'primary_right',
                'container'      => false,
                'menu_class'     => 'psm-mobile-menu psm-mobile-menu--right',
                'fallback_cb'    => false,
                'depth'          => 2,
                'walker'         => $mobile_walker,
            )
        );
        ?>
        <?php if ($show_cta) : ?>
            <?php
            get_template_part(
                'template-parts/components/button-pill',
                null,
                array(
                    'text'    => $cta['title'],
                    'url'     => $cta['url'],
                    'target'  => $cta['target'],
                    'variant' => 'primary',
                )
            );
            ?>
        <?php endif; ?>
    </nav>
</aside>
