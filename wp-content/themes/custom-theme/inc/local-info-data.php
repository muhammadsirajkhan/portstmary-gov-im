<?php
/**
 * Local Info page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * About Port St Mary paragraphs.
 *
 * @return string[]
 */
function psm_get_local_info_about_paragraphs() {
    return array(
        __(
            'Port St Mary is a vibrant coastal town on the Isle of Man, known for its harbor, community spirit, and rich maritime heritage.',
            'cmd-theme'
        ),
        __(
            'The Commissioners serve residents by maintaining public services, supporting local facilities, and helping preserve the character and quality of life that make Port St Mary a special place to live and visit.',
            'cmd-theme'
        ),
        __(
            'Explore our history timeline below to discover how the town has grown from a fishing and trading port into the welcoming community it is today.',
            'cmd-theme'
        ),
    );
}

/**
 * History timeline entries.
 *
 * @return array<int, array<string, mixed>>
 */
function psm_get_local_info_timeline_entries() {
    return array(
        array(
            'layout'    => 'left',
            'period'    => __('1800s – 1900s', 'cmd-theme'),
            'icon'      => 'crane',
            'title'     => __('Maritime Trade & Harbor Growth', 'cmd-theme'),
            'text'      => __(
                'Port St Mary developed as a busy fishing and trading harbor, with growing infrastructure to support coastal commerce and the local economy.',
                'cmd-theme'
            ),
            'read_more' => array(
                'label' => __('Read More', 'cmd-theme'),
                'url'   => '#',
            ),
        ),
        array(
            'layout'    => 'right',
            'period'    => __('Early 1900s', 'cmd-theme'),
            'icon'      => 'ship',
            'title'     => __('Steamships & Coastal Connections', 'cmd-theme'),
            'text'      => __(
                'Steamship services strengthened links with the rest of the Isle of Man and beyond, bringing visitors and goods to the growing town.',
                'cmd-theme'
            ),
            'read_more' => array(
                'label' => __('Read More', 'cmd-theme'),
                'url'   => '#',
            ),
        ),
        array(
            'layout'    => 'left',
            'period'    => __('Mid 1900s', 'cmd-theme'),
            'icon'      => 'anchor',
            'title'     => __('Post-War Community Development', 'cmd-theme'),
            'text'      => __(
                'Investment in housing, public amenities, and harbor facilities helped Port St Mary adapt to changing times while retaining its coastal identity.',
                'cmd-theme'
            ),
            'read_more' => array(
                'label' => __('Read More', 'cmd-theme'),
                'url'   => '#',
            ),
        ),
        array(
            'layout'    => 'right',
            'period'    => __('Today', 'cmd-theme'),
            'icon'      => 'harbor',
            'title'     => __('A Modern Coastal Community', 'cmd-theme'),
            'text'      => __(
                'Today Port St Mary balances heritage and progress — a thriving harbor, active community life, and services managed for the benefit of residents and visitors.',
                'cmd-theme'
            ),
            'read_more' => array(
                'label' => __('Read More', 'cmd-theme'),
                'url'   => '#',
            ),
        ),
    );
}

/**
 * Timeline section footer resource links.
 *
 * @return array<int, array{label: string, url: string}>
 */
function psm_get_local_info_timeline_resources() {
    return array(
        array(
            'label' => __('Manx National Heritage', 'cmd-theme'),
            'url'   => '#',
        ),
        array(
            'label' => __('Isle of Man Government archives', 'cmd-theme'),
            'url'   => '#',
        ),
    );
}
