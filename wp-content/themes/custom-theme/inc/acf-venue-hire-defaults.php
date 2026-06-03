<?php
/**
 * Default ACF values for the venue hire page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the venue hire page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_venue_hire_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-venue-hire.php' === get_page_template_slug($post_id);
}

/**
 * Apply venue hire page defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_venue_hire_page_default_value($value, $post_id, $field) {
    if (!psm_is_venue_hire_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name     = isset($field['name']) ? $field['name'] : '';
    $defaults = psm_venue_hire_inner_banner_defaults();
    $map      = array(
        'inner_banner_kicker' => $defaults['kicker'],
        'inner_banner_title'  => $defaults['title'],
        'inner_banner_ribbon' => $defaults['ribbon'],
        'inner_banner_intro'  => $defaults['intro'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

$psm_venue_hire_acf_default_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
);

foreach ($psm_venue_hire_acf_default_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_venue_hire_page_default_value',
        10,
        3
    );
}
