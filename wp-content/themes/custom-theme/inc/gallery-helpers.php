<?php
/**
 * Gallery page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Gallery page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_gallery_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-gallery.php' === get_page_template_slug($post_id);
}

/**
 * Capturing Community Life section from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{image: string, badge: string, title: string, paragraphs: string[]}
 */
function psm_get_gallery_community_life_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'image'      => '',
        'badge'      => '',
        'title'      => '',
        'paragraphs' => array(),
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $data['image'] = psm_normalize_acf_image_url(get_field('gallery_community_image', $page_id));

    $badge = get_field('gallery_community_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('gallery_community_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('gallery_community_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $data['paragraphs'] = psm_split_acf_lines($body);
    }

    return $data;
}

/**
 * Featured Gallery section header from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string}
 */
function psm_get_gallery_featured_header($page_id = 0) {
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

    $badge = get_field('gallery_featured_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('gallery_featured_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('gallery_featured_intro', $page_id);
    if (is_string($intro)) {
        $data['intro'] = trim($intro);
    }

    return $data;
}

/**
 * Featured gallery items from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<string, array{image: string, image_seed: string, alt: string, size: string}>
 */
function psm_get_gallery_featured_items($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $items = psm_gallery_featured_items_empty();

    if (!$page_id || !function_exists('get_field')) {
        return $items;
    }

    $rows = get_field('gallery_featured_images', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return $items;
    }

    $keys = psm_gallery_featured_image_slot_keys();

    foreach ($rows as $index => $row) {
        if (!isset($keys[ $index ]) || !is_array($row)) {
            continue;
        }

        $key = $keys[ $index ];
        $url = isset($row['gallery_featured_image']) ? psm_normalize_acf_image_url($row['gallery_featured_image']) : '';

        if ('' !== $url) {
            $items[ $key ]['image'] = $url;
        }
    }

    return $items;
}

/**
 * Featured gallery columns from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{items: array<int, array<string, mixed>>}>
 */
function psm_get_gallery_featured_columns($page_id = 0) {
    return psm_filter_gallery_featured_columns(
        psm_build_gallery_featured_columns(psm_get_gallery_featured_items($page_id))
    );
}
