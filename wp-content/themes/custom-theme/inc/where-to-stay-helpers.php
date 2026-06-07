<?php
/**
 * Where to Stay page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Where to Stay page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_where_to_stay_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-where-to-stay.php' === get_page_template_slug($post_id);
}

/**
 * Build a website or email link href.
 *
 * @param string $value Display URL or email.
 * @return string
 */
function psm_accommodation_contact_href($value) {
    $value = trim((string) $value);
    if ('' === $value) {
        return '';
    }

    if (false !== strpos($value, '@')) {
        return 'mailto:' . $value;
    }

    if (preg_match('/^https?:\/\//i', $value)) {
        return $value;
    }

    return 'https://' . ltrim($value, '/');
}

/**
 * Featured Places to Stay section header from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string, category: string}
 */
function psm_get_where_to_stay_featured_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'badge'    => '',
        'title'    => '',
        'intro'    => '',
        'category' => '',
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('where_to_stay_featured_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('where_to_stay_featured_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('where_to_stay_featured_intro', $page_id);
    if (is_string($intro)) {
        $data['intro'] = trim($intro);
    }

    $category = get_field('where_to_stay_featured_category', $page_id);
    if (is_string($category)) {
        $data['category'] = trim($category);
    }

    return $data;
}

/**
 * Accommodation cards from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, string>>
 */
function psm_get_where_to_stay_accommodations($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('where_to_stay_accommodations', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $items = array();

    foreach ($rows as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $title = isset($row['where_to_stay_accommodation_title']) ? trim((string) $row['where_to_stay_accommodation_title']) : '';
        if ('' === $title) {
            continue;
        }

        $location = isset($row['where_to_stay_accommodation_location']) ? trim((string) $row['where_to_stay_accommodation_location']) : '';
        $phone    = isset($row['where_to_stay_accommodation_phone']) ? trim((string) $row['where_to_stay_accommodation_phone']) : '';
        $contact  = isset($row['where_to_stay_accommodation_contact']) ? trim((string) $row['where_to_stay_accommodation_contact']) : '';
        $image    = isset($row['where_to_stay_accommodation_image']) ? psm_normalize_acf_image_url($row['where_to_stay_accommodation_image']) : '';

        $contact_href = psm_accommodation_contact_href($contact);

        $read_more_url = '';
        if (isset($row['where_to_stay_accommodation_link']) && is_array($row['where_to_stay_accommodation_link'])) {
            $link = psm_normalize_acf_link_button($row['where_to_stay_accommodation_link']);
            $read_more_url = trim((string) ($link['url'] ?? ''));
        }

        $items[] = array(
            'title'          => $title,
            'location'       => $location,
            'phone'          => $phone,
            'phone_href'     => '' !== $phone ? psm_phone_href_from_display($phone) : '',
            'contact'        => $contact,
            'contact_href'   => $contact_href,
            'read_more_url'  => $read_more_url,
            'image'          => $image,
            'image_seed'     => 'psm-where-to-stay-' . ( $index + 1 ),
        );
    }

    return $items;
}
