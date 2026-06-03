<?php
/**
 * Front page: static Page uses its assigned template; latest-posts home uses home.php.
 *
 * @package The_Black_Door_Oven
 */

defined('ABSPATH') || exit;

if (is_page()) {
    $page_template = get_page_template();
    if ($page_template && is_readable($page_template)) {
        load_template($page_template);
        return;
    }
}

require get_template_directory() . '/home.php';
