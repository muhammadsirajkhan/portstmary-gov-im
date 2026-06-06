<?php
/**
 * Boat Park page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Boat Park page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_boat_park_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-boat-park.php' === get_page_template_slug($post_id);
}

/**
 * Supporting Community section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     badge: string,
 *     title: string,
 *     paragraphs: string[],
 *     image_harbor: string,
 *     image_lighthouse: string
 * }
 */
function psm_get_boat_park_community_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_boat_park_community_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('boat_community_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('boat_community_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('boat_community_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $paragraphs = psm_split_acf_lines($body);
        if (!empty($paragraphs)) {
            $data['paragraphs'] = $paragraphs;
        }
    }

    $harbor = psm_normalize_acf_image_url(get_field('boat_community_image_harbor', $page_id));
    if ('' !== $harbor) {
        $data['image_harbor'] = $harbor;
    }

    $lighthouse = psm_normalize_acf_image_url(get_field('boat_community_image_lighthouse', $page_id));
    if ('' !== $lighthouse) {
        $data['image_lighthouse'] = $lighthouse;
    }

    return $data;
}

/**
 * Boat Park Facilities section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     badge: string,
 *     title: string,
 *     intro: string,
 *     feature_image: string,
 *     cards: array<int, array{icon: string, icon_image: string, title: string, text: string}>
 * }
 */
function psm_get_boat_park_facilities_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_boat_park_facilities_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('boat_facilities_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('boat_facilities_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('boat_facilities_intro', $page_id);
    if (is_string($intro) && '' !== trim($intro)) {
        $data['intro'] = trim($intro);
    }

    $feature = psm_normalize_acf_image_url(get_field('boat_facilities_feature_image', $page_id));
    if ('' !== $feature) {
        $data['feature_image'] = $feature;
    }

    $rows = get_field('boat_facility_cards', $page_id);
    if (is_array($rows) && !empty($rows)) {
        $cards        = array();
        $static_cards = psm_boat_park_facilities_static()['cards'];
        $fallbacks    = psm_boat_park_facility_icon_keys();

        foreach ($rows as $index => $row) {
            if (!is_array($row)) {
                continue;
            }

            $title = isset($row['facility_card_title']) ? trim((string) $row['facility_card_title']) : '';
            if ('' === $title) {
                continue;
            }

            $icon_image = '';
            if (isset($row['facility_card_icon'])) {
                $icon_image = psm_normalize_acf_image_url($row['facility_card_icon']);
            }

            $icon = isset($static_cards[ $index ]['icon']) ? $static_cards[ $index ]['icon'] : '';
            if ('' === $icon && isset($fallbacks[ $index ])) {
                $icon = $fallbacks[ $index ];
            }
            if ('' === $icon) {
                $icon = 'mooring';
            }

            $cards[] = array(
                'icon'       => $icon,
                'icon_image' => $icon_image,
                'title'      => $title,
                'text'       => isset($row['facility_card_text']) ? trim((string) $row['facility_card_text']) : '',
            );
        }

        if (!empty($cards)) {
            $data['cards'] = $cards;
        }
    }

    return $data;
}

/**
 * Mooring Applications section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     badge: string,
 *     title: string,
 *     intro: string,
 *     image: string,
 *     video_id: string,
 *     steps: array<int, array{number: string, icon: string, icon_image: string, title: string, text: string}>
 * }
 */
function psm_get_boat_park_mooring_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_boat_park_mooring_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('boat_mooring_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('boat_mooring_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('boat_mooring_intro', $page_id);
    if (is_string($intro) && '' !== trim($intro)) {
        $data['intro'] = trim($intro);
    }

    $image = psm_normalize_acf_image_url(get_field('boat_mooring_image', $page_id));
    if ('' !== $image) {
        $data['image'] = $image;
    }

    $video_id = get_field('boat_mooring_video_id', $page_id);
    if (is_string($video_id) && '' !== trim($video_id)) {
        $data['video_id'] = trim($video_id);
    }

    $rows = get_field('boat_mooring_steps', $page_id);
    if (is_array($rows) && !empty($rows)) {
        $steps        = array();
        $static_steps = psm_boat_park_mooring_static()['steps'];
        $fallbacks    = psm_boat_park_mooring_step_icon_keys();

        foreach ($rows as $index => $row) {
            if (!is_array($row)) {
                continue;
            }

            $title = isset($row['mooring_step_title']) ? trim((string) $row['mooring_step_title']) : '';
            if ('' === $title) {
                continue;
            }

            $icon_image = '';
            if (isset($row['mooring_step_icon'])) {
                $icon_image = psm_normalize_acf_image_url($row['mooring_step_icon']);
            }

            $icon = isset($static_steps[ $index ]['icon']) ? $static_steps[ $index ]['icon'] : '';
            if ('' === $icon && isset($fallbacks[ $index ])) {
                $icon = $fallbacks[ $index ];
            }
            if ('' === $icon) {
                $icon = 'submit';
            }

            $steps[] = array(
                'number'     => str_pad((string) ((int) $index + 1), 2, '0', STR_PAD_LEFT),
                'icon'       => $icon,
                'icon_image' => $icon_image,
                'title'      => $title,
                'text'       => isset($row['mooring_step_text']) ? trim((string) $row['mooring_step_text']) : '',
            );
        }

        if (!empty($steps)) {
            $data['steps'] = $steps;
        }
    }

    return $data;
}
