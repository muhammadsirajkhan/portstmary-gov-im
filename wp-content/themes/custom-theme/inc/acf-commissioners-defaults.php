<?php
/**
 * Default ACF values for the commissioners page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the commissioners page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_commissioners_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-your-commissioners.php' === get_page_template_slug($post_id);
}

/**
 * Apply commissioners page defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_commissioners_page_default_value($value, $post_id, $field) {
    if (!psm_is_commissioners_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name = isset($field['name']) ? $field['name'] : '';

    $banner   = psm_commissioners_inner_banner_defaults();
    $serving  = psm_commissioners_serving_defaults();
    $officers = psm_commissioners_officers_header_defaults();
    $hours    = psm_commissioners_hours_defaults();

    $map = array(
        'inner_banner_kicker'  => $banner['kicker'],
        'inner_banner_title'   => $banner['title'],
        'inner_banner_ribbon'  => $banner['ribbon'],
        'inner_banner_intro'   => $banner['intro'],
        'serving_badge'        => $serving['badge'],
        'serving_title'        => $serving['title'],
        'serving_intro'        => $serving['intro'],
        'serving_responsible'  => $serving['responsible'],
        'officers_badge'       => $officers['badge'],
        'officers_title'       => $officers['title'],
        'hours_badge'          => $hours['badge'],
        'hours_title'          => $hours['title'],
        'hours_note'           => $hours['note'],
        'serving_services'     => implode("\n", psm_commissioners_services_static()),
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

$psm_commissioners_acf_default_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'serving_badge',
    'serving_title',
    'serving_intro',
    'serving_responsible',
    'officers_badge',
    'officers_title',
    'hours_badge',
    'hours_title',
    'hours_note',
    'serving_services',
);

foreach ($psm_commissioners_acf_default_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_commissioners_page_default_value',
        10,
        3
    );
}
