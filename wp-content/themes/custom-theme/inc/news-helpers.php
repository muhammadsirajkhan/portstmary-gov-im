<?php
/**
 * News helpers — card args and home section queries.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Published time label for news cards and single posts.
 *
 * @param int    $post_id Post ID.
 * @param string $context carousel|archive|single.
 * @return string
 */
function psm_get_news_published_time_label($post_id, $context = 'carousel') {
    $post_id = (int) $post_id;
    if ($post_id <= 0) {
        return '';
    }

    if ('single' === $context) {
        return get_the_date('j F Y', $post_id);
    }

    return sprintf(
        /* translators: %s: human-readable time difference */
        __('%s ago', 'cmd-theme'),
        human_time_diff(get_post_time('U', true, $post_id), current_time('timestamp'))
    );
}

/**
 * Build news-card template args from a psm_news post.
 *
 * @param int   $post_id Post ID.
 * @param array $args    Optional context { context: carousel|archive }.
 * @return array
 */
function psm_get_news_card_args($post_id, $args = array()) {
    $args = wp_parse_args(
        $args,
        array(
            'context' => 'carousel',
        )
    );

    $post_id = (int) $post_id;
    if ($post_id <= 0) {
        return array();
    }

    $title = get_the_title($post_id);

    $category = '';
    $excerpt  = '';

    if (function_exists('get_field')) {
        $category = get_field('news_category', $post_id);
        $excerpt  = get_field('news_excerpt', $post_id);
    }

    $category = trim((string) $category);
    $excerpt  = trim((string) $excerpt);
    $time     = psm_get_news_published_time_label($post_id, $args['context']);

    $image = '';
    if (function_exists('get_field')) {
        $image = psm_normalize_acf_image_url(get_field('news_image', $post_id));
    }
    if ('' === $image) {
        $image = get_the_post_thumbnail_url($post_id, 'large') ?: '';
    }

    $url = get_permalink($post_id) ?: '';
    if ('carousel' === $args['context'] && function_exists('get_field')) {
        $link = get_field('news_link', $post_id);
        if (is_array($link) && !empty($link['url'])) {
            $url = trim((string) $link['url']);
        }
    }

    return array(
        'category'        => $category,
        'time'            => $time,
        'time_uppercase'  => 'archive' !== $args['context'],
        'title'           => trim((string) $title),
        'excerpt'         => $excerpt,
        'url'             => trim((string) $url),
        'image'           => trim((string) $image),
        'image_alt'       => trim((string) $title),
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
 * URL of the News archive page (page-news.php template).
 *
 * @return string
 */
function psm_get_news_page_url() {
    $pages = get_pages(
        array(
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'page-news.php',
            'number'     => 1,
        )
    );

    if (!empty($pages[0])) {
        $url = get_permalink($pages[0]->ID);
        if ($url) {
            return $url;
        }
    }

    return home_url('/news/');
}

/**
 * Breadcrumb trail for a single news item.
 *
 * @param int $post_id Post ID.
 * @return array<int, array{label: string, url: string}>
 */
function psm_get_news_single_breadcrumbs($post_id) {
    $post_id = (int) $post_id;
    $title   = $post_id > 0 ? get_the_title($post_id) : '';

    return array(
        array(
            'label' => __('Home', 'cmd-theme'),
            'url'   => home_url('/'),
        ),
        array(
            'label' => __('News & Updates', 'cmd-theme'),
            'url'   => psm_get_news_page_url(),
        ),
        array(
            'label' => $title ?: __('News', 'cmd-theme'),
            'url'   => '',
        ),
    );
}

/**
 * Display data for the single news template.
 *
 * @param int $post_id Post ID.
 * @return array{
 *     title: string,
 *     category: string,
 *     time: string,
 *     image: string,
 *     image_alt: string,
 *     breadcrumb: array
 * }
 */
function psm_get_news_single_data($post_id) {
    $post_id = (int) $post_id;
    if ($post_id <= 0) {
        return array();
    }

    $card = psm_get_news_card_args($post_id, array('context' => 'single'));

    return array(
        'title'      => $card['title'] ?? '',
        'category'   => $card['category'] ?? '',
        'time'       => $card['time'] ?? '',
        'image'      => $card['image'] ?? '',
        'image_alt'  => $card['image_alt'] ?? '',
        'breadcrumb' => psm_get_news_single_breadcrumbs($post_id),
    );
}

/**
 * Default link array for the home news footer button.
 *
 * @return array{url: string, title: string, target: string}
 */
function psm_news_default_button() {
    $url = psm_get_news_page_url();

    return array(
        'url'    => $url,
        'title'  => __('View All News', 'cmd-theme'),
        'target' => '',
    );
}
