<?php
/**
 * Boat Park page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Supporting the local boating community copy.
 *
 * @return string[]
 */
function psm_get_boat_park_community_paragraphs() {
    return array(
        __(
            'Port St Mary Boat Park provides managed mooring and storage facilities for residents and boat owners within the community. It is designed to support safe, organised, and accessible use of the harbour area while maintaining the coastal environment.',
            'cmd-theme'
        ),
        __(
            'We aim to ensure all boat park users enjoy a secure and well-maintained facility that supports both recreational and local fishing activities.',
            'cmd-theme'
        ),
    );
}

/**
 * Boat Park Facilities section intro.
 *
 * @return string
 */
function psm_get_boat_park_facilities_intro() {
    return __(
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'cmd-theme'
    );
}

/**
 * Boat park facility icon cards.
 *
 * @return array<int, array{icon: string, title: string, text: string}>
 */
function psm_get_boat_park_facilities() {
    return array(
        array(
            'icon'  => 'mooring',
            'title' => __('Mooring Spaces', 'cmd-theme'),
            'text'  => __(
                'Designated and well-managed mooring areas are available for local boat owners.',
                'cmd-theme'
            ),
        ),
        array(
            'icon'  => 'safe-access',
            'title' => __('Safe Access', 'cmd-theme'),
            'text'  => __(
                'The Boat Park provides clear and controlled access points to the harbour, helping ensure safe.',
                'cmd-theme'
            ),
        ),
        array(
            'icon'  => 'coastal',
            'title' => __('Coastal Management', 'cmd-theme'),
            'text'  => __(
                'The harbour and surrounding areas are carefully managed to protect the coastal environment.',
                'cmd-theme'
            ),
        ),
        array(
            'icon'  => 'maintenance',
            'title' => __('Maintenance Support', 'cmd-theme'),
            'text'  => __(
                'Regular maintenance is carried out to keep the Boat Park clean, safe, and fully operational.',
                'cmd-theme'
            ),
        ),
    );
}

/**
 * Mooring Applications section intro.
 *
 * @return string
 */
function psm_get_boat_park_mooring_intro() {
    return __(
        'Residents interested in using the Boat Park facilities must apply for mooring allocation. Applications are reviewed based on availability, suitability, & community requirements.',
        'cmd-theme'
    );
}

/**
 * Dummy YouTube video ID for the mooring applications section.
 *
 * @return string
 */
function psm_get_boat_park_mooring_video_id() {
    return 'M7lc1UVf-VE';
}

/**
 * Mooring application steps.
 *
 * @return array<int, array{number: string, icon: string, title: string, text: string}>
 */
function psm_get_boat_park_mooring_steps() {
    return array(
        array(
            'number' => '01',
            'icon'   => 'submit',
            'title'  => __('Submit Application', 'cmd-theme'),
            'text'   => __(
                'Provide details of your vessel and usage requirements',
                'cmd-theme'
            ),
        ),
        array(
            'number' => '02',
            'icon'   => 'review',
            'title'  => __('Review Process', 'cmd-theme'),
            'text'   => __(
                'Applications are assessed based on availability and regulations.',
                'cmd-theme'
            ),
        ),
        array(
            'number' => '03',
            'icon'   => 'allocation',
            'title'  => __('Allocation Confirmation', 'cmd-theme'),
            'text'   => __(
                'Approved applicants will be assigned suitable mooring space.',
                'cmd-theme'
            ),
        ),
    );
}
