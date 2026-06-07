<?php
/**
 * Asset enqueue.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

define('PSM_THEME_VER', '1.0.0');

/**
 * Enqueue styles and scripts.
 */
function psm_enqueue_assets() {
    $uri = get_template_directory_uri();
    $dir = get_template_directory();

    $common_css  = $dir . '/assets/css/common.css';
    $style_css   = $dir . '/assets/css/style.css';
    $resp_css    = $dir . '/assets/css/responsive.css';
    $main_js     = $dir . '/assets/js/main.js';
    $satoshi_css = $dir . '/assets/fonts/stylesheet.css';

    $common_ver  = is_readable($common_css) ? (string) filemtime($common_css) : PSM_THEME_VER;
    $style_ver   = is_readable($style_css) ? (string) filemtime($style_css) : PSM_THEME_VER;
    $resp_ver    = is_readable($resp_css) ? (string) filemtime($resp_css) : PSM_THEME_VER;
    $js_ver      = is_readable($main_js) ? (string) filemtime($main_js) : PSM_THEME_VER;
    $satoshi_ver = is_readable($satoshi_css) ? (string) filemtime($satoshi_css) : PSM_THEME_VER;

    wp_enqueue_style('psm-fonts-satoshi', $uri . '/assets/fonts/stylesheet.css', array(), $satoshi_ver);
    wp_enqueue_style(
        'psm-fonts-figtree',
        'https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Great+Vibes&display=swap',
        array(),
        null
    );

    wp_enqueue_style('bootstrap', $uri . '/assets/css/bootstrap.min.css', array(), PSM_THEME_VER);
    wp_enqueue_style('swiper', $uri . '/assets/css/swiper-bundle.min.css', array(), PSM_THEME_VER);

    wp_enqueue_style(
        'psm-variables',
        $uri . '/assets/css/variables.css',
        array('bootstrap', 'swiper', 'psm-fonts-satoshi', 'psm-fonts-figtree'),
        $common_ver
    );
    wp_enqueue_style('psm-common', $uri . '/assets/css/common.css', array('psm-variables'), $common_ver);
    wp_enqueue_style('psm-style', $uri . '/assets/css/style.css', array('psm-common'), $style_ver);
    wp_enqueue_style('psm-responsive', $uri . '/assets/css/responsive.css', array('psm-style'), $resp_ver);

    wp_enqueue_script('bootstrap-bundle', $uri . '/assets/js/bootstrap.bundle.min.js', array(), PSM_THEME_VER, true);
    wp_enqueue_script('swiper', $uri . '/assets/js/swiper-bundle.min.js', array(), PSM_THEME_VER, true);
    wp_enqueue_script('psm-main', $uri . '/assets/js/main.js', array('bootstrap-bundle', 'swiper'), $js_ver, true);
}
add_action('wp_enqueue_scripts', 'psm_enqueue_assets');

/**
 * Preconnect to Google Fonts for Figtree.
 *
 * @param string[]|array[] $urls          URLs to print for resource hints.
 * @param string           $relation_type Relation type.
 * @return string[]|array[]
 */
function psm_font_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'psm_font_resource_hints', 10, 2);
