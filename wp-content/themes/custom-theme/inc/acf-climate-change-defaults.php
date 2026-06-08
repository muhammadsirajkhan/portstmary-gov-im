<?php
/**
 * Default ACF values for the Climate Change page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Climate Change page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_climate_change_page_default_value($value, $post_id, $field) {
    if (!psm_is_climate_change_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name       = isset($field['name']) ? $field['name'] : '';
    $banner     = psm_climate_change_inner_banner_defaults();
    $commitment = psm_climate_change_commitment_defaults();

    $map = array(
        'inner_banner_kicker'            => $banner['kicker'],
        'inner_banner_title'             => $banner['title'],
        'inner_banner_ribbon'            => $banner['ribbon'],
        'inner_banner_intro'             => $banner['intro'],
        'climate_change_badge'           => $commitment['badge'],
        'climate_change_title'           => $commitment['title'],
        'climate_change_body'            => psm_climate_change_commitment_body_default_lines(),
        'climate_change_document_label'  => $commitment['document_label'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default section image when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @return mixed
 */
function psm_acf_climate_change_image_default($value, $post_id) {
    if (!psm_is_climate_change_page($post_id)) {
        return $value;
    }

    if ($value) {
        return $value;
    }

    return psm_climate_change_commitment_image_default();
}

$psm_climate_change_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'climate_change_badge',
    'climate_change_title',
    'climate_change_body',
    'climate_change_document_label',
);

foreach ($psm_climate_change_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_climate_change_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=climate_change_image', 'psm_acf_climate_change_image_default', 10, 2);
