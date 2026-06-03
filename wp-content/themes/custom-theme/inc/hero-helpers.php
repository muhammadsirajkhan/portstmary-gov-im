<?php
/**
 * Home hero section helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the home page template.
 *
 * @param int $page_id Post ID.
 * @return bool
 */
function psm_is_home_page($page_id = 0) {
    $page_id = (int) $page_id;
    if ($page_id <= 0) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id <= 0) {
        return false;
    }

    return 'home.php' === get_page_template_slug($page_id);
}

/**
 * Resolve home page ID (static front page or home template).
 *
 * @return int
 */
function psm_get_home_page_id() {
    $page_id = (int) get_queried_object_id();

    if (!$page_id && is_front_page()) {
        $page_id = (int) get_option('page_on_front');
    }

    return $page_id;
}

/**
 * Normalize an ACF link field to button args.
 *
 * @param mixed  $link     ACF link value.
 * @param array  $fallback Fallback button args.
 * @return array{title: string, url: string, target: string}
 */
function psm_normalize_acf_link_button($link, array $fallback = array()) {
    $button = wp_parse_args(
        $fallback,
        array(
            'title'  => '',
            'url'    => '',
            'target' => '',
        )
    );

    if (!is_array($link)) {
        return $button;
    }

    if (!empty($link['url'])) {
        $button['url'] = trim((string) $link['url']);
    }

    if (!empty($link['title'])) {
        $button['title'] = trim((string) $link['title']);
    }

    if (!empty($link['target'])) {
        $button['target'] = trim((string) $link['target']);
    }

    return $button;
}

/**
 * Hero section data from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     background: string,
 *     background_alt: string,
 *     side_label: string,
 *     slides: array<int, array{kicker: string, title_1: string, title_2: string, ribbon: string, intro: string}>,
 *     primary_button: array{title: string, url: string, target: string},
 *     secondary_button: array{title: string, url: string, target: string}
 * }
 */
function psm_get_hero_section($page_id = 0) {
    $page_id   = $page_id ? (int) $page_id : psm_get_home_page_id();
    $bg_static = psm_hero_background_static();
    $buttons   = psm_hero_buttons_static();
    $slides    = psm_hero_slides_static();

    $data = array(
        'background'       => $bg_static['background'],
        'background_alt'   => $bg_static['background_alt'],
        'side_label'       => $bg_static['side_label'],
        'slides'           => $slides,
        'primary_button'   => $buttons['primary'],
        'secondary_button' => $buttons['secondary'],
    );

    if (!$page_id || !function_exists('get_field')) {
        return psm_finalize_hero_section($data);
    }

    $image = get_field('hero_background_image', $page_id);
    if ($image) {
        $image_url = psm_normalize_acf_image_url($image);
        if ('' !== $image_url) {
            $data['background'] = $image_url;
        }
    }

    $side_label = get_field('hero_side_label', $page_id);
    if (is_string($side_label) && '' !== trim($side_label)) {
        $data['side_label'] = trim($side_label);
    }

    $data['primary_button']   = psm_normalize_acf_link_button(
        get_field('hero_primary_button', $page_id),
        $buttons['primary']
    );
    $data['secondary_button'] = psm_normalize_acf_link_button(
        get_field('hero_secondary_button', $page_id),
        $buttons['secondary']
    );

    $rows = get_field('hero_slides', $page_id);
    if (is_array($rows) && !empty($rows)) {
        $static = psm_hero_slides_static();
        $items  = array();

        foreach ($rows as $index => $row) {
            if (!is_array($row)) {
                continue;
            }

            $title_1 = isset($row['slide_title_1']) ? trim((string) $row['slide_title_1']) : '';
            if ('' === $title_1) {
                continue;
            }

            $fallback = isset($static[ $index ]) ? $static[ $index ] : array();

            $kicker = isset($row['slide_kicker']) ? trim((string) $row['slide_kicker']) : '';
            $title_2 = isset($row['slide_title_2']) ? trim((string) $row['slide_title_2']) : '';
            $ribbon = isset($row['slide_ribbon']) ? trim((string) $row['slide_ribbon']) : '';
            $intro  = isset($row['slide_intro']) ? trim((string) $row['slide_intro']) : '';

            $items[] = array(
                'kicker'  => '' !== $kicker ? $kicker : ($fallback['kicker'] ?? ''),
                'title_1' => $title_1,
                'title_2' => '' !== $title_2 ? $title_2 : ($fallback['title_2'] ?? ''),
                'ribbon'  => '' !== $ribbon ? $ribbon : ($fallback['ribbon'] ?? ''),
                'intro'   => '' !== $intro ? $intro : ($fallback['intro'] ?? ''),
            );
        }

        if (!empty($items)) {
            $data['slides'] = $items;
        }
    }

    return psm_finalize_hero_section($data);
}

/**
 * Apply image fallbacks and ensure at least one slide.
 *
 * @param array $data Hero section data.
 * @return array
 */
function psm_finalize_hero_section(array $data) {
    if ('' === $data['background']) {
        $data['background'] = function_exists('psm_placeholder_image')
            ? psm_placeholder_image(1920, 1080, 'psm-hero-01')
            : '';
    }

    if (empty($data['slides'])) {
        $data['slides'] = psm_hero_slides_static();
    }

    return $data;
}
