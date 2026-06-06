<?php
/**
 * Default ACF values for the Boat Park page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Boat Park page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_boat_park_page_default_value($value, $post_id, $field) {
    if (!psm_is_boat_park_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name      = isset($field['name']) ? $field['name'] : '';
    $banner    = psm_boat_park_inner_banner_defaults();
    $community = psm_boat_park_community_static();
    $facilities = psm_boat_park_facilities_static();
    $mooring   = psm_boat_park_mooring_static();

    $map = array(
        'inner_banner_kicker'           => $banner['kicker'],
        'inner_banner_title'            => $banner['title'],
        'inner_banner_ribbon'           => $banner['ribbon'],
        'inner_banner_intro'            => $banner['intro'],
        'boat_community_badge'          => $community['badge'],
        'boat_community_title'          => $community['title'],
        'boat_community_body'           => psm_boat_park_community_body_default_lines(),
        'boat_facilities_badge'         => $facilities['badge'],
        'boat_facilities_title'         => $facilities['title'],
        'boat_facilities_intro'         => $facilities['intro'],
        'boat_mooring_badge'            => $mooring['badge'],
        'boat_mooring_title'            => $mooring['title'],
        'boat_mooring_intro'            => $mooring['intro'],
        'boat_mooring_video_id'         => $mooring['video_id'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default facility cards repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_boat_park_facility_cards_default($value, $post_id, $field) {
    if (!psm_is_boat_park_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_boat_park_facility_cards_default_acf();
}

/**
 * Default mooring steps repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_boat_park_mooring_steps_default($value, $post_id, $field) {
    if (!psm_is_boat_park_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_boat_park_mooring_steps_default_acf();
}

$psm_boat_park_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'boat_community_badge',
    'boat_community_title',
    'boat_community_body',
    'boat_facilities_badge',
    'boat_facilities_title',
    'boat_facilities_intro',
    'boat_mooring_badge',
    'boat_mooring_title',
    'boat_mooring_intro',
    'boat_mooring_video_id',
);

foreach ($psm_boat_park_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_boat_park_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=boat_facility_cards', 'psm_acf_boat_park_facility_cards_default', 10, 3);
add_filter('acf/load_value/name=boat_mooring_steps', 'psm_acf_boat_park_mooring_steps_default', 10, 3);
