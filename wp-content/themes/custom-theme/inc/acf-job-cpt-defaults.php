<?php
/**
 * Default ACF values for job posts.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply job CPT field defaults when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_job_cpt_default_value($value, $post_id, $field) {
    if ('psm_job' !== get_post_type($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name = isset($field['name']) ? $field['name'] : '';

    $map = array(
        'job_location' => __('Port St Mary, Isle of Man, IM9 5DA', 'cmd-theme'),
        'job_category' => __('Administration & Office Support', 'cmd-theme'),
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

foreach (array('job_location', 'job_category') as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_job_cpt_default_value',
        10,
        3
    );
}
