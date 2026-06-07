<?php
/**
 * Rates & Finances page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Rates & Finances page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_rates_finances_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-rates-finances.php' === get_page_template_slug($post_id);
}

/**
 * Village Rates section from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{image: string, badge: string, title: string, paragraphs: string[]}
 */
function psm_get_rates_village_rates_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'image'      => '',
        'badge'      => '',
        'title'      => '',
        'paragraphs' => array(),
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $data['image'] = psm_normalize_acf_image_url(get_field('rates_village_image', $page_id));

    $badge = get_field('rates_village_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('rates_village_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('rates_village_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $data['paragraphs'] = psm_split_acf_lines($body);
    }

    return $data;
}

/**
 * Financial Statements section header from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{background: string, badge: string, title: string, intro: string[]}
 */
function psm_get_rates_financial_statements_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'background' => '',
        'badge'      => '',
        'title'      => '',
        'intro'      => array(),
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $data['background'] = psm_normalize_acf_image_url(get_field('rates_financial_background', $page_id));

    $badge = get_field('rates_financial_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('rates_financial_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('rates_financial_intro', $page_id);
    if (is_string($intro) && '' !== trim($intro)) {
        $data['intro'] = psm_split_acf_lines($intro);
    }

    return $data;
}

/**
 * Financial statement documents from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{label: string, file_url: string}>
 */
function psm_get_rates_financial_documents($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('rates_financial_documents', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $items = array();

    foreach ($rows as $row) {
        if (!is_array($row)) {
            continue;
        }

        $label = isset($row['rates_financial_document_label']) ? trim((string) $row['rates_financial_document_label']) : '';
        if ('' === $label) {
            continue;
        }

        $file_url = '';
        if (isset($row['rates_financial_document_file'])) {
            $file_url = psm_normalize_acf_image_url($row['rates_financial_document_file']);
        }

        $items[] = array(
            'label'    => $label,
            'file_url' => $file_url,
        );
    }

    return $items;
}

/**
 * Two-column document rows for the financial statements grid.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<int, array{label: string, file_url: string}>>
 */
function psm_get_rates_financial_document_columns($page_id = 0) {
    $items = psm_get_rates_financial_documents($page_id);

    if (empty($items)) {
        return array(
            array(),
            array(),
        );
    }

    $split_at = (int) ceil(count($items) / 2);

    return array(
        array_slice($items, 0, $split_at),
        array_slice($items, $split_at),
    );
}
