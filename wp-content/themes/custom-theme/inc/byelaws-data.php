<?php
/**
 * Byelaws page — ACF default values.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_byelaws_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Local Byelaws', 'cmd-theme'),
        'ribbon' => __('Helping Maintain Our Community', 'cmd-theme'),
        'intro'  => __(
            'View local byelaws, standing orders and community guidance published by Port St Mary Commissioners.',
            'cmd-theme'
        ),
    );
}

/**
 * Default guidance section values.
 *
 * @return array{badge: string, title: string, subheading: string}
 */
function psm_byelaws_guidance_defaults() {
    return array(
        'badge'       => __('Port St Mary Commissioners', 'cmd-theme'),
        'title'       => __('Guidance for Community Living', 'cmd-theme'),
        'subheading'  => __('Local Byelaws & Orders', 'cmd-theme'),
    );
}

/**
 * Guidance body textarea default (one paragraph per line).
 *
 * @return string
 */
function psm_byelaws_guidance_body_default_lines() {
    return implode(
        "\r\n",
        array(
            __(
                'The Commissioners of Port St Mary have made a number of byelaws & orders relating to Port St Mary, based upon those issued by Government and used by other local authorities.',
                'cmd-theme'
            ),
            __(
                'These regulations cover a range of topics relating to public behaviour, amenities, environmental responsibilities, and the use of community spaces.',
                'cmd-theme'
            ),
            __(
                'The various documents can be downloaded below:',
                'cmd-theme'
            ),
        )
    );
}

/**
 * Default document rows for the guidance repeater.
 *
 * @return array<int, array{byelaws_document_label: string}>
 */
function psm_byelaws_documents_default_rows() {
    return array(
        array('byelaws_document_label' => __('Standing Orders May 2025 Signed', 'cmd-theme')),
        array('byelaws_document_label' => __('Standing Orders on the making of Contracts May 2025 Signed', 'cmd-theme')),
        array('byelaws_document_label' => __('PortStMary (SpeedLimits) Order2025', 'cmd-theme')),
        array('byelaws_document_label' => __('Dog Byelaws with effect from 1st September 2017', 'cmd-theme')),
        array('byelaws_document_label' => __('The Port St Mary (Parking Places) Order 2006', 'cmd-theme')),
    );
}
