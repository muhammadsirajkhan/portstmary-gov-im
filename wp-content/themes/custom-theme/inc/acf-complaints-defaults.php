<?php
/**
 * Default ACF values for the Complaints page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Complaints page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_complaints_page_default_value($value, $post_id, $field) {
    if (!psm_is_complaints_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name   = isset($field['name']) ? $field['name'] : '';
    $banner = psm_complaints_inner_banner_defaults();
    $how_to = psm_complaints_how_to_defaults();

    $map = array(
        'inner_banner_kicker' => $banner['kicker'],
        'inner_banner_title'  => $banner['title'],
        'inner_banner_ribbon' => $banner['ribbon'],
        'inner_banner_intro'  => $banner['intro'],
        'complaints_badge'    => $how_to['badge'],
        'complaints_title'    => $how_to['title'],
        'complaints_body'     => psm_complaints_how_to_body_default_lines(),
        'complaints_phone'    => $how_to['phone'],
        'complaints_email'    => $how_to['email'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default complaints button link when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @return mixed
 */
function psm_acf_complaints_button_default($value, $post_id) {
    if (!psm_is_complaints_page($post_id)) {
        return $value;
    }

    if (is_array($value) && ('' !== trim((string) ($value['title'] ?? '')) || '' !== trim((string) ($value['url'] ?? '')))) {
        return $value;
    }

    return psm_complaints_how_to_defaults()['button'];
}

$psm_complaints_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'complaints_badge',
    'complaints_title',
    'complaints_body',
    'complaints_phone',
    'complaints_email',
);

foreach ($psm_complaints_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_complaints_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=complaints_button', 'psm_acf_complaints_button_default', 10, 2);
