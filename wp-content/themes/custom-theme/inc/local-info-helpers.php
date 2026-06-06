<?php
/**
 * Local Info page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Local Info page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_local_info_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-local-info.php' === get_page_template_slug($post_id);
}

/**
 * About Port St Mary section from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{image: string, badge: string, title: string, paragraphs: string[]}
 */
function psm_get_local_info_about_section($page_id = 0) {
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

    $data['image'] = psm_normalize_acf_image_url(get_field('local_info_about_image', $page_id));

    $badge = get_field('local_info_about_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('local_info_about_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('local_info_about_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $data['paragraphs'] = psm_split_acf_lines($body);
    }

    return $data;
}

/**
 * History Timeline section header from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string}
 */
function psm_get_local_info_timeline_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = array(
        'badge' => '',
        'title' => '',
        'intro' => '',
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('local_info_timeline_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('local_info_timeline_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('local_info_timeline_intro', $page_id);
    if (is_string($intro)) {
        $data['intro'] = trim($intro);
    }

    return $data;
}

/**
 * History timeline entries from ACF.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, mixed>>
 */
function psm_get_local_info_timeline_entries($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return array();
    }

    $rows = get_field('local_info_timeline_entries', $page_id);
    if (!is_array($rows) || empty($rows)) {
        return array();
    }

    $entries = array();

    foreach ($rows as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $title = isset($row['local_info_timeline_entry_title']) ? trim((string) $row['local_info_timeline_entry_title']) : '';
        if ('' === $title) {
            continue;
        }

        $icon_image = '';
        if (isset($row['local_info_timeline_icon'])) {
            $icon_image = psm_normalize_acf_image_url($row['local_info_timeline_icon']);
        }

        $read_more = array(
            'label' => '',
            'url'   => '',
        );

        if (isset($row['local_info_timeline_link']) && is_array($row['local_info_timeline_link'])) {
            $link = psm_normalize_acf_link_button(
                $row['local_info_timeline_link'],
                array(
                    'label' => __('Learn More', 'cmd-theme'),
                    'url'   => '',
                )
            );
            $read_more = array(
                'label' => $link['label'],
                'url'   => $link['url'],
            );
        }

        $entries[] = array(
            'layout'     => 0 === $index % 2 ? 'right' : 'left',
            'period'     => isset($row['local_info_timeline_period']) ? trim((string) $row['local_info_timeline_period']) : '',
            'icon'       => 'anchor',
            'icon_image' => $icon_image,
            'title'      => $title,
            'text'       => isset($row['local_info_timeline_text']) ? trim((string) $row['local_info_timeline_text']) : '',
            'read_more'  => $read_more,
        );
    }

    return $entries;
}

/**
 * Timeline section footer HTML from ACF.
 *
 * @param int $page_id Page ID.
 * @return string
 */
function psm_get_local_info_timeline_footer_html($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if (!$page_id || !function_exists('get_field')) {
        return '';
    }

    $footer = get_field('local_info_timeline_footer', $page_id);

    return is_string($footer) ? trim($footer) : '';
}
