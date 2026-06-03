<?php
/**
 * Elections page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * 2025 General Election Results document cards.
 *
 * @return array<int, array{image: string, image_seed: string, url: string, alt: string}>
 */
function psm_get_election_results_documents() {
    return array(
        array(
            'image'      => psm_theme_image('election-results-doc.jpg') ?: '',
            'image_seed' => 'psm-election-results-doc',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('2025 General Election results document', 'cmd-theme'),
        ),
        array(
            'image'      => psm_theme_image('election-results-graphic.jpg') ?: '',
            'image_seed' => 'psm-election-results-graphic',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('Election results summary graphic', 'cmd-theme'),
        ),
    );
}

/**
 * Notice of Election document cards.
 *
 * @return array<int, array{image: string, image_seed: string, url: string, alt: string}>
 */
function psm_get_election_notice_documents() {
    return array(
        array(
            'image'      => psm_theme_image('election-notice-1.jpg') ?: '',
            'image_seed' => 'psm-election-notice-1',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('Notice of election document', 'cmd-theme'),
        ),
        array(
            'image'      => psm_theme_image('election-notice-2.jpg') ?: '',
            'image_seed' => 'psm-election-notice-2',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('Notice of election supplementary document', 'cmd-theme'),
        ),
    );
}

/**
 * Candidates section copy and links.
 *
 * @return array{lead: string, links: array<int, array{label: string, url: string, icon: string}>}
 */
function psm_get_election_candidates_content() {
    return array(
        'lead'  => __(
            'Candidates standing for election to Port St Mary Commissioners are listed below. Please review candidate information before casting your vote.',
            'cmd-theme'
        ),
        'links' => array(
            array(
                'label' => __('View Candidate List', 'cmd-theme'),
                'url'   => '#',
                'icon'  => 'arrow',
            ),
            array(
                'label' => __('Contact the Returning Officer', 'cmd-theme'),
                'url'   => 'tel:+441624832101',
                'icon'  => 'phone',
            ),
            array(
                'label' => __('Email the Elections Team', 'cmd-theme'),
                'url'   => 'mailto:info@portstmary.im',
                'icon'  => 'email',
            ),
        ),
    );
}
