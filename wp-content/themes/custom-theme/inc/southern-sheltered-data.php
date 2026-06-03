<?php
/**
 * Southern Sheltered page — static content fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * PDF download URL for housing tenders.
 *
 * @return string
 */
function psm_get_southern_sheltered_tenders_pdf_url() {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    $rel = '/assets/documents/southern-sheltered-tenders.pdf';

    if (is_readable($dir . $rel)) {
        return $uri . $rel;
    }

    return psm_sample_pdf_url();
}

/**
 * Default inner banner values for the Southern Sheltered page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_southern_sheltered_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Southern Sheltered', 'cmd-theme'),
        'ribbon' => __('Supporting Independent Living Across the South', 'cmd-theme'),
        'intro'  => __(
            'Information about sheltered housing, community housing tenders, and independent living support from Port St Mary Commissioners.',
            'cmd-theme'
        ),
    );
}

/**
 * Default Community Housing Tenders section.
 *
 * @return array{
 *     image: string,
 *     badge: string,
 *     title: string,
 *     lead: string,
 *     body: string,
 *     button: array{title: string, url: string, target: string}
 * }
 */
function psm_southern_sheltered_tenders_static() {
    return array(
        'image'  => psm_theme_image('southern-sheltered-main.jpg') ?: '',
        'badge'  => __('Southern Sheltered Housing', 'cmd-theme'),
        'title'  => __('Community Housing Tenders', 'cmd-theme'),
        'lead'   => __(
            'Port St Mary Commissioners invite tenders for community housing projects that support sheltered and independent living across the south of the Isle of Man.',
            'cmd-theme'
        ),
        'body'   => psm_housing_paragraphs_to_intro_html(
            array(
                __(
                    'Tender documents outline the scope, eligibility criteria, and submission requirements for contractors and partners interested in delivering high-quality sheltered housing solutions.',
                    'cmd-theme'
                ),
                __(
                    'All submissions are reviewed in line with our procurement policy to ensure value, quality, and long-term benefit for residents and the wider community.',
                    'cmd-theme'
                ),
                __(
                    'For further information about current opportunities or to request clarification on tender specifications, please contact the Commissioners\' office.',
                    'cmd-theme'
                ),
            )
        ),
        'button' => array(
            'title'  => __('Download PDF', 'cmd-theme'),
            'url'    => psm_get_southern_sheltered_tenders_pdf_url(),
            'target' => '',
        ),
    );
}
