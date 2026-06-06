<?php
/**
 * Boat Park page — static content fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values for the Boat Park page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_boat_park_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Our Boat Park', 'cmd-theme'),
        'ribbon' => __('Your Community Boat Park', 'cmd-theme'),
        'intro'  => __(
            'Moorings, slipway access, and harbour facilities managed for the Port St Mary boating community.',
            'cmd-theme'
        ),
    );
}

/**
 * Default Supporting Community section.
 *
 * @return array{
 *     badge: string,
 *     title: string,
 *     paragraphs: string[],
 *     image_harbor: string,
 *     image_lighthouse: string
 * }
 */
function psm_boat_park_community_static() {
    return array(
        'badge'            => __('Port St Mary Commissioners', 'cmd-theme'),
        'title'            => __('Supporting the Local and Boating Community', 'cmd-theme'),
        'paragraphs'       => array(
            __(
                'Port St Mary Boat Park provides managed mooring and storage facilities for residents and boat owners within the community. It is designed to support safe, organised, and accessible use of the harbour area while maintaining the coastal environment.',
                'cmd-theme'
            ),
            __(
                'We aim to ensure all boat park users enjoy a secure and well-maintained facility that supports both recreational and local fishing activities.',
                'cmd-theme'
            ),
        ),
        'image_harbor'     => psm_theme_image('boat-park-harbor.jpg') ?: '',
        'image_lighthouse' => psm_theme_image('boat-park-lighthouse.jpg') ?: '',
    );
}

/**
 * Community body textarea default (one paragraph per line).
 *
 * @return string
 */
function psm_boat_park_community_body_default_lines() {
    return implode("\n", psm_boat_park_community_static()['paragraphs']);
}

/**
 * Default Boat Park Facilities section.
 *
 * @return array{
 *     badge: string,
 *     title: string,
 *     intro: string,
 *     feature_image: string,
 *     cards: array<int, array{icon: string, icon_image: string, title: string, text: string}>
 * }
 */
function psm_boat_park_facilities_static() {
    return array(
        'badge'         => __('Port St Mary Commissioners', 'cmd-theme'),
        'title'         => __('Boat Park Facilities', 'cmd-theme'),
        'intro'         => __(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'cmd-theme'
        ),
        'feature_image' => psm_theme_image('boat-park-pier.jpg') ?: '',
        'cards'         => array(
            array(
                'icon'       => 'mooring',
                'icon_image' => '',
                'title'      => __('Mooring Spaces', 'cmd-theme'),
                'text'  => __(
                    'Designated and well-managed mooring areas are available for local boat owners.',
                    'cmd-theme'
                ),
            ),
            array(
                'icon'       => 'safe-access',
                'icon_image' => '',
                'title'      => __('Safe Access', 'cmd-theme'),
                'text'  => __(
                    'The Boat Park provides clear and controlled access points to the harbour, helping ensure safe.',
                    'cmd-theme'
                ),
            ),
            array(
                'icon'       => 'coastal',
                'icon_image' => '',
                'title'      => __('Coastal Management', 'cmd-theme'),
                'text'  => __(
                    'The harbour and surrounding areas are carefully managed to protect the coastal environment.',
                    'cmd-theme'
                ),
            ),
            array(
                'icon'       => 'maintenance',
                'icon_image' => '',
                'title'      => __('Maintenance Support', 'cmd-theme'),
                'text'  => __(
                    'Regular maintenance is carried out to keep the Boat Park clean, safe, and fully operational.',
                    'cmd-theme'
                ),
            ),
        ),
    );
}

/**
 * Default facility cards as ACF repeater rows.
 *
 * @return array<int, array<string, string>>
 */
function psm_boat_park_facility_cards_default_acf() {
    $rows = array();

    foreach (psm_boat_park_facilities_static()['cards'] as $card) {
        $rows[] = array(
            'facility_card_title' => $card['title'],
            'facility_card_text'  => $card['text'],
        );
    }

    return $rows;
}

/**
 * Default Mooring Applications section.
 *
 * @return array{
 *     badge: string,
 *     title: string,
 *     intro: string,
 *     image: string,
 *     video_id: string,
 *     steps: array<int, array{number: string, icon: string, icon_image: string, title: string, text: string}>
 * }
 */
function psm_boat_park_mooring_static() {
    return array(
        'badge'    => __('Boat Park', 'cmd-theme'),
        'title'    => __('Mooring Applications', 'cmd-theme'),
        'intro'    => __(
            'Residents interested in using the Boat Park facilities must apply for mooring allocation. Applications are reviewed based on availability, suitability, & community requirements.',
            'cmd-theme'
        ),
        'image'    => psm_theme_image('boat-park-mooring.jpg') ?: '',
        'video_id' => 'M7lc1UVf-VE',
        'steps'    => array(
            array(
                'number'     => '01',
                'icon'       => 'submit',
                'icon_image' => '',
                'title'      => __('Submit Application', 'cmd-theme'),
                'text'   => __(
                    'Provide details of your vessel and usage requirements',
                    'cmd-theme'
                ),
            ),
            array(
                'number'     => '02',
                'icon'       => 'review',
                'icon_image' => '',
                'title'      => __('Review Process', 'cmd-theme'),
                'text'   => __(
                    'Applications are assessed based on availability and regulations.',
                    'cmd-theme'
                ),
            ),
            array(
                'number'     => '03',
                'icon'       => 'allocation',
                'icon_image' => '',
                'title'      => __('Allocation Confirmation', 'cmd-theme'),
                'text'   => __(
                    'Approved applicants will be assigned suitable mooring space.',
                    'cmd-theme'
                ),
            ),
        ),
    );
}

/**
 * Default mooring steps as ACF repeater rows.
 *
 * @return array<int, array<string, string>>
 */
function psm_boat_park_mooring_steps_default_acf() {
    $rows = array();

    foreach (psm_boat_park_mooring_static()['steps'] as $step) {
        $rows[] = array(
            'mooring_step_title' => $step['title'],
            'mooring_step_text'  => $step['text'],
        );
    }

    return $rows;
}

/**
 * CSS icon fallback keys for facility cards (when no image is uploaded).
 *
 * @return string[]
 */
function psm_boat_park_facility_icon_keys() {
    return array('mooring', 'safe-access', 'coastal', 'maintenance');
}

/**
 * CSS icon fallback keys for mooring steps (when no image is uploaded).
 *
 * @return string[]
 */
function psm_boat_park_mooring_step_icon_keys() {
    return array('submit', 'review', 'allocation');
}
