<?php
/**
 * Main navigation (ACF Header Settings + WordPress menus).
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$header     = function_exists('psm_get_header_settings') ? psm_get_header_settings() : array();
$acf_logo   = trim((string) ($header['logo_url'] ?? ''));
$cta        = isset($header['cta']) && is_array($header['cta']) ? $header['cta'] : array();
$show_cta   = !empty($header['show_cta']) && '' !== ($cta['url'] ?? '') && '' !== ($cta['title'] ?? '');
$is_home    = is_front_page();
$header_cls = 'psm-header' . ($is_home ? ' psm-header--home' : '');
?>
<header class="<?php echo esc_attr($header_cls); ?>" id="site-header">
    <?php get_template_part('template-parts/global/topbar'); ?>
    <div class="psm-header__main">
        <div class="container psm-container">
            <div class="psm-header__bar">
                <nav class="psm-nav psm-nav--left d-none d-lg-flex" aria-label="<?php esc_attr_e('Primary left', 'cmd-theme'); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary_left',
                            'container'      => false,
                            'menu_class'     => 'psm-nav-list',
                            'fallback_cb'    => false,
                            'depth'          => 2,
                        )
                    );
                    ?>
                </nav>

                <div class="psm-header__logo">
                    <div class="psm-header__logo-tab">
                        <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php elseif ('' !== $acf_logo) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="psm-logo-link">
                                <img src="<?php echo esc_url($acf_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" width="130" height="130" loading="eager">
                            </a>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="psm-logo-link psm-logo-fallback" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="psm-header__right d-none d-lg-flex align-items-center">
                    <nav class="psm-nav psm-nav--right" aria-label="<?php esc_attr_e('Primary right', 'cmd-theme'); ?>">
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary_right',
                                'container'      => false,
                                'menu_class'     => 'psm-nav-list',
                                'fallback_cb'    => false,
                                'depth'          => 2,
                            )
                        );
                        ?>
                    </nav>
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
                </div>

                <button type="button" class="psm-burger d-lg-none mobile-menu-toggle" aria-expanded="false" aria-controls="mobile-nav-panel" aria-label="<?php esc_attr_e('Open menu', 'cmd-theme'); ?>">
                    <span class="psm-burger__line"></span>
                    <span class="psm-burger__line"></span>
                    <span class="psm-burger__line"></span>
                </button>
            </div>
        </div>
    </div>
</header>
