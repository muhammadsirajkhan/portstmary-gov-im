<?php
/**
 * Public Amenities page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Public Amenities page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_public_amenities_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-public-amenities.php' === get_page_template_slug($post_id);
}

/**
 * Supporting Community Spaces section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     image: string,
 *     layout: string,
 *     badge: string,
 *     title: string,
 *     paragraphs: string[]
 * }
 */
function psm_get_public_amenities_intro_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_public_amenities_intro_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $image = psm_normalize_acf_image_url(get_field('amenities_intro_image', $page_id));
    if ('' !== $image) {
        $data['image'] = $image;
    }

    $layout = get_field('amenities_intro_layout', $page_id);
    if (is_string($layout) && in_array($layout, array('image-left', 'image-right'), true)) {
        $data['layout'] = $layout;
    }

    $badge = get_field('amenities_intro_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('amenities_intro_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('amenities_intro_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $paragraphs = psm_split_acf_lines($body);
        if (!empty($paragraphs)) {
            $data['paragraphs'] = $paragraphs;
        }
    }

    return $data;
}

/**
 * Community Spaces & Facilities section header from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string}
 */
function psm_get_public_amenities_facilities_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_public_amenities_facilities_header_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('amenities_facilities_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('amenities_facilities_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    return $data;
}

/**
 * Community Spaces & Facilities alternating rows from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, mixed>>
 */
function psm_get_amenities_facility_rows($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('amenities_facility_rows', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $items = array();

            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $title = isset($row['amenities_row_title']) ? trim((string) $row['amenities_row_title']) : '';
                if ('' === $title) {
                    continue;
                }

                $layout = isset($row['amenities_row_layout']) ? trim((string) $row['amenities_row_layout']) : '';
                if (!in_array($layout, array('card-left', 'card-right'), true)) {
                    $layout = 0 === (int) $index % 2 ? 'card-left' : 'card-right';
                }

                $image = '';
                if (isset($row['amenities_row_image'])) {
                    $image = psm_normalize_acf_image_url($row['amenities_row_image']);
                }

                $list_items = array();
                if (isset($row['amenities_row_benefits'])) {
                    $list_items = psm_split_acf_lines($row['amenities_row_benefits']);
                }

                $read_more = array(
                    'label' => __('Read More', 'cmd-theme'),
                    'url'   => '',
                );
                if (isset($row['amenities_row_button']) && is_array($row['amenities_row_button'])) {
                    $button = psm_normalize_acf_link_button(
                        $row['amenities_row_button'],
                        array(
                            'title' => __('Read More', 'cmd-theme'),
                            'url'   => '',
                        )
                    );
                    $read_more = array(
                        'label' => $button['title'] ?: __('Read More', 'cmd-theme'),
                        'url'   => $button['url'],
                    );
                }

                $slug = sanitize_title($title);
                if ('' === $slug) {
                    $slug = 'row-' . (int) $index;
                }

                $items[] = array(
                    'layout'     => $layout,
                    'title'      => $title,
                    'text'       => isset($row['amenities_row_text']) ? trim((string) $row['amenities_row_text']) : '',
                    'text_extra' => isset($row['amenities_row_text_extra']) ? trim((string) $row['amenities_row_text_extra']) : '',
                    'list_items' => $list_items,
                    'read_more'  => $read_more,
                    'image'      => $image,
                    'image_seed' => 'psm-amenities-' . $slug,
                );
            }

            if (!empty($items)) {
                return $items;
            }
        }
    }

    return psm_public_amenities_facility_rows_static();
}
