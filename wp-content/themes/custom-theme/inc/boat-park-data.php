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
            'Port St Mary Commissioners manage the town boat park to support local boat owners, harbour users, and the wider boating community on the Isle of Man.',
            'cmd-theme'
        ),
        __(
            'We maintain moorings, slipway access, and related facilities so residents and visitors can enjoy safe, well-managed waterside amenities throughout the season.',
            'cmd-theme'
        ),
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
            'text'  => __('Allocated moorings for resident and visiting craft within the boat park.', 'cmd-theme'),
        ),
        array(
            'icon'  => 'slipway',
            'title' => __('Slipway Access', 'cmd-theme'),
            'text'  => __('Launch and recovery facilities for permitted vessels at scheduled times.', 'cmd-theme'),
        ),
        array(
            'icon'  => 'parking',
            'title' => __('Vehicle Parking', 'cmd-theme'),
            'text'  => __('Parking areas for boat owners and visitors using harbour facilities.', 'cmd-theme'),
        ),
        array(
            'icon'  => 'services',
            'title' => __('Harbour Services', 'cmd-theme'),
            'text'  => __('Support for harbour users including information and seasonal guidance.', 'cmd-theme'),
        ),
    );
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
            'icon'   => 'form',
            'title'  => __('Apply Online', 'cmd-theme'),
            'text'   => __(
                'Complete the mooring application form with vessel details, owner information, and preferred mooring period.',
                'cmd-theme'
            ),
        ),
        array(
            'number' => '02',
            'icon'   => 'documents',
            'title'  => __('Payment Policy', 'cmd-theme'),
            'text'   => __(
                'Review fees, payment deadlines, and accepted methods before submitting your application.',
                'cmd-theme'
            ),
        ),
        array(
            'number' => '03',
            'icon'   => 'assessment',
            'title'  => __('Allocation & Confirmation', 'cmd-theme'),
            'text'   => __(
                'Applications are assessed based on availability. Successful applicants receive confirmation and mooring details.',
                'cmd-theme'
            ),
        ),
    );
}
