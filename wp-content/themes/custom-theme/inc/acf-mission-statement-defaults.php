<?php
/**
 * Default ACF values for the Board Mission Statement page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Mission Statement page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_mission_statement_page_default_value($value, $post_id, $field) {
    if (!psm_is_mission_statement_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name       = isset($field['name']) ? $field['name'] : '';
    $banner     = psm_mission_statement_inner_banner_defaults();
    $commitment = psm_mission_statement_commitment_defaults();

    $map = array(
        'inner_banner_kicker'              => $banner['kicker'],
        'inner_banner_title'               => $banner['title'],
        'inner_banner_ribbon'              => $banner['ribbon'],
        'inner_banner_intro'               => $banner['intro'],
        'mission_statement_badge'          => $commitment['badge'],
        'mission_statement_title'          => $commitment['title'],
        'mission_statement_body'           => psm_mission_statement_commitment_body_default_lines(),
        'mission_statement_document_label' => $commitment['document_label'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

$psm_mission_statement_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'mission_statement_badge',
    'mission_statement_title',
    'mission_statement_body',
    'mission_statement_document_label',
);

foreach ($psm_mission_statement_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_mission_statement_page_default_value',
        10,
        3
    );
}
