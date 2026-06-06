<?php
/**
 * Default ACF values for the Consultations page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Consultations page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_consultations_page_default_value($value, $post_id, $field) {
    if (!psm_is_consultations_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name       = isset($field['name']) ? $field['name'] : '';
    $banner     = psm_consultations_inner_banner_defaults();
    $engagement = psm_consultation_engagement_static();
    $current    = psm_consultation_current_header_static();
    $feedback   = psm_consultation_feedback_header_static();

    $map = array(
        'inner_banner_kicker'       => $banner['kicker'],
        'inner_banner_title'        => $banner['title'],
        'inner_banner_ribbon'       => $banner['ribbon'],
        'inner_banner_intro'        => $banner['intro'],
        'consult_engagement_badge'  => $engagement['badge'],
        'consult_engagement_title'  => $engagement['title'],
        'consult_engagement_body'   => psm_consultation_engagement_body_default_lines(),
        'consult_current_badge'     => $current['badge'],
        'consult_current_title'     => $current['title'],
        'consult_current_intro'     => $current['intro'],
        'consult_feedback_badge'    => $feedback['badge'],
        'consult_feedback_title'    => $feedback['title'],
        'consult_feedback_intro'    => $feedback['intro'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default current consultation cards repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_consultation_current_cards_default($value, $post_id, $field) {
    if (!psm_is_consultations_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_consultation_current_cards_default_acf();
}

/**
 * Default feedback cards repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_consultation_feedback_cards_default($value, $post_id, $field) {
    if (!psm_is_consultations_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_consultation_feedback_cards_default_acf();
}

$psm_consultations_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'consult_engagement_badge',
    'consult_engagement_title',
    'consult_engagement_body',
    'consult_current_badge',
    'consult_current_title',
    'consult_current_intro',
    'consult_feedback_badge',
    'consult_feedback_title',
    'consult_feedback_intro',
);

foreach ($psm_consultations_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_consultations_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=consult_current_cards', 'psm_acf_consultation_current_cards_default', 10, 3);
add_filter('acf/load_value/name=consult_feedback_cards', 'psm_acf_consultation_feedback_cards_default', 10, 3);
