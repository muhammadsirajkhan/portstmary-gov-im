<?php
/**
 * Default ACF values for the Jobs page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Jobs page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_jobs_page_default_value($value, $post_id, $field) {
    if (!psm_is_jobs_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name   = isset($field['name']) ? $field['name'] : '';
    $banner = psm_jobs_inner_banner_defaults();
    $work   = psm_jobs_work_with_us_static();
    $apply  = psm_jobs_apply_section_static();
    $header = psm_jobs_opportunities_header_static();

    $map = array(
        'inner_banner_kicker'   => $banner['kicker'],
        'inner_banner_title'    => $banner['title'],
        'inner_banner_ribbon'   => $banner['ribbon'],
        'inner_banner_intro'    => $banner['intro'],
        'work_badge'            => $work['badge'],
        'work_title'            => $work['title'],
        'work_lead'             => $work['lead'],
        'work_body'             => $work['body'],
        'work_benefits_intro'   => $work['benefits_intro'],
        'work_benefits'         => psm_jobs_work_benefits_default_lines(),
        'apply_badge'           => $apply['badge'],
        'apply_title'           => $apply['title'],
        'opportunities_badge'   => $header['badge'],
        'opportunities_title'   => $header['title'],
        'job_form_title'        => __('Apply for this Role', 'cmd-theme'),
        'job_form_intro'        => __(
            'Complete the form below to submit your application. Please attach your CV where requested.',
            'cmd-theme'
        ),
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default apply steps repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_jobs_apply_steps_default($value, $post_id, $field) {
    if (!psm_is_jobs_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_jobs_apply_steps_default_rows();
}

$psm_jobs_page_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'work_badge',
    'work_title',
    'work_lead',
    'work_body',
    'work_benefits_intro',
    'work_benefits',
    'apply_badge',
    'apply_title',
    'opportunities_badge',
    'opportunities_title',
    'job_form_title',
    'job_form_intro',
);

foreach ($psm_jobs_page_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_jobs_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=apply_steps', 'psm_acf_jobs_apply_steps_default', 10, 3);
