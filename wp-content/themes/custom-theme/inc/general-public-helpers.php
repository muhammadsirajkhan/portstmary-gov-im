<?php
/**
 * General Public page helpers.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Default inner banner values for the general public page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_general_public_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to the Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('General Public', 'cmd-theme'),
        'ribbon' => __('Homes With Community at Heart', 'cmd-theme'),
        'intro'  => __(
            'Providing quality housing and essential services for our vibrant Port St Mary community.',
            'cmd-theme'
        ),
    );
}

/**
 * Default Supporting Local Housing section values.
 *
 * @return array{badge: string, title: string, image: string, paragraphs: string[]}
 */
function psm_general_public_housing_section_defaults() {
    return array(
        'badge'      => __('About The General Public', 'cmd-theme'),
        'title'      => __('Supporting Local Housing Needs', 'cmd-theme'),
        'image'      => psm_theme_image('general-public-housing.jpg') ?: psm_theme_image('general-public-collage-1.jpg') ?: '',
        'paragraphs' => psm_general_public_intro_paragraphs_static(),
    );
}

/**
 * Default Applying for Housing section values.
 *
 * @return array{badge: string, title: string, intro: string[]}
 */
function psm_general_public_applying_section_defaults() {
    return array(
        'badge' => __('Port St Mary Commissioners', 'cmd-theme'),
        'title' => __('Applying For Housing', 'cmd-theme'),
        'intro' => array(
            __(
                'Residents interested in applying for housing can complete an application form and submit the required information for review.',
                'cmd-theme'
            ),
            __(
                'Applications are assessed based on eligibility, housing availability, and community needs.',
                'cmd-theme'
            ),
        ),
    );
}

/**
 * Supporting Local Housing section from ACF or defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, image: string, paragraphs: string[]}
 */
function psm_get_general_public_housing_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $defaults = psm_general_public_housing_section_defaults();
    $data     = $defaults;

    if ($page_id && function_exists('get_field')) {
        $badge = get_field('housing_badge', $page_id);
        $title = get_field('housing_title', $page_id);
        $intro = get_field('housing_intro', $page_id);
        $image = get_field('housing_image', $page_id);

        if (is_string($badge) && '' !== trim($badge)) {
            $data['badge'] = trim($badge);
        }
        if (is_string($title) && '' !== trim($title)) {
            $data['title'] = trim($title);
        }

        $paragraphs = psm_split_acf_paragraphs($intro);
        if (!empty($paragraphs)) {
            $data['paragraphs'] = $paragraphs;
        }

        $image_url = psm_normalize_acf_image_url($image);
        if ('' !== $image_url) {
            $data['image'] = $image_url;
        }
    }

    return $data;
}

/**
 * Intro paragraphs for Supporting Local Housing.
 *
 * @param int $page_id Page ID.
 * @return string[]
 */
function psm_get_general_public_intro_paragraphs($page_id = 0) {
    $section = psm_get_general_public_housing_section($page_id);
    return isset($section['paragraphs']) ? (array) $section['paragraphs'] : psm_general_public_intro_paragraphs_static();
}

/**
 * Applying for Housing header from ACF or defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string[]}
 */
function psm_get_general_public_applying_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $defaults = psm_general_public_applying_section_defaults();
    $data     = $defaults;

    if ($page_id && function_exists('get_field')) {
        $badge = get_field('applying_badge', $page_id);
        $title = get_field('applying_title', $page_id);
        $intro = get_field('applying_intro', $page_id);

        if (is_string($badge) && '' !== trim($badge)) {
            $data['badge'] = trim($badge);
        }
        if (is_string($title) && '' !== trim($title)) {
            $data['title'] = trim($title);
        }

        $paragraphs = psm_split_acf_paragraphs($intro);
        if (!empty($paragraphs)) {
            $data['intro'] = $paragraphs;
        }
    }

    return $data;
}

/**
 * Housing application process cards from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, string>>
 */
function psm_get_general_public_housing_steps($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('applying_steps', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $static = psm_general_public_housing_steps_static();
            $items  = array();

            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $title = isset($row['step_title']) ? trim((string) $row['step_title']) : '';
                if ('' === $title) {
                    continue;
                }

                $text = isset($row['step_text']) ? trim((string) $row['step_text']) : '';
                $url  = isset($row['step_url']) ? trim((string) $row['step_url']) : '';
                $num  = isset($row['step_number']) ? trim((string) $row['step_number']) : '';

                if ('' === $num) {
                    $num = str_pad((string) ((int) $index + 1), 2, '0', STR_PAD_LEFT);
                }

                $icon_image = '';
                if (isset($row['step_icon'])) {
                    $icon_image = psm_normalize_acf_image_url($row['step_icon']);
                }

                $fallback = isset($static[ $index ]) ? $static[ $index ] : array();
                $icon     = isset($fallback['icon']) ? $fallback['icon'] : 'form';

                if ('' === $icon_image && isset($fallback['icon_image'])) {
                    $icon_image = $fallback['icon_image'];
                }
                if ('' === $text && isset($fallback['text'])) {
                    $text = $fallback['text'];
                }
                if ('' === $url && isset($fallback['url'])) {
                    $url = $fallback['url'];
                }

                $items[] = array(
                    'step'       => $num,
                    'icon'       => $icon,
                    'icon_image' => $icon_image,
                    'title'      => $title,
                    'text'       => $text,
                    'url'        => $url ?: '#',
                );
            }

            if (!empty($items)) {
                return $items;
            }
        }
    }

    return psm_general_public_housing_steps_static();
}
