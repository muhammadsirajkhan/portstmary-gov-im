<?php
/**
 * Default ACF values for the refuse services page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply refuse services page defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_refuse_services_page_default_value($value, $post_id, $field) {
    if (!psm_is_refuse_services_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name     = isset($field['name']) ? $field['name'] : '';
    $defaults = psm_refuse_services_inner_banner_defaults();
    $map      = array(
        'inner_banner_kicker' => $defaults['kicker'],
        'inner_banner_title'  => $defaults['title'],
        'inner_banner_ribbon' => $defaults['ribbon'],
        'inner_banner_intro'  => $defaults['intro'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

$psm_refuse_services_acf_default_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
);

foreach ($psm_refuse_services_acf_default_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_refuse_services_page_default_value',
        10,
        3
    );
}
