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
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>
<a class="skip-to-main" href="#primary"><?php esc_html_e('Skip to content', 'cmd-theme'); ?></a>
<?php
get_template_part('template-parts/global/navbar');
get_template_part('template-parts/global/mobile-menu');
