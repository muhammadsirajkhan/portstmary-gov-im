<?php
/**
 * Default ACF values for the News page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply News page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_news_page_default_value($value, $post_id, $field) {
    if (!psm_is_news_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name    = isset($field['name']) ? $field['name'] : '';
    $banner  = psm_news_page_inner_banner_defaults();
    $archive = psm_news_page_archive_header_static();

    $intro = implode("\n\n", $archive['intro']);

    $map = array(
        'inner_banner_kicker'  => $banner['kicker'],
        'inner_banner_title'   => $banner['title'],
        'inner_banner_ribbon'  => $banner['ribbon'],
        'inner_banner_intro'   => $banner['intro'],
        'archive_badge'        => $archive['badge'],
        'archive_title'        => $archive['title'],
        'archive_intro'        => $intro,
        'archive_image_badge'  => psm_news_page_image_badge_default(),
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

$psm_news_page_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'archive_badge',
    'archive_title',
    'archive_intro',
    'archive_image_badge',
);

foreach ($psm_news_page_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_news_page_default_value',
        10,
        3
    );
}
