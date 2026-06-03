<?php
/**
 * Commissioners page — static fallback data.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Services list for Serving Port St Mary section.
 *
 * @return string[]
 */
function psm_commissioners_services_static() {
    return array(
        __('Refuse collection', 'cmd-theme'),
        __('Grass cutting', 'cmd-theme'),
        __('Beach cleaning', 'cmd-theme'),
        __('Street lighting', 'cmd-theme'),
        __('Local Authority Housing', 'cmd-theme'),
        __('Dog & Litter Byelaws', 'cmd-theme'),
        __('Abandoned vehicles', 'cmd-theme'),
        __('Commissioner owned car parks', 'cmd-theme'),
        __('Garden of Remembrance', 'cmd-theme'),
    );
}

/**
 * Officer profiles for Our Officers grid.
 *
 * @return array<int, array<string, string>>
 */
function psm_commissioners_officers_static() {
    return array(
        array(
            'name'       => 'Hayley Kinvig',
            'role'       => __('Clerk & Responsible Finance Officer', 'cmd-theme'),
            'tag'        => __('Officer', 'cmd-theme'),
            'image'      => '',
            'image_seed' => 'psm-officer-hayley',
            'tone'       => 'grey',
            'linkedin'   => '#',
        ),
        array(
            'name'       => 'Darleen Greenwood',
            'role'       => __('Housing Officer', 'cmd-theme'),
            'tag'        => __('Officer', 'cmd-theme'),
            'image'      => '',
            'image_seed' => 'psm-officer-darleen',
            'tone'       => 'teal',
            'linkedin'   => '#',
        ),
        array(
            'name'       => 'Sally-Ann Maiden',
            'role'       => __('Administration and Events Officer', 'cmd-theme'),
            'tag'        => __('Officer', 'cmd-theme'),
            'image'      => '',
            'image_seed' => 'psm-officer-sally-ann',
            'tone'       => 'rose',
            'linkedin'   => '#',
        ),
    );
}

/**
 * Office opening hours rows.
 *
 * @return array<int, array<string, mixed>>
 */
function psm_commissioners_opening_hours_static() {
    $today = strtolower(wp_date('l'));

    $rows = array(
        array(
            'slug'  => 'monday',
            'label' => __('Monday', 'cmd-theme'),
            'hours' => __('09:00 AM – 17:00 PM', 'cmd-theme'),
        ),
        array(
            'slug'  => 'tuesday',
            'label' => __('Tuesday', 'cmd-theme'),
            'hours' => __('09:00 AM – 17:00 PM', 'cmd-theme'),
        ),
        array(
            'slug'  => 'wednesday',
            'label' => __('Wednesday', 'cmd-theme'),
            'hours' => __('09:00 AM – 17:00 PM', 'cmd-theme'),
        ),
        array(
            'slug'  => 'thursday',
            'label' => __('Thursday', 'cmd-theme'),
            'hours' => __('09:00 AM – 17:00 PM', 'cmd-theme'),
        ),
        array(
            'slug'  => 'friday',
            'label' => __('Friday', 'cmd-theme'),
            'hours' => __('09:00 AM – 17:00 PM', 'cmd-theme'),
        ),
    );

    foreach ($rows as $index => $row) {
        $rows[ $index ]['is_today'] = ($today === $row['slug']);
    }

    return $rows;
}
