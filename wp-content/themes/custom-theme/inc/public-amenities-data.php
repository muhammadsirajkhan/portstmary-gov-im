<?php
/**
 * Public Amenities page — static content fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values for the Public Amenities page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_public_amenities_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Public Amenities', 'cmd-theme'),
        'ribbon' => __('Facilities for Modern Day Living', 'cmd-theme'),
        'intro'  => __(
            'Discover parks, allotments, parking, and public facilities maintained for the Port St Mary community.',
            'cmd-theme'
        ),
    );
}

/**
 * Default Supporting Community Spaces section.
 *
 * @return array{
 *     image: string,
 *     layout: string,
 *     badge: string,
 *     title: string,
 *     paragraphs: string[]
 * }
 */
function psm_public_amenities_intro_static() {
    return array(
        'image'      => psm_theme_image('amenities-community-main.jpg') ?: '',
        'layout'     => 'image-left',
        'badge'      => __('Public Amenities', 'cmd-theme'),
        'title'      => __('Supporting Community Spaces', 'cmd-theme'),
        'paragraphs' => array(
            __(
                'Port St Mary Commissioners maintain parks, open spaces, allotments, and public facilities that support everyday life and community wellbeing across the town.',
                'cmd-theme'
            ),
            __(
                'Our team works to keep these spaces clean, accessible, and welcoming for residents and visitors — from harbour walks and play areas to parking and community gardens.',
                'cmd-theme'
            ),
            __(
                'Explore the facilities below to learn more about what we provide and how you can use or access public amenities in Port St Mary.',
                'cmd-theme'
            ),
        ),
    );
}

/**
 * Intro body textarea default (one paragraph per line).
 *
 * @return string
 */
function psm_public_amenities_intro_body_default_lines() {
    return implode(
        "\n",
        psm_public_amenities_intro_static()['paragraphs']
    );
}

/**
 * Default Community Spaces & Facilities section header.
 *
 * @return array{badge: string, title: string}
 */
function psm_public_amenities_facilities_header_static() {
    return array(
        'badge' => __('Port St Mary Commissioners', 'cmd-theme'),
        'title' => __('Community Spaces & Facilities', 'cmd-theme'),
    );
}

/**
 * Default facility rows for the Public Amenities page.
 *
 * @return array<int, array<string, mixed>>
 */
function psm_public_amenities_facility_rows_static() {
    return array(
        array(
            'layout'     => 'card-left',
            'title'      => __('Parks & Open Spaces', 'cmd-theme'),
            'text'       => __(
                'Our parks and public open spaces provide opportunities for relaxation, recreation, and community enjoyment in a safe and attractive environment.',
                'cmd-theme'
            ),
            'text_extra' => '',
            'list_items' => array(
                __('Landscaped Green Spaces', 'cmd-theme'),
                __('Family-Friendly Areas', 'cmd-theme'),
                __('Coastal Walks', 'cmd-theme'),
                __('Seating & Picnic Areas', 'cmd-theme'),
                __('Community Recreation Spaces', 'cmd-theme'),
            ),
            'read_more'  => array(
                'label' => __('Read More', 'cmd-theme'),
                'url'   => '#',
            ),
            'image'      => psm_theme_image('amenities-parks.jpg') ?: '',
            'image_seed' => 'psm-amenities-parks',
        ),
        array(
            'layout'     => 'card-right',
            'title'      => __('Community Allotments', 'cmd-theme'),
            'text'       => __(
                'Our community allotments offer residents the opportunity to cultivate produce in a peaceful, shared environment, supporting local food initiatives and outdoor activity.',
                'cmd-theme'
            ),
            'text_extra' => __(
                'Plots are managed in line with local guidelines to maintain a tidy, productive setting that benefits all allotment holders and the wider community.',
                'cmd-theme'
            ),
            'list_items' => array(),
            'read_more'  => array(
                'label' => __('Read More', 'cmd-theme'),
                'url'   => '#',
            ),
            'image'      => psm_theme_image('amenities-allotments.jpg') ?: '',
            'image_seed' => 'psm-amenities-allotments',
        ),
        array(
            'layout'     => 'card-left',
            'title'      => __('Parking Facilities', 'cmd-theme'),
            'text'       => __(
                'Public parking areas are available throughout Port St Mary to support residents, visitors, and access to local amenities and coastal attractions.',
                'cmd-theme'
            ),
            'text_extra' => '',
            'list_items' => array(
                __('Local Parking Guidance', 'cmd-theme'),
                __('Coastal Access Parking', 'cmd-theme'),
                __('Public Car Parks', 'cmd-theme'),
                __('Accessibility Information', 'cmd-theme'),
            ),
            'read_more'  => array(
                'label' => __('Read More', 'cmd-theme'),
                'url'   => '#',
            ),
            'image'      => psm_theme_image('amenities-parking.jpg') ?: '',
            'image_seed' => 'psm-amenities-parking',
        ),
    );
}

/**
 * Default ACF repeater rows for facility rows.
 *
 * @return array<int, array<string, mixed>>
 */
function psm_public_amenities_facility_rows_default_acf() {
    $rows = array();

    foreach (psm_public_amenities_facility_rows_static() as $row) {
        $benefits = '';
        if (!empty($row['list_items']) && is_array($row['list_items'])) {
            $benefits = implode("\n", $row['list_items']);
        }

        $button = isset($row['read_more']) && is_array($row['read_more']) ? $row['read_more'] : array();

        $rows[] = array(
            'amenities_row_layout'     => isset($row['layout']) ? (string) $row['layout'] : 'card-left',
            'amenities_row_title'      => isset($row['title']) ? (string) $row['title'] : '',
            'amenities_row_text'       => isset($row['text']) ? (string) $row['text'] : '',
            'amenities_row_text_extra' => isset($row['text_extra']) ? (string) $row['text_extra'] : '',
            'amenities_row_benefits'   => $benefits,
            'amenities_row_button'     => array(
                'title'  => isset($button['label']) ? (string) $button['label'] : '',
                'url'    => isset($button['url']) ? (string) $button['url'] : '',
                'target' => '',
            ),
            'amenities_row_image'      => isset($row['image']) ? (string) $row['image'] : '',
        );
    }

    return $rows;
}
