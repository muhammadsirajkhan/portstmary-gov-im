<?php
/**
 * Events page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Events page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_events_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-events.php' === get_page_template_slug($post_id);
}

/**
 * Current pagination page for a static Events page.
 *
 * @param int $page_id Optional page ID.
 * @return int
 */
function psm_get_events_page_current($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    return psm_get_static_page_current($page_id);
}

/**
 * Archive section header from ACF or defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string[]}
 */
function psm_get_events_page_archive_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_events_page_archive_header_static();

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
 * Query published events for the Events page list.
 *
 * @param int $page_id Page ID.
 * @param int $paged   Current page.
 * @return WP_Query
 */
function psm_get_events_page_query($page_id = 0, $paged = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($paged <= 0) {
        $paged = psm_get_events_page_current($page_id);
    }

    return new WP_Query(
        array(
            'post_type'      => 'psm_event',
            'post_status'    => 'publish',
            'posts_per_page' => psm_events_page_posts_per_page(),
            'paged'          => max(1, (int) $paged),
            'meta_key'       => 'event_date',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
        )
    );
}

/**
 * Events page URL if a page uses the Events template.
 *
 * @return string
 */
function psm_get_events_page_url() {
    $pages = get_posts(
        array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'meta_key'       => '_wp_page_template',
            'meta_value'     => 'page-events.php',
            'posts_per_page' => 1,
            'fields'         => 'ids',
        )
    );

    if (empty($pages)) {
        return '';
    }

    return get_permalink((int) $pages[0]) ?: '';
}
