<?php
/**
 * Public Amenities page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Supporting Community Spaces intro copy.
 *
 * @return string[]
 */
function psm_get_amenities_community_spaces_paragraphs() {
    return array(
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
    );
}

/**
 * Community Spaces & Facilities alternating rows.
 *
 * @return array<int, array<string, mixed>>
 */
function psm_get_amenities_facility_rows() {
    return array(
        array(
            'layout'     => 'card-left',
            'title'      => __('Parks & Open Spaces', 'cmd-theme'),
            'text'       => __(
                'Our parks and public open spaces provide opportunities for relaxation, recreation, and community enjoyment in a safe and attractive environment.',
                'cmd-theme'
            ),
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
