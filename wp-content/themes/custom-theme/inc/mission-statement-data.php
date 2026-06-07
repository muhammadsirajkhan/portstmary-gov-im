<?php
/**
 * Board Mission Statement page — ACF default values.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_mission_statement_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners Board', 'cmd-theme'),
        'title'  => __('Mission Statement', 'cmd-theme'),
        'ribbon' => __('Serving Our Community Together', 'cmd-theme'),
        'intro'  => __(
            'Working together to support our local community and ensure Port St Mary remains a vibrant, welcoming and safe place for all.',
            'cmd-theme'
        ),
    );
}

/**
 * Default commitment section values.
 *
 * @return array{badge: string, title: string, document_label: string}
 */
function psm_mission_statement_commitment_defaults() {
    return array(
        'badge'          => __('Port St Mary Mission Statement', 'cmd-theme'),
        'title'          => __('Our Commitment to the Community', 'cmd-theme'),
        'document_label' => __('BM Mission Statement July 2024', 'cmd-theme'),
    );
}

/**
 * Commitment body textarea default (one paragraph per line).
 *
 * @return string
 */
function psm_mission_statement_commitment_body_default_lines() {
    return implode(
        "\r\n",
        array(
            __(
                'The Port St Mary Commissioners are committed to serving our community with transparency, integrity and care. Our mission is to support local needs, maintain essential services and help Port St Mary thrive as a vibrant seaside village.',
                'cmd-theme'
            ),
            __(
                'We work collaboratively with residents, local organisations and stakeholders to deliver services that reflect the values and priorities of our community. Through open communication and responsible stewardship, we aim to build trust and strengthen community engagement.',
                'cmd-theme'
            ),
            __(
                'Our focus is on maintaining public spaces, supporting local initiatives and ensuring that decisions are made in the best interests of those who live, work and visit Port St Mary. We are dedicated to listening, responding and acting with accountability at all times.',
                'cmd-theme'
            ),
        )
    );
}
