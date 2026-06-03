<?php
/**
 * Default ACF values for the home hero section.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply home hero text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_home_hero_default_value($value, $post_id, $field) {
    if (!psm_is_home_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name = isset($field['name']) ? $field['name'] : '';
    $bg   = psm_hero_background_static();

    $map = array(
        'hero_side_label' => $bg['side_label'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default hero link buttons in the admin when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_home_hero_default_link($value, $post_id, $field) {
    if (!psm_is_home_page($post_id)) {
        return $value;
    }

    if (!empty($value) && is_array($value) && !empty($value['url'])) {
        return $value;
    }

    $buttons = psm_hero_buttons_static();
    $name    = isset($field['name']) ? $field['name'] : '';

    if ('hero_primary_button' === $name) {
        return $buttons['primary'];
    }

    if ('hero_secondary_button' === $name) {
        return $buttons['secondary'];
    }

    return $value;
}

$psm_home_hero_text_fields = array(
    'hero_side_label',
);

foreach ($psm_home_hero_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_home_hero_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=hero_primary_button', 'psm_acf_home_hero_default_link', 10, 3);
add_filter('acf/load_value/name=hero_secondary_button', 'psm_acf_home_hero_default_link', 10, 3);
