<?php
/**
 * Default ACF values for the remembrance page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the remembrance page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_remembrance_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-remembrance.php' === get_page_template_slug($post_id);
}

/**
 * Default inner banner args for the remembrance page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_remembrance_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Our Remembrance', 'cmd-theme'),
        'ribbon' => __('Honouring Service & Sacrifice', 'cmd-theme'),
        'intro'  => __(
            'We remember those who served and those who gave their lives, and we honour their sacrifice with dignity and respect.',
            'cmd-theme'
        ),
    );
}

/**
 * Apply remembrance page defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_remembrance_page_default_value($value, $post_id, $field) {
    if (!psm_is_remembrance_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name = isset($field['name']) ? $field['name'] : '';

    $banner = psm_remembrance_inner_banner_defaults();
    $respect = psm_remembrance_respect_defaults();
    $honour  = psm_remembrance_honour_header_defaults();

    $text_fields = array(
        'inner_banner_kicker'    => $banner['kicker'],
        'inner_banner_title'     => $banner['title'],
        'inner_banner_ribbon'    => $banner['ribbon'],
        'inner_banner_intro'     => $banner['intro'],
        'respect_badge'          => $respect['badge'],
        'respect_title'          => $respect['title'],
        'respect_signature'      => $respect['signature'],
        'honour_badge'           => $honour['badge'],
        'honour_title'           => $honour['title'],
    );

    if (isset($text_fields[ $name ])) {
        return $text_fields[ $name ];
    }

    if ('respect_intro' === $name) {
        return implode("\n\n", $respect['intro']);
    }

    if ('respect_prose' === $name) {
        return implode("\n\n", $respect['prose']);
    }

    return $value;
}

$psm_remembrance_acf_default_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'respect_badge',
    'respect_title',
    'respect_intro',
    'respect_signature',
    'respect_prose',
    'honour_badge',
    'honour_title',
);

foreach ($psm_remembrance_acf_default_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_remembrance_page_default_value',
        10,
        3
    );
}
