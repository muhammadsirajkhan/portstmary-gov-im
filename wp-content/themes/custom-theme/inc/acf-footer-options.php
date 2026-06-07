<?php
/**
 * ACF options page for site footer settings.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Register Footer Settings options page.
 */
function psm_register_footer_options_page() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page(
        array(
            'page_title'  => __('Footer Settings', 'cmd-theme'),
            'menu_title'  => __('Footer', 'cmd-theme'),
            'menu_slug'   => 'psm-footer-settings',
            'parent_slug' => 'themes.php',
            'capability'  => 'edit_theme_options',
            'redirect'    => false,
            'position'    => 62,
        )
    );
}
add_action('acf/init', 'psm_register_footer_options_page');
