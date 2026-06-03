<?php
/**
 * News page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the News page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_news_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-news.php' === get_page_template_slug($post_id);
}

/**
 * Current pagination page for a static News page.
 *
 * @return int
 */
function psm_get_news_page_current() {
    $paged = (int) get_query_var('paged');
    if ($paged > 0) {
        return $paged;
    }

    $page = (int) get_query_var('page');
    return $page > 0 ? $page : 1;
}

/**
 * Archive section header from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string[]}
 */
function psm_get_news_page_archive_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_news_page_archive_header_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('archive_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('archive_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $intro_raw = get_field('archive_intro', $page_id);
    if (is_string($intro_raw) && '' !== trim($intro_raw)) {
        $intro = array_values(
            array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n\s*\r?\n/', $intro_raw))
            )
        );
        if (!empty($intro)) {
            $data['intro'] = $intro;
        }
    }

    return $data;
}

/**
 * Image badge label for archive cards.
 *
 * @param int $page_id Page ID.
 * @return string
 */
function psm_get_news_page_image_badge($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $badge = psm_news_page_image_badge_default();

    if ($page_id && function_exists('get_field')) {
        $acf_badge = get_field('archive_image_badge', $page_id);
        if (is_string($acf_badge) && '' !== trim($acf_badge)) {
            $badge = trim($acf_badge);
        }
    }

    return $badge;
}

/**
 * Query published news posts for the News page grid.
 *
 * @param int $page_id Page ID.
 * @param int $paged   Current page.
 * @return WP_Query
 */
function psm_get_news_page_query($page_id = 0, $paged = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($paged <= 0) {
        $paged = psm_get_news_page_current();
    }

    return new WP_Query(
        array(
            'post_type'      => 'psm_news',
            'post_status'    => 'publish',
            'posts_per_page' => psm_news_page_posts_per_page(),
            'paged'          => max(1, (int) $paged),
            'orderby'        => 'date',
            'order'          => 'DESC',
        )
    );
}

/**
 * Build pagination URL for a static page.
 *
 * @param int $page_num Page number.
 * @param int $post_id  Page ID.
 * @return string
 */
function psm_get_paged_page_link($page_num, $post_id = 0) {
    $page_num = (int) $page_num;
    $post_id  = $post_id ?: (int) get_queried_object_id();
    $url      = get_permalink($post_id) ?: home_url('/');

    if ($page_num <= 1) {
        return $url;
    }

    return trailingslashit($url) . user_trailingslashit($page_num, 'page');
}

/**
 * Build visible pagination page numbers for the design pattern.
 *
 * @param int $current Current page.
 * @param int $total   Total pages.
 * @return array<int|string>
 */
function psm_build_pagination_pages($current, $total) {
    $current = max(1, (int) $current);
    $total   = max(1, (int) $total);

    if ($total <= 1) {
        return array();
    }

    if ($total <= 4) {
        return range(1, $total);
    }

    if ($current <= 2) {
        $pages = array(1, 2, 3);
        if ($total > 3) {
            $pages[] = 'ellipsis';
        }
        return $pages;
    }

    if ($current >= $total - 1) {
        return array(1, 'ellipsis', $total - 2, $total - 1, $total);
    }

    return array(1, 'ellipsis', $current - 1, $current, $current + 1, 'ellipsis', $total);
}
