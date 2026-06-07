<?php
/**
 * Where to Eat page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Where to Eat page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_where_to_eat_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-where-to-eat.php' === get_page_template_slug($post_id);
}

/**
 * Places to Eat section header from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string}
 */
function psm_get_where_to_eat_places_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'badge' => '',
        'title' => '',
        'intro' => '',
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('where_to_eat_places_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('where_to_eat_places_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('where_to_eat_places_intro', $page_id);
    if (is_string($intro)) {
        $data['intro'] = trim($intro);
    }

    return $data;
}

/**
 * Dining place cards from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{title: string, location: string, phone: string, phone_href: string, image: string, image_seed: string}>
 */
function psm_get_where_to_eat_places($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('where_to_eat_places', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $places = array();

    foreach ($rows as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $title = isset($row['where_to_eat_place_title']) ? trim((string) $row['where_to_eat_place_title']) : '';
        if ('' === $title) {
            continue;
        }

        $location = isset($row['where_to_eat_place_location']) ? trim((string) $row['where_to_eat_place_location']) : '';
        $phone    = isset($row['where_to_eat_place_phone']) ? trim((string) $row['where_to_eat_place_phone']) : '';
        $image    = isset($row['where_to_eat_place_image']) ? psm_normalize_acf_image_url($row['where_to_eat_place_image']) : '';

        $places[] = array(
            'title'      => $title,
            'location'   => $location,
            'phone'      => $phone,
            'phone_href' => '' !== $phone ? psm_phone_href_from_display($phone) : '',
            'image'      => $image,
            'image_seed' => 'psm-where-to-eat-' . ( $index + 1 ),
        );
    }

    return $places;
}
