<?php
/**
 * Disable Gutenberg — use Classic Editor for posts, pages, and CPTs with editor support.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Post types that use the Classic Editor (TinyMCE).
 *
 * @return string[]
 */
function psm_classic_editor_post_types() {
    $types = array('post', 'page');

    foreach (get_post_types(array('public' => true, '_builtin' => false), 'names') as $post_type) {
        if (post_type_supports($post_type, 'editor')) {
            $types[] = $post_type;
        }
    }

    return array_values(array_unique(apply_filters('psm_classic_editor_post_types', $types)));
}

/**
 * Disable block editor per post type.
 *
 * @param bool   $use_block_editor Whether the block editor is enabled.
 * @param string $post_type        Post type slug.
 */
function psm_use_classic_editor_for_post_type($use_block_editor, $post_type) {
    if (in_array($post_type, psm_classic_editor_post_types(), true)) {
        return false;
    }

    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'psm_use_classic_editor_for_post_type', 100, 2);

/**
 * Disable block editor for individual posts/pages (backup filter).
 *
 * @param bool     $use_block_editor Whether the block editor is enabled.
 * @param WP_Post  $post             Post object.
 */
function psm_use_classic_editor_for_post($use_block_editor, $post) {
    if ($post instanceof WP_Post && in_array($post->post_type, psm_classic_editor_post_types(), true)) {
        return false;
    }

    return $use_block_editor;
}
add_filter('use_block_editor_for_post', 'psm_use_classic_editor_for_post', 100, 2);

/**
 * Legacy Gutenberg filter (older WordPress / Classic Editor plugin compatibility).
 */
add_filter('gutenberg_can_edit_post_type', 'psm_use_classic_editor_for_post_type', 100, 2);

/**
 * Widgets screen: Classic widgets, not block widgets.
 */
add_filter('use_widgets_block_editor', '__return_false');
add_filter('gutenberg_use_widgets_block_editor', '__return_false');

/**
 * Remove block editor admin styles/scripts on classic post type edit screens.
 */
function psm_classic_editor_admin_cleanup() {
    if (!is_admin()) {
        return;
    }

    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || !in_array($screen->base, array('post', 'post-new'), true)) {
        return;
    }

    if (!in_array($screen->post_type, psm_classic_editor_post_types(), true)) {
        return;
    }

    wp_dequeue_style('wp-block-editor');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_script('wp-block-editor');
    wp_dequeue_script('wp-blocks');
    wp_dequeue_script('wp-block-editor');
    wp_dequeue_script('wp-block-library');
}
add_action('admin_enqueue_scripts', 'psm_classic_editor_admin_cleanup', 100);
