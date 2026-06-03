<?php
/**
 * ACF local JSON save/load paths.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

add_filter(
    'acf/settings/save_json',
    static function () {
        return get_template_directory() . '/acf-json';
    }
);

add_filter(
    'acf/settings/load_json',
    static function ($paths) {
        $paths[] = get_template_directory() . '/acf-json';
        return $paths;
    }
);
