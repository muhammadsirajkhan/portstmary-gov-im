<?php
/**
 * Inner banner ACF merge helpers.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Merge inner banner ACF fields into template args (ACF wins when non-empty).
 *
 * @param array $args     Template args passed to inner-banner.php.
 * @param int   $page_id  Page ID. Uses queried object when 0.
 * @return array
 */
function psm_merge_inner_banner_acf(array $args, $page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return psm_apply_inner_banner_heading_id($args, $page_id);
    }

    $map = array(
        'kicker' => 'inner_banner_kicker',
        'title'  => 'inner_banner_title',
        'ribbon' => 'inner_banner_ribbon',
        'intro'  => 'inner_banner_intro',
        'image'  => 'inner_banner_image',
    );

    foreach ($map as $arg_key => $field_name) {
        $value = get_field($field_name, $page_id);

        if ('image' === $arg_key) {
            $value = psm_normalize_acf_image_url($value);
        } else {
            $value = trim((string) $value);
        }

        if ('' !== $value) {
            $args[$arg_key] = $value;
        }
    }

    return psm_apply_inner_banner_heading_id($args, $page_id);
}

/**
 * Auto-generate heading_id when not provided.
 *
 * @param array $args     Banner args.
 * @param int   $page_id  Page ID.
 * @return array
 */
function psm_apply_inner_banner_heading_id(array $args, $page_id = 0) {
    if (!empty($args['heading_id'])) {
        return $args;
    }

    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id) {
        return $args;
    }

    $slug = get_post_field('post_name', $page_id);
    if (is_string($slug) && '' !== $slug) {
        $args['heading_id'] = 'psm-' . sanitize_html_class($slug) . '-page-title';
    }

    return $args;
}

/**
 * Build tel: href from a display phone number.
 *
 * @param string $phone Display phone number.
 * @return string
 */
function psm_phone_href_from_display($phone) {
    $digits = preg_replace('/\D+/', '', (string) $phone);
    if ('' === $digits) {
        return '';
    }

    if ('0' === $digits[0]) {
        $digits = '44' . substr($digits, 1);
    }

    return 'tel:+' . $digits;
}
