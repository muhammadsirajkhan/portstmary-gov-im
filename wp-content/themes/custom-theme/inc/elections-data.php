<?php
/**
 * Elections page — static content fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values for the Elections page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_elections_inner_banner_defaults() {
    return array(
        'kicker' => __('Elections', 'cmd-theme'),
        'title'  => __('General Election', 'cmd-theme'),
        'ribbon' => __('Your Community, Your Voice, Your Vote, Your Future', 'cmd-theme'),
        'intro'  => __(
            'Stay informed about elections, candidates, voting, and official notices from Port St Mary Commissioners.',
            'cmd-theme'
        ),
    );
}

/**
 * Default General Election Results section header.
 *
 * @return array{badge: string, title: string, intro: string}
 */
function psm_election_results_header_static() {
    return array(
        'badge' => __('Community Events', 'cmd-theme'),
        'title' => __('2025 General Election Results', 'cmd-theme'),
        'intro' => __(
            'We intend to use this page to promote election material and information supplied by both the Cabinet Office and any candidates who declare their interest to stand.',
            'cmd-theme'
        ),
    );
}

/**
 * Default General Election Results document cards.
 *
 * @return array<int, array{title: string, image: string, image_seed: string, url: string, alt: string}>
 */
function psm_election_results_documents_static() {
    return array(
        array(
            'title'      => __('Result for General Election 2025', 'cmd-theme'),
            'image'      => psm_theme_image('election-results-doc.jpg') ?: '',
            'image_seed' => 'psm-election-results-doc',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('Result for General Election 2025', 'cmd-theme'),
        ),
        array(
            'title'      => __('Result for Port St Mary Commissioners Uncontested General Election 2025', 'cmd-theme'),
            'image'      => psm_theme_image('election-results-graphic.jpg') ?: '',
            'image_seed' => 'psm-election-results-graphic',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('Port St Mary Commissioners uncontested general election 2025 result', 'cmd-theme'),
        ),
    );
}

/**
 * Default General Election Results footer paragraphs.
 *
 * @return string[]
 */
function psm_election_results_footer_text_static() {
    return array(
        __(
            'Port St Mary Commissioners will have 7 available seats available in the upcoming election.',
            'cmd-theme'
        ),
        sprintf(
            __(
                'Further information regarding Local Authorities and their functions can be found here on the following link, alternatively please contact the office on %1$s or %2$s for any Port St Mary specific related queries.',
                'cmd-theme'
            ),
            psm_get_site_phone_display(),
            'commissioners@portstmary.gov.im'
        ),
    );
}

/**
 * Results footer textarea default (one paragraph per line).
 *
 * @return string
 */
function psm_election_results_footer_body_default_lines() {
    return implode("\n", psm_election_results_footer_text_static());
}

/**
 * Default General Election Results footer link URL.
 *
 * @return string
 */
function psm_election_results_footer_link_static() {
    return 'https://www.gov.im/local-authority-elections';
}

/**
 * Default results document cards as ACF repeater rows.
 *
 * @return array<int, array<string, string>>
 */
function psm_election_results_cards_default_acf() {
    return array();
}

/**
 * Default Notice of Election section header.
 *
 * @return array{badge: string, title: string, intro: string}
 */
function psm_election_notice_header_static() {
    return array(
        'badge' => __('Voting', 'cmd-theme'),
        'title' => __('Notice of Election – 24 April 2025', 'cmd-theme'),
        'intro' => __(
            'A Notice of Election has been published for the Local Authorities General Election on 24 April 2025.',
            'cmd-theme'
        ),
    );
}

/**
 * Default Notice of Election document cards.
 *
 * @return array<int, array{title: string, image: string, image_seed: string, url: string, alt: string}>
 */
function psm_election_notice_documents_static() {
    return array(
        array(
            'title'      => __('Result for General Election 2025', 'cmd-theme'),
            'image'      => psm_theme_image('election-notice-1.jpg') ?: '',
            'image_seed' => 'psm-election-notice-1',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('Local Authorities General Election Timetable 24 April 2025', 'cmd-theme'),
        ),
        array(
            'title'      => __('Result for General Election 2025', 'cmd-theme'),
            'image'      => psm_theme_image('election-notice-2.jpg') ?: '',
            'image_seed' => 'psm-election-notice-2',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('Notice of Local Authorities General Election on 24 April 2025', 'cmd-theme'),
        ),
        array(
            'title'      => __('Result for General Election 2025', 'cmd-theme'),
            'image'      => psm_theme_image('election-notice-3.jpg') ?: '',
            'image_seed' => 'psm-election-notice-3',
            'url'        => psm_sample_pdf_url(),
            'alt'        => __('Notice of election document', 'cmd-theme'),
        ),
    );
}

/**
 * Default notice document cards as ACF repeater rows.
 *
 * @return array<int, array<string, string>>
 */
function psm_election_notice_cards_default_acf() {
    $rows = array();

    foreach (psm_election_notice_documents_static() as $item) {
        $rows[] = array(
            'election_doc_title' => $item['title'],
        );
    }

    return $rows;
}

/**
 * Default Candidates section.
 *
 * @return array{
 *     badge: string,
 *     title: string,
 *     lead: string,
 *     link_url: string,
 *     phone: string,
 *     email: string,
 *     image: string,
 *     video_id: string
 * }
 */
function psm_election_candidates_static() {
    return array(
        'badge'    => __('Candidates', 'cmd-theme'),
        'title'    => __('Candidates', 'cmd-theme'),
        'lead'     => __(
            'Anyone interested in standing for election should contact the Commissioners Office: Nomination forms and some additional general information for candidates can be found on the below link or hard copies will be available from the Commissioners Office located in the Town Hall.',
            'cmd-theme'
        ),
        'link_url' => 'https://www.gov.im/categories/home-and-neighbourhood/elections-and-voting/local-authority-election/stand-as-a-local-candidate/',
        'phone'    => psm_get_site_phone_display(),
        'email'    => 'commissioners@portstmary.gov.im',
        'image'    => psm_theme_image('election-candidate-main.jpg') ?: '',
        'video_id' => 'M7lc1UVf-VE',
    );
}

/**
 * Default Voting section.
 *
 * @return array{badge: string, title: string, intro: string, link_url: string, image: string}
 */
function psm_election_voting_static() {
    return array(
        'badge'    => __('Voting', 'cmd-theme'),
        'title'    => __('Voting', 'cmd-theme'),
        'intro'    => __(
            'Information for anyone wishing to vote in a Local Authority election is available on the how to vote web page by following the below link.',
            'cmd-theme'
        ),
        'link_url' => 'https://www.gov.im/categories/home-and-neighbourhood/elections-and-voting/local-authority-election/how-to-vote/',
        'image'    => psm_theme_image('election-voting.jpg') ?: '',
    );
}
