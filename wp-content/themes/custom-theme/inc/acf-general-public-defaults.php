<?php
/**
 * Default ACF values for the general public page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the general public page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_general_public_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-general-public.php' === get_page_template_slug($post_id);
}

/**
 * Apply general public page defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_general_public_page_default_value($value, $post_id, $field) {
    if (!psm_is_general_public_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name = isset($field['name']) ? $field['name'] : '';

    $banner = psm_general_public_inner_banner_defaults();
    $housing = psm_general_public_housing_section_defaults();
    $applying = psm_general_public_applying_section_defaults();

    $housing_intro = implode(
        "\n\n",
        array_map(
            static function ($paragraph) {
                return wp_strip_all_tags($paragraph);
            },
            $housing['paragraphs']
        )
    );

    $applying_intro = implode(
        "\n\n",
        array_map(
            static function ($paragraph) {
                return wp_strip_all_tags($paragraph);
            },
            $applying['intro']
        )
    );

    $map = array(
        'inner_banner_kicker'  => $banner['kicker'],
        'inner_banner_title'   => $banner['title'],
        'inner_banner_ribbon'  => $banner['ribbon'],
        'inner_banner_intro'   => $banner['intro'],
        'housing_badge'        => $housing['badge'],
        'housing_title'        => $housing['title'],
        'housing_intro'        => $housing_intro,
        'applying_badge'       => $applying['badge'],
        'applying_title'       => $applying['title'],
        'applying_intro'       => $applying_intro,
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

$psm_general_public_acf_default_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'housing_badge',
    'housing_title',
    'housing_intro',
    'applying_badge',
    'applying_title',
    'applying_intro',
);

foreach ($psm_general_public_acf_default_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_general_public_page_default_value',
        10,
        3
    );
}
