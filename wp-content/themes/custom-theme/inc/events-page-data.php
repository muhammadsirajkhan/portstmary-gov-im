<?php
/**
 * Events page — default values.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values for the Events page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_events_page_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Events', 'cmd-theme'),
        'ribbon' => __('Community Events & Activities', 'cmd-theme'),
        'intro'  => __(
            'Discover upcoming events, community gatherings, and local activities happening in and around Port St Mary.',
            'cmd-theme'
        ),
    );
}

/**
 * Default archive section header copy.
 *
 * @return array{badge: string, title: string, intro: string[]}
 */
function psm_events_page_archive_header_static() {
    return array(
        'badge' => __('Community Events', 'cmd-theme'),
        'title' => __('Upcoming Events', 'cmd-theme'),
        'intro' => array(
            __(
                'Stay up to date with community events, local gatherings, and activities organised in and around Port St Mary.',
                'cmd-theme'
            ),
            __(
                'Browse the events below for dates, details, and links to full event information.',
                'cmd-theme'
            ),
        ),
    );
}

/**
 * Posts per page on the Events archive list.
 *
 * @return int
 */
function psm_events_page_posts_per_page() {
    return 10;
}
