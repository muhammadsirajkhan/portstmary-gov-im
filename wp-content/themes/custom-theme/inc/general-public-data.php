<?php
/**
 * General Public page — static fallback data.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Intro paragraphs for Supporting Local Housing (static).
 *
 * @return string[]
 */
function psm_general_public_intro_paragraphs_static() {
    return array(
        __(
            'Port St Mary Commissioners provide quality housing and essential services for residents, supporting a vibrant community where people can live with confidence and security.',
            'cmd-theme'
        ),
        __(
            'Our housing team works to meet local needs through general housing, sheltered accommodation, and ongoing support for tenants and applicants throughout Port St Mary.',
            'cmd-theme'
        ),
        __(
            'We are committed to fair allocation, transparent processes, and maintaining homes to a high standard for the benefit of the whole community.',
            'cmd-theme'
        ),
        __(
            'Whether you are applying for housing or seeking information about our services, we are here to guide you through each stage with clarity and care.',
            'cmd-theme'
        ),
    );
}

/**
 * Housing application process cards (static).
 *
 * @return array<int, array<string, string>>
 */
function psm_general_public_housing_steps_static() {
    $description = __(
        'Provide your personal and housing information.',
        'cmd-theme'
    );

    return array(
        array(
            'step'       => '01',
            'icon'       => 'form',
            'icon_image' => psm_theme_image('housing-step-form.png') ?: '',
            'title'      => __('Complete Application Form', 'cmd-theme'),
            'text'       => $description,
            'url'        => '#',
        ),
        array(
            'step'       => '02',
            'icon'       => 'documents',
            'icon_image' => psm_theme_image('housing-step-documents.png') ?: '',
            'title'      => __('Submit Supporting Documents', 'cmd-theme'),
            'text'       => $description,
            'url'        => '#',
        ),
        array(
            'step'       => '03',
            'icon'       => 'review',
            'icon_image' => psm_theme_image('housing-step-review.png') ?: '',
            'title'      => __('Application Review', 'cmd-theme'),
            'text'       => $description,
            'url'        => '#',
        ),
        array(
            'step'       => '04',
            'icon'       => 'waiting',
            'icon_image' => psm_theme_image('housing-step-waiting.png') ?: '',
            'title'      => __('Waiting List & Availability', 'cmd-theme'),
            'text'       => $description,
            'url'        => '#',
        ),
    );
}
