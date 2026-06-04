<?php
/**
 * News custom post type.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Register psm_news post type.
 */
function psm_register_news_post_type() {
    $labels = array(
        'name'               => __('News', 'cmd-theme'),
        'singular_name'      => __('News Item', 'cmd-theme'),
        'menu_name'          => __('News', 'cmd-theme'),
        'add_new'            => __('Add New', 'cmd-theme'),
        'add_new_item'       => __('Add News Item', 'cmd-theme'),
        'edit_item'          => __('Edit News Item', 'cmd-theme'),
        'new_item'           => __('New News Item', 'cmd-theme'),
        'view_item'          => __('View News Item', 'cmd-theme'),
        'search_items'       => __('Search News', 'cmd-theme'),
        'not_found'          => __('No news found', 'cmd-theme'),
        'not_found_in_trash' => __('No news found in Trash', 'cmd-theme'),
    );

    register_post_type(
        'psm_news',
        array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'has_archive'         => false,
            'menu_icon'           => 'dashicons-megaphone',
            'menu_position'       => 22,
            'supports'            => array('title', 'thumbnail', 'editor'),
            'rewrite'             => array(
                'slug'       => 'news',
                'with_front' => false,
            ),
        )
    );
}
add_action('init', 'psm_register_news_post_type');
