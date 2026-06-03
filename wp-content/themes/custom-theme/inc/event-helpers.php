<?php
/**
 * Event helpers — card args and home section queries.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Normalize an ACF image field to a URL string.
 *
 * @param mixed $value Image field value.
 * @return string
 */
function psm_normalize_acf_image_url($value) {
    if (is_array($value)) {
        return isset($value['url']) ? trim((string) $value['url']) : '';
    }
    if (is_numeric($value)) {
        return wp_get_attachment_image_url((int) $value, 'full') ?: '';
    }
    return trim((string) $value);
}

/**
 * Parse event_date ACF value into day and month labels.
 *
 * @param mixed $date_raw Raw date from ACF.
 * @return array{day: string, month: string}
 */
function psm_parse_event_date_parts($date_raw) {
    $day   = '';
    $month = '';

    if (!$date_raw) {
        return array(
            'day'   => $day,
            'month' => $month,
        );
    }

    $date_raw = trim((string) $date_raw);
    $dt       = DateTime::createFromFormat('Y-m-d', $date_raw);

    if (!$dt) {
        $dt = DateTime::createFromFormat('Ymd', $date_raw);
    }

    if (!$dt) {
        $timestamp = strtotime($date_raw);
        if ($timestamp) {
            $dt = new DateTime('@' . $timestamp);
            $dt->setTimezone(wp_timezone());
        }
    }

    if ($dt) {
        $day   = date_i18n('j', $dt->getTimestamp());
        $month = date_i18n('F', $dt->getTimestamp());
    }

    return array(
        'day'   => $day,
        'month' => $month,
    );
}

/**
 * Build event-card template args from a psm_event post.
 *
 * @param int $post_id Event post ID.
 * @return array
 */
function psm_get_event_card_args($post_id) {
    $post_id = (int) $post_id;
    if ($post_id <= 0) {
        return array();
    }

    $date_parts = array(
        'day'   => '',
        'month' => '',
    );

    if (function_exists('get_field')) {
        $date_parts = psm_parse_event_date_parts(get_field('event_date', $post_id));
    }

    $title   = get_the_title($post_id);
    $excerpt = function_exists('get_field') ? get_field('event_excerpt', $post_id) : '';
    $excerpt = trim((string) $excerpt);

    $image = '';
    if (function_exists('get_field')) {
        $image = psm_normalize_acf_image_url(get_field('event_image', $post_id));
    }
    if ('' === $image) {
        $image = get_the_post_thumbnail_url($post_id, 'full') ?: '';
    }

    $url = get_permalink($post_id) ?: '';
    if (function_exists('get_field')) {
        $link = get_field('event_link', $post_id);
        if (is_array($link) && !empty($link['url'])) {
            $url = trim((string) $link['url']);
        }
    }

    return array(
        'day'       => $date_parts['day'],
        'month'     => $date_parts['month'],
        'title'     => trim((string) $title),
        'excerpt'   => $excerpt,
        'url'       => trim((string) $url),
        'image'     => trim((string) $image),
        'image_alt' => trim((string) $title),
    );
}

/**
 * Whether event card args contain any displayable content.
 *
 * @param array $card Event card args.
 * @return bool
 */
function psm_event_card_has_content($card) {
    if (!is_array($card)) {
        return false;
    }

    return '' !== ($card['day'] ?? '')
        || '' !== ($card['month'] ?? '')
        || '' !== ($card['title'] ?? '')
        || '' !== ($card['excerpt'] ?? '')
        || '' !== ($card['url'] ?? '')
        || '' !== ($card['image'] ?? '');
}

/**
 * Resolve event post IDs for the home events section.
 *
 * @param int $page_id Home page ID.
 * @return int[]
 */
function psm_get_home_event_post_ids($page_id) {
    $page_id = (int) $page_id;
    $ids     = array();

    if ($page_id > 0 && function_exists('get_field')) {
        $picked = get_field('events_items', $page_id);
        if (is_array($picked) && !empty($picked)) {
            foreach ($picked as $item) {
                if ($item instanceof WP_Post) {
                    $ids[] = (int) $item->ID;
                } elseif (is_numeric($item)) {
                    $ids[] = (int) $item;
                }
            }
            $ids = array_values(array_filter(array_unique($ids)));
            if (!empty($ids)) {
                return $ids;
            }
        }
    }

    $limit = 3;
    if ($page_id > 0 && function_exists('get_field')) {
        $acf_limit = get_field('events_limit', $page_id);
        if (is_numeric($acf_limit) && (int) $acf_limit > 0) {
            $limit = (int) $acf_limit;
        }
    }

    $query = new WP_Query(
        array(
            'post_type'      => 'psm_event',
            'post_status'    => 'publish',
            'posts_per_page' => $limit,
            'orderby'        => 'meta_value_num',
            'order'          => 'ASC',
            'meta_key'       => 'event_date',
            'meta_query'     => array(
                array(
                    'key'     => 'event_date',
                    'value'   => current_time('Ymd'),
                    'compare' => '>=',
                    'type'    => 'NUMERIC',
                ),
            ),
            'fields'         => 'ids',
            'no_found_rows'  => true,
        )
    );

    if (!empty($query->posts)) {
        $ids = array_map('intval', $query->posts);
    }

    wp_reset_postdata();

    return $ids;
}
