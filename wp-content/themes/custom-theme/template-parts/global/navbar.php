<?php
/**
 * Main navigation.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$logo_url   = get_template_directory_uri() . '/assets/images/header-logo.png';
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
                            'fallback_cb'    => 'psm_fallback_nav_left',
                            'depth'          => 2,
                        )
                    );
                    ?>
                </nav>

                <div class="psm-header__logo">
                    <div class="psm-header__logo-tab">
                        <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php elseif ($logo_url) : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="psm-logo-link">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/header-logo.png" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" width="130" height="130" loading="eager">
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
                                'fallback_cb'    => 'psm_fallback_nav_right',
                                'depth'          => 2,
                            )
                        );
                        ?>
                    </nav>
                    <!-- <button type="button" class="psm-header__search" aria-label="<?php esc_attr_e('Search', 'cmd-theme'); ?>"></button> -->
                    <?php
                    get_template_part(
                        'template-parts/components/button-pill',
                        null,
                        array(
                            'text'    => __('Report an Issue', 'cmd-theme'),
                            'url'     => psm_contact_page_url(),
                            'variant' => 'primary',
                        )
                    );
                    ?>
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
