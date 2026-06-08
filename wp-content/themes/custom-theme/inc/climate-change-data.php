<?php
/**
 * Climate Change page — ACF default values.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_climate_change_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Climate Change', 'cmd-theme'),
        'ribbon' => __('Environment & Sustainability', 'cmd-theme'),
        'intro'  => __(
            'We are committed to addressing climate change through responsible local action, protecting our coastal environment, and supporting sustainable practices within the community.',
            'cmd-theme'
        ),
    );
}

/**
 * Default commitment section values.
 *
 * @return array{badge: string, title: string, document_label: string}
 */
function psm_climate_change_commitment_defaults() {
    $mission = psm_mission_statement_commitment_defaults();

    return array(
        'badge'          => $mission['badge'],
        'title'          => $mission['title'],
        'document_label' => $mission['document_label'],
    );
}

/**
 * Commitment body textarea default (one paragraph per line).
 *
 * @return string
 */
function psm_climate_change_commitment_body_default_lines() {
    return psm_mission_statement_commitment_body_default_lines();
}

/**
 * Default section image URL from theme assets.
 *
 * @return string
 */
function psm_climate_change_commitment_image_default() {
    return psm_theme_image('c-image.webp') ?: '';
}
