<?php
/**
 * Default ACF values for the minutes page (frontend + admin when post meta is empty).
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply minutes page defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_minutes_page_default_value($value, $post_id, $field) {
    if (!psm_is_minutes_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name     = isset($field['name']) ? $field['name'] : '';
    $banner   = psm_minutes_inner_banner_defaults();
    $section  = psm_minutes_section_defaults();
    $defaults = array(
        'inner_banner_kicker' => $banner['kicker'],
        'inner_banner_title'  => $banner['title'],
        'inner_banner_ribbon' => $banner['ribbon'],
        'minutes_badge'       => $section['badge'],
        'minutes_title'       => $section['title'],
        'minutes_intro'       => $section['intro'],
        'minutes_viewer_url'  => $section['viewer_url'],
    );

    return isset($defaults[ $name ]) ? $defaults[ $name ] : $value;
}

$psm_minutes_acf_default_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'minutes_badge',
    'minutes_title',
    'minutes_intro',
    'minutes_viewer_url',
);

foreach ($psm_minutes_acf_default_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_minutes_page_default_value',
        10,
        3
    );
}
