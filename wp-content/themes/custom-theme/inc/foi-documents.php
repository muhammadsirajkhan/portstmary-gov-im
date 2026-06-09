<?php
/**
 * FOI document list data and sample PDF helper.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * FOI page URL.
 */
function psm_foi_page_url() {
    $page = get_page_by_path('foi');
    if ($page) {
        return get_permalink($page);
    }
    return home_url('/foi/');
}

/**
 * Whether the post uses the FOI page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_foi_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-foi.php' === get_page_template_slug($post_id);
}

function psm_foi_sample_pdf_url() {
    return 'http://creativeisaac.com/psm/wp-content/uploads/2026/06/sample.pdf';
}

/**
 * Default FOI document labels (flat list).
 *
 * @return string[]
 */
function psm_get_foi_document_labels_static() {
    $data = require get_template_directory() . '/inc/foi-documents-data.php';

    if (!is_array($data)) {
        return array();
    }

    if (isset($data[0]) && is_string($data[0])) {
        return $data;
    }

    $labels = array();
    foreach ($data as $column) {
        if (!is_array($column)) {
            continue;
        }

        foreach ($column as $label) {
            $labels[] = (string) $label;
        }
    }

    return $labels;
}

/**
 * FOI documents from ACF repeater.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{label: string, file_url: string}>
 */
function psm_get_foi_documents_from_acf($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('foi_documents', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $items = array();
    foreach ($rows as $row) {
        if (!is_array($row)) {
            continue;
        }

        $label = isset($row['foi_document_label']) ? trim((string) $row['foi_document_label']) : '';
        if ('' === $label) {
            continue;
        }

        $file_url = '';
        if (isset($row['foi_document_file'])) {
            $file_url = psm_normalize_acf_image_url($row['foi_document_file']);
        }

        $items[] = array(
            'label'    => $label,
            'file_url' => $file_url,
        );
    }

    return $items;
}

/**
 * Flat FOI document items for the current page.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{label: string, file_url: string}>
 */
function psm_get_foi_document_items($page_id = 0) {
    $items = psm_get_foi_documents_from_acf($page_id);

    if (!empty($items)) {
        return $items;
    }

    $items = array();
    foreach (psm_get_foi_document_labels_static() as $label) {
        $items[] = array(
            'label'    => $label,
            'file_url' => '',
        );
    }

    return $items;
}

/**
 * Document rows for the FOI grid (three columns).
 *
 * @param int $page_id Page ID.
 * @return array<int, array<int, array{label: string, file_url: string}>>
 */
function psm_get_foi_document_columns($page_id = 0) {
    $items   = psm_get_foi_document_items($page_id);
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

/**
 * Resolve the FOI page post ID.
 *
 * @return int
 */
function psm_get_foi_page_id() {
    $pages = get_posts(
        array(
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'meta_key'       => '_wp_page_template',
            'meta_value'     => 'page-foi.php',
            'fields'         => 'ids',
        )
    );

    if (!empty($pages)) {
        return (int) $pages[0];
    }

    $page = get_page_by_path('foi');

    return $page ? (int) $page->ID : 0;
}

/**
 * Build ACF repeater rows for FOI documents (file line order).
 *
 * @return array<int, array{foi_document_label: string, foi_document_file: string}>
 */
function psm_foi_documents_seed_rows() {
    $labels  = psm_get_foi_document_labels_static();
    $pdf_url = psm_foi_sample_pdf_url();
    $rows    = array();

    foreach ($labels as $label) {
        $label = trim((string) $label);
        if ('' === $label) {
            continue;
        }

        $rows[] = array(
            'foi_document_label' => $label,
            'foi_document_file'  => $pdf_url,
        );
    }

    return $rows;
}

/**
 * Persist FOI document repeater rows on the FOI page.
 *
 * @param int $page_id Optional page ID.
 * @return array{success: bool, message: string, page_id: int, row_count: int}
 */
function psm_seed_foi_documents($page_id = 0) {
    if (!function_exists('update_field')) {
        return array(
            'success'   => false,
            'message'   => 'ACF is not available.',
            'page_id'   => 0,
            'row_count' => 0,
        );
    }

    if (!$page_id) {
        $page_id = psm_get_foi_page_id();
    }

    if (!$page_id || !psm_is_foi_page($page_id)) {
        return array(
            'success'   => false,
            'message'   => 'FOI page not found.',
            'page_id'   => (int) $page_id,
            'row_count' => 0,
        );
    }

    $rows = psm_foi_documents_seed_rows();
    if (empty($rows)) {
        return array(
            'success'   => false,
            'message'   => 'No document rows to seed.',
            'page_id'   => (int) $page_id,
            'row_count' => 0,
        );
    }

    $updated = update_field('foi_documents', $rows, $page_id);
    if (!$updated) {
        return array(
            'success'   => false,
            'message'   => 'Failed to update foi_documents field.',
            'page_id'   => (int) $page_id,
            'row_count' => 0,
        );
    }

    return array(
        'success'   => true,
        'message'   => 'FOI documents seeded successfully.',
        'page_id'   => (int) $page_id,
        'row_count' => count($rows),
    );
}

function psm_foi_document_filename($label) {
    return psm_document_download_filename($label);
}
