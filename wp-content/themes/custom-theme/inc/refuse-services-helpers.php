<?php
/**
 * Refuse Services page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the refuse services page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_refuse_services_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-refuse-services.php' === get_page_template_slug($post_id);
}

/**
 * Default inner banner values for the refuse services page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_refuse_services_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Refuse Services', 'cmd-theme'),
        'ribbon' => __('Supporting a Cleaner Environment', 'cmd-theme'),
        'intro'  => __(
            'Information about refuse collection, recycling, and keeping Port St Mary clean and sustainable.',
            'cmd-theme'
        ),
    );
}

/**
 * Build opening times array from a refuse row.
 *
 * @param array<string, mixed> $row ACF or static row data.
 * @return array<string, mixed>
 */
function psm_refuse_build_opening_times_from_row(array $row) {
    $title = isset($row['refuse_row_hours_title']) ? trim((string) $row['refuse_row_hours_title']) : '';
    $label = isset($row['refuse_row_hours_label']) ? trim((string) $row['refuse_row_hours_label']) : '';
    $value = isset($row['refuse_row_hours_value']) ? trim((string) $row['refuse_row_hours_value']) : '';
    $note  = isset($row['refuse_row_hours_note']) ? trim((string) $row['refuse_row_hours_note']) : '';
    $closed = isset($row['refuse_row_closed_note']) ? trim((string) $row['refuse_row_closed_note']) : '';

    if ('' === $title && '' === $label && '' === $value && '' === $note && '' === $closed) {
        return array();
    }

    $opening = array(
        'title'       => $title ?: __('Opening Times', 'cmd-theme'),
        'rows'        => array(),
        'note'        => $note,
        'closed_note' => $closed,
    );

    if ('' !== $label || '' !== $value) {
        $opening['rows'][] = array(
            'label' => $label,
            'value' => $value,
        );
    }

    return $opening;
}

/**
 * Refuse services zigzag rows from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, mixed>>
 */
function psm_get_refuse_services_rows($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('refuse_rows', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $items = array();

            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $title = isset($row['refuse_row_title']) ? trim((string) $row['refuse_row_title']) : '';
                if ('' === $title) {
                    continue;
                }

                $layout     = 0 === (int) $index % 2 ? 'image-left' : 'image-right';
                $background = 0 === (int) $index % 2 ? 'white' : 'grey';
                $accent     = 'image-left' === $layout ? 'tl' : 'tr';

                $image = '';
                if (isset($row['refuse_row_image'])) {
                    $image = psm_normalize_acf_image_url($row['refuse_row_image']);
                }

                $intro_html = isset($row['refuse_row_intro']) ? trim((string) $row['refuse_row_intro']) : '';
                $subheading = isset($row['refuse_row_subheading']) ? trim((string) $row['refuse_row_subheading']) : '';
                $extra_html = isset($row['refuse_row_extra_content']) ? trim((string) $row['refuse_row_extra_content']) : '';

                $opening_times = psm_refuse_build_opening_times_from_row($row);

                $slug = sanitize_title($title);
                if ('' === $slug) {
                    $slug = 'row-' . (int) $index;
                }

                $items[] = array(
                    'layout'        => $layout,
                    'background'    => $background,
                    'title'         => $title,
                    'heading_id'    => 'psm-refuse-' . $slug . '-heading',
                    'media'         => array(
                        'image'      => $image,
                        'image_seed' => 'psm-refuse-row-' . (int) $index,
                        'accent'     => $accent,
                    ),
                    'intro_html'    => $intro_html,
                    'opening_times' => $opening_times,
                    'subheading'    => $subheading,
                    'extra_html'    => $extra_html,
                );
            }

            if (!empty($items)) {
                return $items;
            }
        }
    }

    return psm_refuse_services_rows_static();
}
