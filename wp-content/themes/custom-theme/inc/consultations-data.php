<?php
/**
 * Consultations page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Community consultation intro paragraphs.
 *
 * @return string[]
 */
function psm_get_consultation_engagement_paragraphs() {
    return array(
        __(
            'Port St Mary Commissioners are committed to open consultation and meaningful engagement with residents, businesses, and community groups.',
            'cmd-theme'
        ),
        __(
            'We publish consultations on local projects and policy decisions so you can review proposals, share feedback, and help shape outcomes that affect Port St Mary.',
            'cmd-theme'
        ),
        __(
            'Your views inform how we plan services, invest in facilities, and prioritise improvements across the town.',
            'cmd-theme'
        ),
    );
}

/**
 * Active consultation cards.
 *
 * @return array<int, array{title: string, url: string, image: string, image_seed: string}>
 */
function psm_get_current_consultations() {
    $items = array(
        array(
            'title'      => __('Community Plan', 'cmd-theme'),
            'image_seed' => 'psm-consult-1',
        ),
        array(
            'title'      => __('The Harbour', 'cmd-theme'),
            'image_seed' => 'psm-consult-2',
        ),
        array(
            'title'      => __("St Mary's Well", 'cmd-theme'),
            'image_seed' => 'psm-consult-3',
        ),
        array(
            'title'      => __('Housing Strategy', 'cmd-theme'),
            'image_seed' => 'psm-consult-4',
        ),
        array(
            'title'      => __('Public Spaces', 'cmd-theme'),
            'image_seed' => 'psm-consult-5',
        ),
    );

    foreach ($items as $index => $item) {
        $file = 'consultation-' . ( $index + 1 ) . '.jpg';
        $items[ $index ]['image'] = psm_theme_image($file) ?: '';
        $items[ $index ]['url']  = '#';
    }

    return $items;
}

/**
 * Why feedback matters value cards.
 *
 * @return array<int, array{icon: string, title: string, text: string}>
 */
function psm_get_consultation_feedback_values() {
    return array(
        array(
            'icon'  => 'community',
            'title' => __('Community Improvements', 'cmd-theme'),
            'text'  => __('Feedback helps us prioritise projects that deliver real benefits for residents and local organisations.', 'cmd-theme'),
        ),
        array(
            'icon'  => 'voice',
            'title' => __('Inclusive Decisions', 'cmd-theme'),
            'text'  => __('Consultation ensures a range of voices are heard before Commissioners make important local decisions.', 'cmd-theme'),
        ),
        array(
            'icon'  => 'transparency',
            'title' => __('Transparent Process', 'cmd-theme'),
            'text'  => __('We publish clear information about proposals, timelines, and how responses are considered.', 'cmd-theme'),
        ),
        array(
            'icon'  => 'services',
            'title' => __('Better Local Services', 'cmd-theme'),
            'text'  => __('Your input supports improvements to housing, amenities, harbour facilities, and everyday town services.', 'cmd-theme'),
        ),
    );
}
