<?php
/**
 * News helpers — card args and home section queries.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Build news-card template args from a psm_news post.
 *
 * @param int $post_id News post ID.
 * @return array
 */
function psm_get_news_card_args($post_id) {
    $post_id = (int) $post_id;
    if ($post_id <= 0) {
        return array();
    }

    $title = get_the_title($post_id);

    $category = '';
    $time     = '';
    $excerpt  = '';

    if (function_exists('get_field')) {
        $category = get_field('news_category', $post_id);
        $time     = get_field('news_time_label', $post_id);
        $excerpt  = get_field('news_excerpt', $post_id);
    }

    $category = trim((string) $category);
    $time     = trim((string) $time);
    $excerpt  = trim((string) $excerpt);

    if ('' === $time) {
        $time = sprintf(
            /* translators: %s: human-readable time difference */
            __('%s ago', 'cmd-theme'),
            human_time_diff(get_post_time('U', true, $post_id), current_time('timestamp'))
        );
    }

    $image = '';
    if (function_exists('get_field')) {
        $image = psm_normalize_acf_image_url(get_field('news_image', $post_id));
    }
    if ('' === $image) {
        $image = get_the_post_thumbnail_url($post_id, 'large') ?: '';
    }

    $url = get_permalink($post_id) ?: '';
    if (function_exists('get_field')) {
        $link = get_field('news_link', $post_id);
        if (is_array($link) && !empty($link['url'])) {
            $url = trim((string) $link['url']);
        }
    }

    return array(
        'category'  => $category,
        'time'      => $time,
        'title'     => trim((string) $title),
        'excerpt'   => $excerpt,
        'url'       => trim((string) $url),
        'image'     => trim((string) $image),
        'image_alt' => trim((string) $title),
    );
}

/**
 * Whether news card args contain any displayable content.
 *
 * @param array $card News card args.
 * @return bool
 */
function psm_news_card_has_content($card) {
    if (!is_array($card)) {
        return false;
    }

    return '' !== ($card['category'] ?? '')
        || '' !== ($card['time'] ?? '')
        || '' !== ($card['title'] ?? '')
        || '' !== ($card['excerpt'] ?? '')
        || '' !== ($card['url'] ?? '')
        || '' !== ($card['image'] ?? '');
}

/**
 * Whether the current context is the home page news section.
 *
 * @param int $page_id Page ID.
 * @return bool
 */
function psm_is_home_news_page($page_id) {
    $page_id = (int) $page_id;
    if ($page_id <= 0) {
        return false;
    }

    return 'home.php' === get_page_template_slug($page_id);
}

/**
 * Resolve news post IDs for the news section.
 *
 * @param int $page_id Page ID (home uses relationship when set).
 * @return int[]
 */
function psm_get_home_news_post_ids($page_id) {
    $page_id = (int) $page_id;
    $ids     = array();

    if ($page_id > 0 && psm_is_home_news_page($page_id) && function_exists('get_field')) {
        $picked = get_field('news_items', $page_id);
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

    $limit = 4;
    if ($page_id > 0 && psm_is_home_news_page($page_id) && function_exists('get_field')) {
        $acf_limit = get_field('news_limit', $page_id);
        if (is_numeric($acf_limit) && (int) $acf_limit > 0) {
            $limit = (int) $acf_limit;
        }
    }

    $query = new WP_Query(
        array(
            'post_type'      => 'psm_news',
            'post_status'    => 'publish',
            'posts_per_page' => $limit,
            'orderby'        => 'date',
            'order'          => 'DESC',
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

/**
 * Default home news section field values (matches acf-json defaults).
 *
 * @return array<string, mixed>
 */
function psm_home_news_section_defaults() {
    return array(
        'badge'  => __('Community News', 'cmd-theme'),
        'title'  => __('Latest News & Updates', 'cmd-theme'),
        'intro'  => array(
            __(
                'Stay up to date with the latest announcements, community stories, and service updates from Port St Mary Commissioners.',
                'cmd-theme'
            ),
            __(
                'Browse recent news below or view the full archive for meetings, events, and village initiatives.',
                'cmd-theme'
            ),
        ),
        'button'       => psm_news_default_button(),
    );
}

/**
 * Default link array for the home news footer button.
 *
 * @return array{url: string, title: string, target: string}
 */
function psm_news_default_button() {
    $archive = get_post_type_archive_link('psm_news');

    return array(
        'url'    => $archive ? $archive : '#',
        'title'  => __('View All News', 'cmd-theme'),
        'target' => '',
    );
}
