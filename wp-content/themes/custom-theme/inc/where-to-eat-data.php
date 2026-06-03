<?php
/**
 * Where to Eat page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Places to eat listings.
 *
 * @return array<int, array<string, string>>
 */
function psm_get_where_to_eat_places() {
    return array(
        array(
            'title'         => __('Cornerhouse Coffee', 'cmd-theme'),
            'location'      => __('Bay View Road, Port St Mary', 'cmd-theme'),
            'phone'         => __('+44 (0)1624 832200', 'cmd-theme'),
            'phone_href'    => 'tel:+441624832200',
            'location_url'  => '#',
            'image'         => '',
            'image_seed'    => 'psm-where-to-eat-1',
        ),
        array(
            'title'         => __('Harbour Kitchen', 'cmd-theme'),
            'location'      => __('The Promenade, Port St Mary', 'cmd-theme'),
            'phone'         => __('+44 (0)1624 832210', 'cmd-theme'),
            'phone_href'    => 'tel:+441624832210',
            'location_url'  => '#',
            'image'         => '',
            'image_seed'    => 'psm-where-to-eat-2',
        ),
        array(
            'title'         => __('The Coastline Bistro', 'cmd-theme'),
            'location'      => __('Station Road, Port St Mary', 'cmd-theme'),
            'phone'         => __('+44 (0)1624 832220', 'cmd-theme'),
            'phone_href'    => 'tel:+441624832220',
            'location_url'  => '#',
            'image'         => '',
            'image_seed'    => 'psm-where-to-eat-3',
        ),
        array(
            'title'         => __('Shoreline Fish & Chips', 'cmd-theme'),
            'location'      => __('Athol Street, Port St Mary', 'cmd-theme'),
            'phone'         => __('+44 (0)1624 832230', 'cmd-theme'),
            'phone_href'    => 'tel:+441624832230',
            'location_url'  => '#',
            'image'         => '',
            'image_seed'    => 'psm-where-to-eat-4',
        ),
        array(
            'title'         => __('Marina View Restaurant', 'cmd-theme'),
            'location'      => __('Albany Road, Port St Mary', 'cmd-theme'),
            'phone'         => __('+44 (0)1624 832240', 'cmd-theme'),
            'phone_href'    => 'tel:+441624832240',
            'location_url'  => '#',
            'image'         => '',
            'image_seed'    => 'psm-where-to-eat-5',
        ),
    );
}
