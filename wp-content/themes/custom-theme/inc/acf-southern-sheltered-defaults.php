<?php
/**
 * Default ACF values for the Southern Sheltered page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Southern Sheltered page defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_southern_sheltered_page_default_value($value, $post_id, $field) {
    if (!psm_is_southern_sheltered_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name     = isset($field['name']) ? $field['name'] : '';
    $banner   = psm_southern_sheltered_inner_banner_defaults();
    $tenders  = psm_southern_sheltered_tenders_static();

    $map = array(
        'inner_banner_kicker' => $banner['kicker'],
        'inner_banner_title'  => $banner['title'],
        'inner_banner_ribbon' => $banner['ribbon'],
        'inner_banner_intro'  => $banner['intro'],
        'tenders_badge'       => $tenders['badge'],
        'tenders_title'       => $tenders['title'],
        'tenders_lead'        => $tenders['lead'],
        'tenders_body'        => $tenders['body'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default tenders download button when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_southern_sheltered_tenders_button_default($value, $post_id, $field) {
    if (!psm_is_southern_sheltered_page($post_id)) {
        return $value;
    }

    if (!empty($value) && is_array($value) && !empty($value['url'])) {
        return $value;
    }

    return psm_southern_sheltered_tenders_static()['button'];
}

$psm_southern_sheltered_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'tenders_badge',
    'tenders_title',
    'tenders_lead',
    'tenders_body',
);

foreach ($psm_southern_sheltered_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_southern_sheltered_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=tenders_button', 'psm_acf_southern_sheltered_tenders_button_default', 10, 3);
