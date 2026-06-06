<?php
/**
 * Consultations page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Consultations page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_consultations_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-consultations.php' === get_page_template_slug($post_id);
}

/**
 * Community Consultation & Engagement section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{image: string, badge: string, title: string, paragraphs: string[]}
 */
function psm_get_consultation_engagement_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_consultation_engagement_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $image = psm_normalize_acf_image_url(get_field('consult_engagement_image', $page_id));
    if ('' !== $image) {
        $data['image'] = $image;
    }

    $badge = get_field('consult_engagement_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('consult_engagement_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $body = get_field('consult_engagement_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $paragraphs = psm_split_acf_lines($body);
        if (!empty($paragraphs)) {
            $data['paragraphs'] = $paragraphs;
        }
    }

    return $data;
}

/**
 * Current Consultations section header from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string}
 */
function psm_get_consultation_current_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_consultation_current_header_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('consult_current_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('consult_current_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('consult_current_intro', $page_id);
    if (is_string($intro) && '' !== trim($intro)) {
        $data['intro'] = trim($intro);
    }

    return $data;
}

/**
 * Current consultation cards from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{title: string, url: string, image: string, image_seed: string}>
 */
function psm_get_current_consultations($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('consult_current_cards', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $items        = array();
            $static_items = psm_consultation_current_items_static();

            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $title = isset($row['consult_card_title']) ? trim((string) $row['consult_card_title']) : '';
                if ('' === $title) {
                    continue;
                }

                $image = '';
                if (isset($row['consult_card_image'])) {
                    $image = psm_normalize_acf_image_url($row['consult_card_image']);
                }

                $seed = isset($static_items[ $index ]['image_seed'])
                    ? $static_items[ $index ]['image_seed']
                    : 'psm-consult-' . ( (int) $index + 1 );

                if ('' === $image && isset($static_items[ $index ]['image'])) {
                    $image = $static_items[ $index ]['image'];
                }

                $url = '#';
                if (isset($row['consult_card_link']) && is_array($row['consult_card_link'])) {
                    $link = psm_normalize_acf_link_button(
                        $row['consult_card_link'],
                        array(
                            'title' => $title,
                            'url'   => '#',
                        )
                    );
                    if ('' !== $link['url']) {
                        $url = $link['url'];
                    }
                }

                $items[] = array(
                    'title'      => $title,
                    'url'        => $url,
                    'image'      => $image,
                    'image_seed' => $seed,
                );
            }

            if (!empty($items)) {
                return $items;
            }
        }
    }

    return psm_consultation_current_items_static();
}

/**
 * Why Your Feedback Matters section header from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string}
 */
function psm_get_consultation_feedback_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_consultation_feedback_header_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('consult_feedback_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('consult_feedback_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('consult_feedback_intro', $page_id);
    if (is_string($intro) && '' !== trim($intro)) {
        $data['intro'] = trim($intro);
    }

    return $data;
}

/**
 * Why feedback matters value cards from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{icon: string, icon_image: string, title: string, text: string}>
 */
function psm_get_consultation_feedback_values($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('consult_feedback_cards', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $cards        = array();
            $static_cards = psm_consultation_feedback_values_static();
            $fallbacks    = psm_consultation_feedback_icon_keys();

            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $title = isset($row['consult_feedback_card_title']) ? trim((string) $row['consult_feedback_card_title']) : '';
                if ('' === $title) {
                    continue;
                }

                $icon_image = '';
                if (isset($row['consult_feedback_card_icon'])) {
                    $icon_image = psm_normalize_acf_image_url($row['consult_feedback_card_icon']);
                }

                $icon = isset($static_cards[ $index ]['icon']) ? $static_cards[ $index ]['icon'] : '';
                if ('' === $icon && isset($fallbacks[ $index ])) {
                    $icon = $fallbacks[ $index ];
                }
                if ('' === $icon) {
                    $icon = 'community-representation';
                }

                $text = isset($row['consult_feedback_card_text']) ? trim((string) $row['consult_feedback_card_text']) : '';
                if ('' === $text && isset($static_cards[ $index ]['text'])) {
                    $text = $static_cards[ $index ]['text'];
                }

                $cards[] = array(
                    'icon'       => $icon,
                    'icon_image' => $icon_image,
                    'title'      => $title,
                    'text'       => $text,
                );
            }

            if (!empty($cards)) {
                return $cards;
            }
        }
    }

    return psm_consultation_feedback_values_static();
}
