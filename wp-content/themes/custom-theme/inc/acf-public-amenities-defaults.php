<?php
/**
 * Default ACF values for the Public Amenities page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Public Amenities page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_public_amenities_page_default_value($value, $post_id, $field) {
    if (!psm_is_public_amenities_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name   = isset($field['name']) ? $field['name'] : '';
    $banner = psm_public_amenities_inner_banner_defaults();
    $intro  = psm_public_amenities_intro_static();
    $header = psm_public_amenities_facilities_header_static();

    $map = array(
        'inner_banner_kicker'        => $banner['kicker'],
        'inner_banner_title'         => $banner['title'],
        'inner_banner_ribbon'        => $banner['ribbon'],
        'inner_banner_intro'         => $banner['intro'],
        'amenities_intro_layout'     => $intro['layout'],
        'amenities_intro_badge'      => $intro['badge'],
        'amenities_intro_title'      => $intro['title'],
        'amenities_intro_body'       => psm_public_amenities_intro_body_default_lines(),
        'amenities_facilities_badge' => $header['badge'],
        'amenities_facilities_title' => $header['title'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default facility rows repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_public_amenities_facility_rows_default($value, $post_id, $field) {
    if (!psm_is_public_amenities_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_public_amenities_facility_rows_default_acf();
}

$psm_public_amenities_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'amenities_intro_layout',
    'amenities_intro_badge',
    'amenities_intro_title',
    'amenities_intro_body',
    'amenities_facilities_badge',
    'amenities_facilities_title',
);

foreach ($psm_public_amenities_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_public_amenities_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=amenities_facility_rows', 'psm_acf_public_amenities_facility_rows_default', 10, 3);
