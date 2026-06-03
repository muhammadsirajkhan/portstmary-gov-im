<?php
/**
 * Housing Services page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the housing services page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_housing_services_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-housing-services.php' === get_page_template_slug($post_id);
}

/**
 * Default inner banner values for the housing services page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_housing_services_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to the Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Housing Services', 'cmd-theme'),
        'ribbon' => __('Quality Homes for Local Residents', 'cmd-theme'),
        'intro'  => __(
            'Find information about housing applications, sheltered accommodation, and support from Port St Mary Commissioners.',
            'cmd-theme'
        ),
    );
}

/**
 * Build intro HTML from plain-text paragraphs.
 *
 * @param string[] $paragraphs Paragraph strings.
 * @return string
 */
function psm_housing_paragraphs_to_intro_html(array $paragraphs) {
    $parts = array();

    foreach ($paragraphs as $paragraph) {
        $paragraph = trim((string) $paragraph);
        if ('' !== $paragraph) {
            $parts[] = '<p>' . esc_html($paragraph) . '</p>';
        }
    }

    return implode('', $parts);
}

/**
 * Whether WYSIWYG / HTML content has displayable text.
 *
 * @param string $html HTML string.
 * @return bool
 */
function psm_housing_has_html_content($html) {
    return '' !== trim(wp_strip_all_tags((string) $html));
}

/**
 * Housing services zigzag rows from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, mixed>>
 */
function psm_get_housing_services_rows($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('housing_rows', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $items = array();

            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $title = isset($row['housing_row_title']) ? trim((string) $row['housing_row_title']) : '';
                if ('' === $title) {
                    continue;
                }

                $image = '';
                if (isset($row['housing_row_image'])) {
                    $image = psm_normalize_acf_image_url($row['housing_row_image']);
                }

                $intro_html = isset($row['housing_row_intro']) ? trim((string) $row['housing_row_intro']) : '';
                $extra_content = isset($row['housing_row_extra_content']) ? trim((string) $row['housing_row_extra_content']) : '';

                $features = array();
                if (isset($row['housing_row_features'])) {
                    $features = psm_split_acf_lines($row['housing_row_features']);
                }

                $slug = sanitize_title($title);
                if ('' === $slug) {
                    $slug = 'row-' . (int) $index;
                }

                $items[] = array(
                    'layout'        => 0 === (int) $index % 2 ? 'image-left' : 'image-right',
                    'title'         => $title,
                    'heading_id'    => 'psm-housing-' . $slug . '-heading',
                    'image'         => $image,
                    'image_seed'    => 'psm-hs-row-' . (int) $index,
                    'intro_html'    => $intro_html,
                    'extra_content' => $extra_content,
                    'features'      => $features,
                );
            }

            if (!empty($items)) {
                return $items;
            }
        }
    }

    return psm_housing_services_rows_static();
}
