<?php
/**
 * Southern Sheltered page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Southern Sheltered page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_southern_sheltered_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-southern-sheltered.php' === get_page_template_slug($post_id);
}

/**
 * Community Housing Tenders section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     image: string,
 *     badge: string,
 *     title: string,
 *     lead: string,
 *     body: string,
 *     button: array{title: string, url: string, target: string}
 * }
 */
function psm_get_southern_sheltered_tenders_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_southern_sheltered_tenders_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $image = psm_normalize_acf_image_url(get_field('tenders_image', $page_id));
    if ('' !== $image) {
        $data['image'] = $image;
    }

    $badge = get_field('tenders_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('tenders_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $lead = get_field('tenders_lead', $page_id);
    if (is_string($lead) && '' !== trim($lead)) {
        $data['lead'] = trim($lead);
    }

    $body = get_field('tenders_body', $page_id);
    if (is_string($body) && '' !== trim(wp_strip_all_tags($body))) {
        $data['body'] = trim($body);
    }

    $acf_button = get_field('tenders_button', $page_id);
    if (is_array($acf_button) && !empty($acf_button['url'])) {
        $data['button'] = array(
            'title'  => isset($acf_button['title']) ? trim((string) $acf_button['title']) : '',
            'url'    => trim((string) $acf_button['url']),
            'target' => isset($acf_button['target']) ? trim((string) $acf_button['target']) : '',
        );
    }

    return $data;
}
