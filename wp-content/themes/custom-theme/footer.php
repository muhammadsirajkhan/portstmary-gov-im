<?php
/**
 * WordPress entry: delegates to shared partial.
 *
 * @package The_Black_Door_Oven
 */

if (!defined('ABSPATH')) {
    exit;
}

$footer_args = array();
if (isset($args) && is_array($args)) {
    $footer_args = $args;
}

get_template_part('page-template/footer', null, $footer_args);
