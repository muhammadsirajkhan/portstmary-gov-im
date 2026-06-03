<?php
/**
 * Shared helpers for standalone XAMPP and WordPress theme modes.
 *
 * @package IOM_Commonwealth
 */

if (!defined('ABSPATH')) {
    $GLOBALS['iom_theme_dir'] = dirname(__DIR__);
}

if (!function_exists('iom_theme_directory')) {
    /**
     * Absolute filesystem path to theme / project root.
     */
    function iom_theme_directory() {
        if (function_exists('get_template_directory')) {
            return get_template_directory();
        }
        return isset($GLOBALS['iom_theme_dir']) ? $GLOBALS['iom_theme_dir'] : dirname(__DIR__);
    }
}

if (!function_exists('iom_base_uri')) {
    /**
     * Public URL root for this theme / project (no trailing slash).
     */
    function iom_base_uri() {
        if (function_exists('get_template_directory_uri')) {
            return rtrim(get_template_directory_uri(), '/');
        }
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        $script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
        $dir = rtrim(dirname($script), '/');
        if ($dir === '/' || $dir === '\\') {
            $dir = '';
        }
        return $scheme . '://' . $host . $dir;
    }
}

if (!function_exists('iom_asset_uri')) {
    /**
     * Full URL to a file under the theme root (e.g. assets/css/foo.css).
     */
    function iom_asset_uri($relative_path) {
        $relative_path = ltrim(str_replace('\\', '/', $relative_path), '/');
        return iom_base_uri() . '/' . $relative_path;
    }
}

if (!function_exists('iom_page_url')) {
    /**
     * Link to a PHP entry file; uses home_url in WordPress.
     */
    function iom_page_url($php_basename) {
        if (function_exists('home_url')) {
            if ($php_basename === 'index.php') {
                return home_url('/');
            }
            if ($php_basename === 'about.php') {
                if (function_exists('get_page_by_path')) {
                    $page = get_page_by_path('about');
                    if ($page) {
                        return get_permalink($page);
                    }
                }
                return home_url('/about/');
            }
            return home_url('/' . ltrim($php_basename, '/'));
        }
        return $php_basename;
    }
}

if (!function_exists('iom_load_template_part')) {
    /**
     * Load a PHP partial from page-template/.
     */
    function iom_load_template_part($name) {
        $path = iom_theme_directory() . '/page-template/' . $name . '.php';
        if (is_readable($path)) {
            require $path;
        }
    }
}

/* Minimal i18n / escaping when WordPress is not loaded (standalone XAMPP). */
if (!function_exists('esc_html')) {
    function esc_html($text) {
        return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
    }
}
if (!function_exists('esc_attr')) {
    function esc_attr($text) {
        return esc_html($text);
    }
}
if (!function_exists('esc_url')) {
    function esc_url($url) {
        return esc_html($url);
    }
}
if (!function_exists('__')) {
    function __($text, $domain = null) {
        return $text;
    }
}
if (!function_exists('esc_html_e')) {
    function esc_html_e($text, $domain = null) {
        echo esc_html(__($text, $domain));
    }
}
if (!function_exists('esc_attr_e')) {
    function esc_attr_e($text, $domain = null) {
        echo esc_attr(__($text, $domain));
    }
}