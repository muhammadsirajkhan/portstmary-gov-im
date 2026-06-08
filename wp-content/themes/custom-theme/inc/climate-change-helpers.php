<?php
/**
 * Climate Change page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Climate Change page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_climate_change_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-climate-change.php' === get_page_template_slug($post_id);
}

/**
 * Theme image for a footer social network slug.
 *
 * @param string $network Network slug.
 * @return string
 */
function psm_climate_change_social_icon_url($network) {
    $map = array(
        'facebook'  => 'c-facebook.webp',
        'instagram' => 'c-insta.webp',
        'linkedin'  => 'c-linkendin.webp',
        'twitter'   => 'contact-twit.webp',
    );

    $network = sanitize_key((string) $network);
    if (!isset($map[ $network ])) {
        return '';
    }

    return psm_theme_image($map[ $network ]) ?: '';
}

/**
 * Social links for the image action bar from footer settings.
 *
 * @return array<int, array{url: string, label: string, icon: string}>
 */
function psm_get_climate_change_footer_social_links() {
    $links  = array();
    $footer = psm_get_footer_settings();

    if (empty($footer['social_links']) || !is_array($footer['social_links'])) {
        return $links;
    }

    foreach ($footer['social_links'] as $social) {
        $network = isset($social['id']) ? sanitize_key((string) $social['id']) : '';
        $url     = isset($social['url']) ? trim((string) $social['url']) : '';
        $label   = isset($social['label']) ? trim((string) $social['label']) : '';
        $icon    = psm_climate_change_social_icon_url($network);

        if ('' === $network || '' === $url || '' === $icon) {
            continue;
        }

        $links[] = array(
            'url'   => $url,
            'label' => $label ?: ucfirst($network),
            'icon'  => $icon,
        );
    }

    return $links;
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
 *     document_url: string,
 *     phone: string,
 *     phone_href: string,
 *     social_links: array<int, array{url: string, label: string, icon: string}>
 * }
 */
function psm_get_climate_change_commitment_section($page_id = 0) {
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
        'phone'          => '',
        'phone_href'     => '',
        'social_links'   => array(),
    );

    if ($page_id && function_exists('get_field')) {
        $data['image'] = psm_normalize_acf_image_url(get_field('climate_change_image', $page_id));

        $badge = get_field('climate_change_badge', $page_id);
        if (is_string($badge)) {
            $data['badge'] = trim($badge);
        }

        $title = get_field('climate_change_title', $page_id);
        if (is_string($title)) {
            $data['title'] = trim($title);
        }

        $body = get_field('climate_change_body', $page_id);
        if (is_string($body) && '' !== trim($body)) {
            $data['paragraphs'] = psm_split_acf_lines($body);
        }

        $document_label = get_field('climate_change_document_label', $page_id);
        if (is_string($document_label)) {
            $data['document_label'] = trim($document_label);
        }

        $document_file = get_field('climate_change_document_file', $page_id);
        if ($document_file) {
            $data['document_url'] = psm_normalize_acf_image_url($document_file);
        }
    }

    $footer = psm_get_footer_settings();
    $data['phone'] = trim((string) ($footer['phone_display'] ?? ''));
    $data['phone_href'] = trim((string) ($footer['phone_href'] ?? ''));
    $data['social_links'] = psm_get_climate_change_footer_social_links();

    return $data;
}
