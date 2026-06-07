<?php
/**
 * ACF options page for site header settings.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Register Header Settings options page.
 */
function psm_register_header_options_page() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page(
        array(
            'page_title'  => __('Header Settings', 'cmd-theme'),
            'menu_title'  => __('Header', 'cmd-theme'),
            'menu_slug'   => 'psm-header-settings',
            'parent_slug' => 'themes.php',
            'capability'  => 'edit_theme_options',
            'redirect'    => false,
            'position'    => 61,
        )
    );
}
add_action('acf/init', 'psm_register_header_options_page');
