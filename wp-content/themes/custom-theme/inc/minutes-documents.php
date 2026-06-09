<?php
/**
 * Board meeting minutes document list.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

function psm_minutes_page_url() {
    $page = get_page_by_path('meeting-minutes');
    if (!$page) {
        $page = get_page_by_path('minutes');
    }
    if ($page) {
        return get_permalink($page);
    }
    return home_url('/meeting-minutes/');
}

/**
 * Whether the post uses the minutes page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_minutes_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-minutes.php' === get_page_template_slug($post_id);
}

/**
 * Default inner banner args for the minutes page (matches acf-json).
 *
 * @return array{kicker: string, title: string, ribbon: string}
 */
function psm_minutes_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Meeting Minutes', 'cmd-theme'),
        'ribbon' => __('Latest Board Meeting Minutes and Public Information', 'cmd-theme'),
    );
}

/**
 * Default minutes section field values (matches acf-json).
 *
 * @return array{badge: string, title: string, intro: string, viewer_url: string}
 */
function psm_minutes_section_defaults() {
    return array(
        'badge'      => __('Minutes', 'cmd-theme'),
        'title'      => __('Board Meeting Minutes', 'cmd-theme'),
        'intro'      => __(
            'Please click on the links below to view approved Meeting Minutes, with redactions where appropriate.',
            'cmd-theme'
        ),
        'viewer_url' => 'https://get.adobe.com/reader/',
    );
}

/**
 * Default document columns from design data.
 *
 * @return array<int, array<int, array{label: string, file_url: string}>>
 */
function psm_get_minutes_document_columns_static() {
    $data = require get_template_directory() . '/inc/minutes-documents-data.php';
    if (!is_array($data)) {
        return array();
    }

    if (isset($data[0]) && is_string($data[0])) {
        $columns = array(
            array(),
            array(),
            array(),
        );

        foreach ($data as $index => $label) {
            $columns[ $index % 3 ][] = array(
                'label'    => (string) $label,
                'file_url' => '',
            );
        }

        return $columns;
    }

    $columns = array();
    foreach ($data as $column) {
        if (!is_array($column)) {
            continue;
        }

        $items = array();
        foreach ($column as $label) {
            $items[] = array(
                'label'    => (string) $label,
                'file_url' => '',
            );
        }
        $columns[] = $items;
    }

    return $columns;
}

/**
 * Minutes documents from ACF repeater.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{label: string, file_url: string}>
 */
function psm_get_minutes_documents_from_acf($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('minutes_documents', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $items = array();
    foreach ($rows as $row) {
        if (!is_array($row)) {
            continue;
        }

        $label = isset($row['minutes_document_label']) ? trim((string) $row['minutes_document_label']) : '';
        if ('' === $label) {
            continue;
        }

        $file_url = '';
        if (isset($row['minutes_document_file'])) {
            $file_url = psm_normalize_acf_image_url($row['minutes_document_file']);
        }

        $items[] = array(
            'label'    => $label,
            'file_url' => $file_url,
        );
    }

    return $items;
}

/**
 * Flat document list for the minutes section (ACF order).
 *
 * @param int $page_id Page ID.
 * @return array<int, array{label: string, file_url: string}>
 */
function psm_get_minutes_documents($page_id = 0) {
    $items = psm_get_minutes_documents_from_acf($page_id);
    if (!empty($items)) {
        return $items;
    }

    $data = require get_template_directory() . '/inc/minutes-documents-data.php';
    if (!is_array($data)) {
        return array();
    }

    $items = array();
    if (isset($data[0]) && is_string($data[0])) {
        foreach ($data as $label) {
            $items[] = array(
                'label'    => (string) $label,
                'file_url' => '',
            );
        }

        return $items;
    }

    foreach ($data as $column) {
        if (!is_array($column)) {
            continue;
        }

        foreach ($column as $label) {
            $items[] = array(
                'label'    => (string) $label,
                'file_url' => '',
            );
        }
    }

    return $items;
}

/**
 * Three-column document rows for the minutes grid.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<int, array{label: string, file_url: string}>>
 */
function psm_get_minutes_document_columns($page_id = 0) {
    $items = psm_get_minutes_documents_from_acf($page_id);

    if (!empty($items)) {
        $columns = array(
            array(),
            array(),
            array(),
        );

        foreach ($items as $index => $item) {
            $columns[ $index % 3 ][] = $item;
        }

        return $columns;
    }

    return psm_get_minutes_document_columns_static();
}

/**
 * Ordinal suffix for day number (design: "25th May 2023").
 */
function psm_ordinal_day($day) {
    $day = (int) $day;
    $mod100 = $day % 100;

    if ($mod100 >= 11 && $mod100 <= 13) {
        return $day . 'th';
    }

    switch ($day % 10) {
        case 1:
            return $day . 'st';
        case 2:
            return $day . 'nd';
        case 3:
            return $day . 'rd';
        default:
            return $day . 'th';
    }
}

/**
 * Format stored label to match design typography (ordinal dates).
 */
function psm_minutes_format_label($label) {
    return preg_replace_callback(
        '/Board Meeting Minutes (\d{1,2}) (January|February|March|April|May|June|July|August|September|October|November|December) (\d{4})/',
        static function ($matches) {
            return sprintf(
                'Board Meeting Minutes %s %s %s',
                psm_ordinal_day((int) $matches[1]),
                $matches[2],
                $matches[3]
            );
        },
        $label
    );
}

/**
 * Sample PDF URL stored on seeded minutes document rows.
 */
function psm_minutes_sample_pdf_url() {
    return 'http://creativeisaac.com/psm/wp-content/uploads/2026/06/sample.pdf';
}

/**
 * Resolve the Minutes page post ID.
 *
 * @return int
 */
function psm_get_minutes_page_id() {
    $pages = get_posts(
        array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'meta_key'       => '_wp_page_template',
            'meta_value'     => 'page-minutes.php',
            'fields'         => 'ids',
        )
    );

    if (!empty($pages)) {
        return (int) $pages[0];
    }

    $page = get_page_by_path('meeting-minutes');
    if (!$page) {
        $page = get_page_by_path('minutes');
    }

    return $page ? (int) $page->ID : 0;
}

/**
 * Build ACF repeater rows for minutes documents (file line order).
 *
 * @return array<int, array{minutes_document_label: string, minutes_document_file: string}>
 */
function psm_minutes_documents_seed_rows() {
    $data = require get_template_directory() . '/inc/minutes-documents-data.php';
    if (!is_array($data)) {
        return array();
    }

    $labels = array();
    if (isset($data[0]) && is_string($data[0])) {
        $labels = $data;
    } else {
        $columns = array_values($data);
        foreach ($columns as $column) {
            if (!is_array($column)) {
                continue;
            }
            foreach ($column as $label) {
                $labels[] = $label;
            }
        }
    }

    $pdf_url = psm_minutes_sample_pdf_url();
    $rows    = array();

    foreach ($labels as $label) {
        $label = trim((string) $label);
        if ('' === $label) {
            continue;
        }

        $rows[] = array(
            'minutes_document_label' => $label,
            'minutes_document_file'  => $pdf_url,
        );
    }

    return $rows;
}

/**
 * Persist minutes document repeater rows on the Minutes page.
 *
 * @param int $page_id Optional page ID.
 * @return array{success: bool, message: string, page_id: int, row_count: int}
 */
function psm_seed_minutes_documents($page_id = 0) {
    if (!function_exists('update_field')) {
        return array(
            'success'   => false,
            'message'   => 'ACF is not available.',
            'page_id'   => 0,
            'row_count' => 0,
        );
    }

    if (!$page_id) {
        $page_id = psm_get_minutes_page_id();
    }

    if (!$page_id || !psm_is_minutes_page($page_id)) {
        return array(
            'success'   => false,
            'message'   => 'Minutes page not found.',
            'page_id'   => (int) $page_id,
            'row_count' => 0,
        );
    }

    $rows = psm_minutes_documents_seed_rows();
    if (empty($rows)) {
        return array(
            'success'   => false,
            'message'   => 'No document rows to seed.',
            'page_id'   => (int) $page_id,
            'row_count' => 0,
        );
    }

    $updated = update_field('minutes_documents', $rows, $page_id);
    if (!$updated) {
        return array(
            'success'   => false,
            'message'   => 'Failed to update minutes_documents field.',
            'page_id'   => (int) $page_id,
            'row_count' => 0,
        );
    }

    return array(
        'success'   => true,
        'message'   => 'Minutes documents seeded successfully.',
        'page_id'   => (int) $page_id,
        'row_count' => count($rows),
    );
}
