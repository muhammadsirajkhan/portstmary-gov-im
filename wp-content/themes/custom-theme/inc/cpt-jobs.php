<?php
/**
 * Jobs custom post type.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Register psm_job post type.
 */
function psm_register_job_post_type() {
    $labels = array(
        'name'               => __('Jobs', 'cmd-theme'),
        'singular_name'      => __('Job', 'cmd-theme'),
        'menu_name'          => __('Jobs', 'cmd-theme'),
        'add_new'            => __('Add New', 'cmd-theme'),
        'add_new_item'       => __('Add New Job', 'cmd-theme'),
        'edit_item'          => __('Edit Job', 'cmd-theme'),
        'new_item'           => __('New Job', 'cmd-theme'),
        'view_item'          => __('View Job', 'cmd-theme'),
        'search_items'       => __('Search Jobs', 'cmd-theme'),
        'not_found'          => __('No jobs found', 'cmd-theme'),
        'not_found_in_trash' => __('No jobs found in Trash', 'cmd-theme'),
    );

    register_post_type(
        'psm_job',
        array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'has_archive'         => false,
            'menu_icon'           => 'dashicons-id-alt',
            'menu_position'       => 23,
            'supports'            => array('title', 'editor', 'page-attributes'),
            'rewrite'             => array(
                'slug'       => 'jobs',
                'with_front' => false,
            ),
        )
    );
}
add_action('init', 'psm_register_job_post_type');
