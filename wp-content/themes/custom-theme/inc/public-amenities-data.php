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
                'Enjoy well-kept parks and open spaces for recreation, events, and relaxation throughout Port St Mary.',
                'cmd-theme'
            ),
            'list_items' => array(
                __('Play areas and green spaces', 'cmd-theme'),
                __('Seasonal planting and maintenance', 'cmd-theme'),
                __('Accessible paths and seating', 'cmd-theme'),
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
                'Community allotments provide residents with space to grow produce, support local food initiatives, and enjoy outdoor activity in a shared setting.',
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
                'Public parking supports access to the harbour, shops, and community facilities while helping manage traffic flow in the town centre.',
                'cmd-theme'
            ),
            'list_items' => array(
                __('Harbour and town centre parking', 'cmd-theme'),
                __('Clear signage and marked bays', 'cmd-theme'),
                __('Ongoing monitoring and maintenance', 'cmd-theme'),
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
