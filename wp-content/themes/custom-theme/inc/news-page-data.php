<?php
/**
 * News page — static content fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values for the News page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_news_page_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('News & Updates', 'cmd-theme'),
        'ribbon' => __('Community Updates & Important Notices', 'cmd-theme'),
        'intro'  => __(
            'Stay informed with the latest community news, service updates, and important notices from Port St Mary Commissioners.',
            'cmd-theme'
        ),
    );
}

/**
 * Default archive section header copy.
 *
 * @return array{badge: string, title: string, intro: string[]}
 */
function psm_news_page_archive_header_static() {
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
    );
}

/**
 * Posts per page on the News archive grid.
 *
 * @return int
 */
function psm_news_page_posts_per_page() {
    return 9;
}

/**
 * Default image badge on news archive cards.
 *
 * @return string
 */
function psm_news_page_image_badge_default() {
    return __('Community', 'cmd-theme');
}
