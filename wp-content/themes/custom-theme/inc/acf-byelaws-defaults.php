<?php
/**
 * Default ACF values for the Byelaws page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Byelaws page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_byelaws_page_default_value($value, $post_id, $field) {
    if (!psm_is_byelaws_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name     = isset($field['name']) ? $field['name'] : '';
    $banner   = psm_byelaws_inner_banner_defaults();
    $guidance = psm_byelaws_guidance_defaults();

    $map = array(
        'inner_banner_kicker' => $banner['kicker'],
        'inner_banner_title'  => $banner['title'],
        'inner_banner_ribbon' => $banner['ribbon'],
        'inner_banner_intro'  => $banner['intro'],
        'byelaws_badge'       => $guidance['badge'],
        'byelaws_title'       => $guidance['title'],
        'byelaws_subheading'  => $guidance['subheading'],
        'byelaws_body'        => psm_byelaws_guidance_body_default_lines(),
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default documents repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @return mixed
 */
function psm_acf_byelaws_documents_default($value, $post_id) {
    if (!psm_is_byelaws_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_byelaws_documents_default_rows();
}

$psm_byelaws_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'byelaws_badge',
    'byelaws_title',
    'byelaws_subheading',
    'byelaws_body',
);

foreach ($psm_byelaws_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_byelaws_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=byelaws_documents', 'psm_acf_byelaws_documents_default', 10, 2);
