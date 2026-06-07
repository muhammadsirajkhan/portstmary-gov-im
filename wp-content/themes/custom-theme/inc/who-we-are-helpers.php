<?php
/**
 * Who We Are page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Who We Are page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_who_we_are_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-who-we-are.php' === get_page_template_slug($post_id);
}

/**
 * About section from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{image: string, badge: string, title: string, paragraphs: string[]}
 */
function psm_get_who_we_are_about_section($page_id = 0) {
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

    $data['image'] = psm_normalize_acf_image_url(get_field('who_we_are_about_image', $page_id));

    $badge = get_field('who_we_are_about_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('who_we_are_about_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('who_we_are_about_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $data['paragraphs'] = psm_split_acf_lines($body);
    }

    return $data;
}

/**
 * Our Role section header from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string}
 */
function psm_get_who_we_are_role_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'badge' => '',
        'title' => '',
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('who_we_are_role_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('who_we_are_role_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    return $data;
}

/**
 * Our Role zigzag rows from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{layout: string, accent: string, image: string, image_seed: string, paragraphs: string[], highlight: string}>
 */
function psm_get_who_we_are_role_rows($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('who_we_are_role_rows', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $items = array();

    foreach ($rows as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $body = isset($row['who_we_are_role_row_body']) ? trim((string) $row['who_we_are_role_row_body']) : '';
        if ('' === $body) {
            continue;
        }

        $layout = isset($row['who_we_are_role_row_layout']) ? trim((string) $row['who_we_are_role_row_layout']) : 'image-left';
        $accent = isset($row['who_we_are_role_row_accent']) ? trim((string) $row['who_we_are_role_row_accent']) : 'bl';
        $accents = array('tl', 'tr', 'bl', 'br');

        $items[] = array(
            'layout'     => 'image-right' === $layout ? 'image-right' : 'image-left',
            'accent'     => in_array($accent, $accents, true) ? $accent : ( 'image-right' === $layout ? 'br' : 'bl' ),
            'image'      => isset($row['who_we_are_role_row_image']) ? psm_normalize_acf_image_url($row['who_we_are_role_row_image']) : '',
            'image_seed' => 'psm-who-we-are-role-' . ( $index + 1 ),
            'paragraphs' => psm_split_acf_lines($body),
            'highlight'  => isset($row['who_we_are_role_row_highlight']) ? trim((string) $row['who_we_are_role_row_highlight']) : '',
        );
    }

    return $items;
}

/**
 * Our Officers section header from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string}
 */
function psm_get_who_we_are_officers_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'badge' => '',
        'title' => '',
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('who_we_are_officers_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('who_we_are_officers_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    return $data;
}

/**
 * Officer cards from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, string>>
 */
function psm_get_who_we_are_officers($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('who_we_are_officers_rows', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $items = array();
    $tones = array('grey', 'teal', 'rose');

    foreach ($rows as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $name = isset($row['who_we_are_officer_name']) ? trim((string) $row['who_we_are_officer_name']) : '';
        if ('' === $name) {
            continue;
        }

        $role = isset($row['who_we_are_officer_role']) ? trim((string) $row['who_we_are_officer_role']) : '';
        $tone = isset($row['who_we_are_officer_tone']) ? trim((string) $row['who_we_are_officer_tone']) : 'grey';
        $link = isset($row['who_we_are_officer_linkedin']) ? trim((string) $row['who_we_are_officer_linkedin']) : '';
        $image = isset($row['who_we_are_officer_image']) ? psm_normalize_acf_image_url($row['who_we_are_officer_image']) : '';

        $items[] = array(
            'name'       => $name,
            'role'       => $role,
            'tag'        => __('Officer', 'cmd-theme'),
            'image'      => $image,
            'image_seed' => 'psm-who-we-are-officer-' . ( $index + 1 ),
            'tone'       => in_array($tone, $tones, true) ? $tone : 'grey',
            'linkedin'   => $link,
        );
    }

    return $items;
}
