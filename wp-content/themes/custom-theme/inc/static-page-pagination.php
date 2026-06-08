<?php
/**
 * Pagination for static archive pages (News, Events) that share a CPT slug.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Page templates that use custom post queries with pagination.
 *
 * @return string[]
 */
function psm_get_paginated_archive_page_templates() {
    return array(
        'page-news.php',
        'page-events.php',
    );
}

/**
 * Published page IDs using paginated archive templates.
 *
 * @return int[]
 */
function psm_get_paginated_archive_page_ids() {
    static $cache = null;

    if (null !== $cache) {
        return $cache;
    }

    $cache = array();

    foreach (psm_get_paginated_archive_page_templates() as $template) {
        $pages = get_posts(
            array(
                'post_type'      => 'page',
                'post_status'    => 'publish',
                'meta_key'       => '_wp_page_template',
                'meta_value'     => $template,
                'posts_per_page' => -1,
                'fields'         => 'ids',
            )
        );

        foreach ($pages as $page_id) {
            $cache[] = (int) $page_id;
        }
    }

    return $cache;
}

/**
 * Page URI path relative to site root.
 *
 * @param int $page_id Page ID.
 * @return string
 */
function psm_get_page_uri_path($page_id) {
    return trim((string) get_page_uri((int) $page_id), '/');
}

/**
 * Current request path without leading or trailing slashes.
 *
 * @return string
 */
function psm_get_request_uri_path() {
    if (empty($_SERVER['REQUEST_URI'])) {
        return '';
    }

    $path = trim((string) wp_parse_url(wp_unslash($_SERVER['REQUEST_URI']), PHP_URL_PATH), '/');
    $home_path = trim((string) wp_parse_url(home_url(), PHP_URL_PATH), '/');

    if ('' !== $home_path && 0 === strpos($path, $home_path)) {
        $path = trim(substr($path, strlen($home_path)), '/');
    }

    return $path;
}

/**
 * Match /{page-slug}/page/{n}/ against archive pages.
 *
 * @param int $page_id Optional page ID limit.
 * @return array{page_id: int, paged: int}
 */
function psm_match_static_page_pagination_from_uri($page_id = 0) {
    $request_path = psm_get_request_uri_path();

    if ('' === $request_path) {
        return array(
            'page_id' => 0,
            'paged'   => 0,
        );
    }

    $page_ids = $page_id ? array((int) $page_id) : psm_get_paginated_archive_page_ids();

    foreach ($page_ids as $id) {
        $page_path = psm_get_page_uri_path($id);

        if ('' === $page_path) {
            continue;
        }

        $pattern = '#^' . preg_quote($page_path, '#') . '/page/([0-9]+)/?$#i';

        if (preg_match($pattern, $request_path, $matches)) {
            return array(
                'page_id' => (int) $id,
                'paged'   => max(1, (int) $matches[1]),
            );
        }
    }

    return array(
        'page_id' => 0,
        'paged'   => 0,
    );
}

/**
 * Current pagination page for a static archive page.
 *
 * @param int $page_id Page ID.
 * @return int
 */
function psm_get_static_page_current($page_id = 0) {
    $current = (int) get_query_var('page');
    if ($current > 0) {
        return $current;
    }

    $current = (int) get_query_var('paged');
    if ($current > 0) {
        return $current;
    }

    if (isset($_GET['page'])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $current = (int) wp_unslash($_GET['page']); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if ($current > 0) {
            return $current;
        }
    }

    $match = psm_match_static_page_pagination_from_uri($page_id);
    if ($match['paged'] > 0) {
        return $match['paged'];
    }

    return 1;
}

/**
 * Register top-priority rewrite rules for archive page pagination.
 */
function psm_register_static_page_pagination_rewrites() {
    global $wp_rewrite;

    $pagination_base = ($wp_rewrite && $wp_rewrite->pagination_base) ? $wp_rewrite->pagination_base : 'page';

    foreach (psm_get_paginated_archive_page_ids() as $page_id) {
        $page_path = psm_get_page_uri_path($page_id);

        if ('' === $page_path) {
            continue;
        }

        add_rewrite_rule(
            '^' . preg_quote($page_path, '#') . '/' . preg_quote($pagination_base, '#') . '/([0-9]{1,})/?$',
            'index.php?pagename=' . $page_path . '&page=$matches[1]',
            'top'
        );
    }
}
add_action('init', 'psm_register_static_page_pagination_rewrites', 20);

/**
 * Flush rewrite rules after theme switch so pagination routes register.
 */
function psm_flush_static_page_pagination_rewrites() {
    psm_register_static_page_pagination_rewrites();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'psm_flush_static_page_pagination_rewrites');

/**
 * Resolve CPT slug conflicts for /events/page/2/ style URLs.
 *
 * @param array<string, mixed> $query_vars Query vars.
 * @return array<string, mixed>
 */
function psm_fix_static_page_pagination_request($query_vars) {
    $match = psm_match_static_page_pagination_from_uri();

    if ($match['page_id'] <= 0 || $match['paged'] <= 0) {
        return $query_vars;
    }

    unset($query_vars['name'], $query_vars['psm_event'], $query_vars['psm_news'], $query_vars['error']);

    $query_vars['pagename'] = psm_get_page_uri_path($match['page_id']);
    $query_vars['page']     = $match['paged'];

    return $query_vars;
}
add_filter('request', 'psm_fix_static_page_pagination_request', 1);

/**
 * Recover paginated archive pages when WordPress resolves them as 404.
 */
function psm_fix_static_page_pagination_404() {
    if (!is_404()) {
        return;
    }

    $match = psm_match_static_page_pagination_from_uri();

    if ($match['page_id'] <= 0 || $match['paged'] <= 0) {
        return;
    }

    $post = get_post($match['page_id']);

    if (!$post instanceof WP_Post) {
        return;
    }

    global $wp_query;

    $wp_query->posts             = array($post);
    $wp_query->post              = $post;
    $wp_query->post_count        = 1;
    $wp_query->queried_object    = $post;
    $wp_query->queried_object_id = (int) $post->ID;
    $wp_query->is_page           = true;
    $wp_query->is_singular       = true;
    $wp_query->is_404            = false;
    $wp_query->is_archive        = false;
    $wp_query->is_home           = false;

    set_query_var('page', $match['paged']);
    status_header(200);
}
add_action('template_redirect', 'psm_fix_static_page_pagination_404', 0);

/**
 * Prevent canonical redirects from breaking paginated archive URLs.
 *
 * @param string|false $redirect_url  Redirect URL.
 * @param string       $requested_url Requested URL.
 * @return string|false
 */
function psm_disable_paginated_archive_canonical_redirect($redirect_url, $requested_url) {
    unset($requested_url);

    $page_id = (int) get_queried_object_id();

    if ($page_id <= 0) {
        $match = psm_match_static_page_pagination_from_uri();
        $page_id = (int) $match['page_id'];
    }

    if ($page_id <= 0 || !in_array(get_page_template_slug($page_id), psm_get_paginated_archive_page_templates(), true)) {
        return $redirect_url;
    }

    if (psm_get_static_page_current($page_id) > 1) {
        return false;
    }

    return $redirect_url;
}
add_filter('redirect_canonical', 'psm_disable_paginated_archive_canonical_redirect', 10, 2);
