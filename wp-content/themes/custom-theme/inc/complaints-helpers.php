<?php
/**
 * Complaints page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Complaints page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_complaints_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-complaints.php' === get_page_template_slug($post_id);
}

/**
 * How-to section from ACF.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     image: string,
 *     badge: string,
 *     title: string,
 *     paragraphs: string[],
 *     phone: string,
 *     email: string,
 *     button: array{title: string, url: string, target: string}
 * }
 */
function psm_get_complaints_how_to_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $defaults = psm_complaints_how_to_defaults();

    $data = array(
        'image'      => '',
        'badge'      => '',
        'title'      => '',
        'paragraphs' => array(),
        'phone'      => '',
        'email'      => '',
        'button'     => $defaults['button'],
    );

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $data['image'] = psm_normalize_acf_image_url(get_field('complaints_image', $page_id));

    $badge = get_field('complaints_badge', $page_id);
    if (is_string($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('complaints_title', $page_id);
    if (is_string($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('complaints_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $data['paragraphs'] = psm_split_acf_lines($body);
    }

    $phone = get_field('complaints_phone', $page_id);
    if (is_string($phone)) {
        $data['phone'] = trim($phone);
    }

    $email = get_field('complaints_email', $page_id);
    if (is_string($email)) {
        $data['email'] = trim($email);
    }

    $data['button'] = psm_normalize_acf_link_button(
        get_field('complaints_button', $page_id),
        $defaults['button']
    );

    return $data;
}
