<?php
/**
 * Byelaws page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Byelaws page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_byelaws_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-byelaws.php' === get_page_template_slug($post_id);
}

/**
 * Guidance section from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{image: string, badge: string, title: string, subheading: string, paragraphs: string[]}
 */
function psm_get_byelaws_guidance_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'image'       => '',
        'badge'       => '',
        'title'       => '',
        'subheading'  => '',
        'paragraphs'  => array(),
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $data['image'] = psm_normalize_acf_image_url(get_field('byelaws_image', $page_id));

    $badge = get_field('byelaws_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('byelaws_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $subheading = get_field('byelaws_subheading', $page_id);
    if (is_string($subheading)) {
        $data['subheading'] = trim($subheading);
    }

    $body = get_field('byelaws_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $data['paragraphs'] = psm_split_acf_lines($body);
    }

    return $data;
}

/**
 * Guidance document links from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{label: string, file_url: string}>
 */
function psm_get_byelaws_documents($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('byelaws_documents', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $items = array();

    foreach ($rows as $row) {
        if (!is_array($row)) {
            continue;
        }

        $label = isset($row['byelaws_document_label']) ? trim((string) $row['byelaws_document_label']) : '';
        if ('' === $label) {
            continue;
        }

        $file_url = '';
        if (isset($row['byelaws_document_file'])) {
            $file_url = psm_normalize_acf_image_url($row['byelaws_document_file']);
        }

        if ('' === $file_url) {
            continue;
        }

        $items[] = array(
            'label'    => $label,
            'file_url' => $file_url,
        );
    }

    return $items;
}
