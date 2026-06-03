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

function psm_foi_sample_pdf_url() {
    return psm_sample_pdf_url();
}

/**
 * Default FOI document labels (flat list).
 *
 * @return string[]
 */
function psm_get_foi_document_labels_static() {
    $columns = array(
        array(
            'FOI IM16/483',
            'FOI IM16/485',
            'FOI IM17/001',
            'FOI IM17/326/1',
            'FOI IM17/326/2',
            'FOI IM18/042',
            'FOI IM18/156',
            'FOI IM19/201',
            'FOI IM19/445',
            'FOI IM20/112',
            'FOI IM20/388',
            'FOI IM21/059',
            'FOI IM21/274',
        ),
        array(
            'FOI IM733681 A',
            'FOI IM733681 B',
            'FOI IM22/103',
            'FOI IM22/317',
            'FOI IM23/088',
            'FOI IM23/402',
            'FOI IM24/015',
            'FOI IM24/229',
            'FOI IM24/501',
            'FOI IM25/067',
            'FOI IM25/198',
            'FOI IM25/421',
            'FOI IM26/034',
        ),
        array(
            'FOI IM733681 Section 1',
            'FOI IM733681 Section 2',
            'FOI IM733681 Section 3',
            'FOI IM26/178',
            'FOI IM26/402',
            'FOI IM27/056',
            'FOI IM27/289',
            'FOI IM27/511',
            'FOI IM28/024',
            'FOI IM28/198',
            'FOI IM28/367',
            'FOI IM29/041',
            'FOI IM29/256',
        ),
    );

    $labels = array();
    foreach ($columns as $column) {
        foreach ($column as $label) {
            $labels[] = $label;
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

function psm_foi_document_filename($label) {
    return psm_document_download_filename($label);
}
