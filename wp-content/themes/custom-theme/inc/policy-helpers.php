<?php
/**
 * Policy page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Policy page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_policy_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-policy.php' === get_page_template_slug($post_id);
}

/**
 * Breadcrumbs for a policy page.
 *
 * @param int $post_id Page ID.
 * @return array<int, array{label: string, url: string}>
 */
function psm_get_policy_single_breadcrumbs($post_id) {
    $post_id = (int) $post_id;
    $title   = $post_id > 0 ? get_the_title($post_id) : '';

    return array(
        array(
            'label' => __('Home', 'cmd-theme'),
            'url'   => home_url('/'),
        ),
        array(
            'label' => $title ?: __('Policy', 'cmd-theme'),
            'url'   => '',
        ),
    );
}

/**
 * Display data for the policy page template.
 *
 * @param int $post_id Page ID.
 * @return array{
 *     title: string,
 *     updated: string,
 *     breadcrumb: array
 * }
 */
function psm_get_policy_single_data($post_id) {
    $post_id = (int) $post_id;
    if ($post_id <= 0) {
        return array();
    }

    $title = get_the_title($post_id);

    $updated = '';
    $show_updated = function_exists('get_field') ? get_field('policy_show_last_updated', $post_id) : 1;

    if ($show_updated) {
        if (function_exists('get_field')) {
            $custom_date = get_field('policy_last_updated', $post_id);
            if (is_string($custom_date) && '' !== trim($custom_date)) {
                $timestamp = strtotime($custom_date);
                if ($timestamp) {
                    $updated = wp_date('j F Y', $timestamp);
                }
            }
        }

        if ('' === $updated) {
            $updated = get_the_modified_date('j F Y', $post_id);
        }
    }

    return array(
        'title'      => trim((string) $title),
        'updated'    => trim((string) $updated),
        'breadcrumb' => psm_get_policy_single_breadcrumbs($post_id),
    );
}
