<?php
/**
 * Elections page template.
 *
 * Template Name: Elections Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-elections">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Elections', 'cmd-theme'),
            'title'      => __('General Election', 'cmd-theme'),
            'ribbon'     => __('Your Community, Your Voice, Your Vote, Your Future', 'cmd-theme'),
            'intro'      => __(
                'Stay informed about elections, candidates, voting, and official notices from Port St Mary Commissioners.',
                'cmd-theme'
            ),
            'image'      => psm_theme_image('elections-banner.jpg'),
            'image_seed' => 'psm-elections-banner',
            'heading_id' => 'psm-elections-page-title',
            'breadcrumb' => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('Elections', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
        )
    );

    get_template_part(
        'template-parts/sections/election-documents',
        null,
        array(
            'section_id'  => 'election-results',
            'heading_id'  => 'psm-election-results-heading',
            'title'       => __('2025 General Election Results', 'cmd-theme'),
            'intro'       => array(
                __(
                    'View published results and summary documents from the 2025 General Election for Port St Mary Commissioners.',
                    'cmd-theme'
                ),
            ),
            'documents'   => psm_get_election_results_documents(),
            'footer_link' => array(
                'label' => __('Click here to view full results', 'cmd-theme'),
                'url'   => '#',
            ),
        )
    );

    get_template_part('template-parts/sections/elections-candidates');

    get_template_part('template-parts/sections/elections-voting');

    get_template_part(
        'template-parts/sections/election-documents',
        null,
        array(
            'section_class' => 'psm-election-documents--notice',
            'section_id'      => 'notice-of-election',
            'heading_id'      => 'psm-election-notice-heading',
            'title'           => __('Notice of Election — 24 April 2025', 'cmd-theme'),
            'intro'           => array(
                __(
                    'Official notice of election documents published in accordance with election procedures.',
                    'cmd-theme'
                ),
            ),
            'documents'     => psm_get_election_notice_documents(),
            'footer_link'   => array(),
        )
    );

    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'badge'       => __('Stay Updated', 'cmd-theme'),
            'badge_style' => 'red',
        )
    );
    ?>
</main>

<?php
get_footer();
