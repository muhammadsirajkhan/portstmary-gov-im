<?php
/**
 * Board Mission Statement page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Board Mission Statement page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_mission_statement_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-mission-statement.php' === get_page_template_slug($post_id);
}

/**
 * Commitment section from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     image: string,
 *     badge: string,
 *     title: string,
 *     paragraphs: string[],
 *     document_label: string,
 *     document_url: string
 * }
 */
function psm_get_mission_statement_commitment_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'image'          => '',
        'badge'          => '',
        'title'          => '',
        'paragraphs'     => array(),
        'document_label' => '',
        'document_url'   => '',
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $data['image'] = psm_normalize_acf_image_url(get_field('mission_statement_image', $page_id));

    $badge = get_field('mission_statement_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('mission_statement_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('mission_statement_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $data['paragraphs'] = psm_split_acf_lines($body);
    }

    $document_label = get_field('mission_statement_document_label', $page_id);
    if (is_string($document_label)) {
        $data['document_label'] = trim($document_label);
    }

    $document_file = get_field('mission_statement_document_file', $page_id);
    if ($document_file) {
        $data['document_url'] = psm_normalize_acf_image_url($document_file);
    }

    return $data;
}
