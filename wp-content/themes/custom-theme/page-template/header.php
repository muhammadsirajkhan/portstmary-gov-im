<?php
/**
 * Site header markup.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <style>
        .figtree-<uniquifier> {
            font-family: "Figtree", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
        }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    }
    ?>
    <!-- <a class="skip-to-main" href="#primary"><?php esc_html_e('Skip to content', 'cmd-theme'); ?></a> -->
    <?php
    get_template_part('template-parts/global/navbar');
    get_template_part('template-parts/global/mobile-menu');
