<?php
/**
 * Complaints page — ACF default values.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_complaints_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Complaints', 'cmd-theme'),
        'ribbon' => __('Support, Complaints & Guidance', 'cmd-theme'),
        'intro'  => __(
            'This issue can be resolved quickly through direct communication, and we appreciate the opportunity to assist you as efficiently as possible.',
            'cmd-theme'
        ),
    );
}

/**
 * Default how-to section values.
 *
 * @return array{badge: string, title: string, phone: string, email: string, button: array{title: string, url: string, target: string}}
 */
function psm_complaints_how_to_defaults() {
    return array(
        'badge'  => __('Complaints', 'cmd-theme'),
        'title'  => __('How to Make a Complaint', 'cmd-theme'),
        'phone'  => '+44 1624 832101',
        'email'  => 'commissioners@portstmary.gov.im',
        'button' => array(
            'title'  => __('Complaints Form', 'cmd-theme'),
            'url'    => '',
            'target' => '',
        ),
    );
}

/**
 * How-to body textarea default (one paragraph per line).
 *
 * @return string
 */
function psm_complaints_how_to_body_default_lines() {
    return implode(
        "\r\n",
        array(
            __(
                'If you have a concern about a service provided by Port St Mary Commissioners, we encourage you to contact us so the matter can be addressed as quickly as possible.',
                'cmd-theme'
            ),
            __(
                'We take all complaints seriously and aim to resolve them fairly, transparently and in confidence.',
                'cmd-theme'
            ),
            __(
                'Please use the telephone or email details below, or submit your complaint using our online form.',
                'cmd-theme'
            ),
        )
    );
}
