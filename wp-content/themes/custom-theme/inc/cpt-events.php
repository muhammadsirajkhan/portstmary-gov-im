<?php
/**
 * Event custom post type.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Register psm_event post type.
 */
function psm_register_event_post_type() {
    $labels = array(
        'name'               => __('Events', 'cmd-theme'),
        'singular_name'      => __('Event', 'cmd-theme'),
        'menu_name'          => __('Events', 'cmd-theme'),
        'add_new'            => __('Add New', 'cmd-theme'),
        'add_new_item'       => __('Add New Event', 'cmd-theme'),
        'edit_item'          => __('Edit Event', 'cmd-theme'),
        'new_item'           => __('New Event', 'cmd-theme'),
        'view_item'          => __('View Event', 'cmd-theme'),
        'search_items'       => __('Search Events', 'cmd-theme'),
        'not_found'          => __('No events found', 'cmd-theme'),
        'not_found_in_trash' => __('No events found in Trash', 'cmd-theme'),
    );

    register_post_type(
        'psm_event',
        array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'has_archive'         => false,
            'menu_icon'           => 'dashicons-calendar-alt',
            'menu_position'       => 21,
            'supports'            => array('title', 'thumbnail', 'editor'),
            'rewrite'             => array(
                'slug'       => 'events',
                'with_front' => false,
            ),
        )
    );
}
add_action('init', 'psm_register_event_post_type');
