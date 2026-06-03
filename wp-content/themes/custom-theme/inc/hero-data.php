<?php
/**
 * Home hero — static slide and button fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default hero slide copy (first slide base + carousel items).
 *
 * @return array<int, array{kicker: string, title_1: string, title_2: string, ribbon: string, intro: string}>
 */
function psm_hero_slides_static() {
    return array(
        array(
            'kicker'  => __('Welcome to the', 'cmd-theme'),
            'title_1' => __('Port St Mary', 'cmd-theme'),
            'title_2' => __('Commissioners', 'cmd-theme'),
            'ribbon'  => __('Caring for our village together', 'cmd-theme'),
            'intro'   => __(
                'Port St Mary Commissioners are dedicated to supporting residents, maintaining public spaces, and ensuring the village remains a welcoming and vibrant place to live and visit.',
                'cmd-theme'
            ),
        ),
        array(
            'kicker'  => __('Serving our community', 'cmd-theme'),
            'title_1' => __('Local services', 'cmd-theme'),
            'title_2' => __('For residents', 'cmd-theme'),
            'ribbon'  => __('Supporting everyday village life', 'cmd-theme'),
            'intro'   => __(
                'From housing and refuse to public amenities, we work to keep Port St Mary well cared for and easy to live in.',
                'cmd-theme'
            ),
        ),
        array(
            'kicker'  => __('Protecting our spaces', 'cmd-theme'),
            'title_1' => __('Public', 'cmd-theme'),
            'title_2' => __('Amenities', 'cmd-theme'),
            'ribbon'  => __('Maintaining what matters most', 'cmd-theme'),
            'intro'   => __(
                'We look after parks, harbourside areas, and shared spaces so the village stays clean, safe, and welcoming for everyone.',
                'cmd-theme'
            ),
        ),
        array(
            'kicker'  => __('Have your say', 'cmd-theme'),
            'title_1' => __('Community', 'cmd-theme'),
            'title_2' => __('Engagement', 'cmd-theme'),
            'ribbon'  => __('Your voice shapes our village', 'cmd-theme'),
            'intro'   => __(
                'Stay informed about consultations, meetings, and local decisions that affect Port St Mary and its residents.',
                'cmd-theme'
            ),
        ),
        array(
            'kicker'  => __('Here to help', 'cmd-theme'),
            'title_1' => __('Get in', 'cmd-theme'),
            'title_2' => __('Touch', 'cmd-theme'),
            'ribbon'  => __('We are always here for you', 'cmd-theme'),
            'intro'   => __(
                'Whether you need to report an issue or find a service, our team is ready to support residents and visitors alike.',
                'cmd-theme'
            ),
        ),
    );
}

/**
 * Default hero CTA buttons.
 *
 * @return array{primary: array{title: string, url: string, target: string}, secondary: array{title: string, url: string, target: string}}
 */
function psm_hero_buttons_static() {
    return array(
        'primary'   => array(
            'title'  => __('Report an Issue', 'cmd-theme'),
            'url'    => function_exists('psm_contact_page_url') ? psm_contact_page_url() : home_url('/contact/'),
            'target' => '',
        ),
        'secondary' => array(
            'title'  => __('View Services', 'cmd-theme'),
            'url'    => home_url('/#services'),
            'target' => '',
        ),
    );
}

/**
 * Default hero background and labels.
 *
 * @return array{background: string, background_alt: string, side_label: string}
 */
function psm_hero_background_static() {
    $bg = function_exists('psm_theme_image') ? psm_theme_image('hero.png') : '';

    return array(
        'background'     => $bg ?: '',
        'background_alt' => __('Port St Mary harbor with boats and coastal houses', 'cmd-theme'),
        'side_label'     => __('Port St Mary Commissioners', 'cmd-theme'),
    );
}
