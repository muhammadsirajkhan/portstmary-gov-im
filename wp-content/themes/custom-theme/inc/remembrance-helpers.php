<?php
/**
 * Remembrance page section helpers.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Split ACF textarea into paragraph strings.
 *
 * @param mixed $raw Raw field value.
 * @return string[]
 */
function psm_split_acf_paragraphs($raw) {
    if (!is_string($raw) || '' === trim($raw)) {
        return array();
    }

    return array_values(
        array_filter(
            array_map('trim', preg_split('/\r\n|\r|\n\s*\r?\n/', $raw))
        )
    );
}

/**
 * Default Remembering with Respect section values.
 *
 * @return array<string, mixed>
 */
function psm_remembrance_respect_defaults() {
    return array(
        'badge'      => __('About Our Remembrance', 'cmd-theme'),
        'title'      => __('Remembering with the Respect', 'cmd-theme'),
        'intro'      => array(
            __(
                'Port St Mary Commissioners are committed to honouring those who served and those who gave their lives in service to our community and country.',
                'cmd-theme'
            ),
            __(
                'We work with residents, veterans, and local organisations to ensure remembrance is observed with dignity, respect, and lasting community support.',
                'cmd-theme'
            ),
        ),
        'signature'  => __('Port St Mary Commissioners', 'cmd-theme'),
        'prose'      => array(
            __(
                'Each year we join residents, organisations, and visitors to mark Remembrance with dignity — from the memorial cross by the harbour to services across the town.',
                'cmd-theme'
            ),
            __(
                'We welcome community participation and work to maintain local memorials so future generations can remember with respect.',
                'cmd-theme'
            ),
        ),
        'image_main' => psm_theme_image('remembrance-ceremony.jpg') ?: '',
        'image_sub'  => psm_theme_image('remembrance-memorial.jpg') ?: '',
    );
}

/**
 * Default Honouring section header values.
 *
 * @return array{badge: string, title: string}
 */
function psm_remembrance_honour_header_defaults() {
    return array(
        'badge' => __('Our Commitment', 'cmd-theme'),
        'title' => __('Honouring Service & Sacrifice', 'cmd-theme'),
    );
}

/**
 * Default honour cards when repeater is empty.
 *
 * @return array<int, array{title: string, image: string, paragraphs: string[], image_seed: string}>
 */
function psm_remembrance_honour_cards_static() {
    return array(
        array(
            'title'       => __('Community Remembrance', 'cmd-theme'),
            'image'       => '',
            'image_seed'  => 'psm-remembrance-community',
            'paragraphs'  => array(
                __(
                    'Annual services and gatherings bring together residents, veterans, and local groups to pay tribute at the harbour memorial and across Port St Mary.',
                    'cmd-theme'
                ),
                __(
                    'We support organisers and help ensure each occasion is conducted with care, accessibility, and dignity for all who attend.',
                    'cmd-theme'
                ),
            ),
        ),
        array(
            'title'       => __('Community Participation', 'cmd-theme'),
            'image'       => '',
            'image_seed'  => 'psm-remembrance-participation',
            'paragraphs'  => array(
                __(
                    'Schools, churches, and community organisations play a vital role in keeping remembrance alive through readings, wreath laying, and local events.',
                    'cmd-theme'
                ),
                __(
                    'The Commissioners encourage involvement and provide information on how groups can take part in commemorations throughout the year.',
                    'cmd-theme'
                ),
            ),
        ),
        array(
            'title'       => __('Local Memorials', 'cmd-theme'),
            'image'       => '',
            'image_seed'  => 'psm-remembrance-memorials',
            'paragraphs'  => array(
                __(
                    'From the war memorial cross to plaques and gardens across the town, we work to preserve these places as spaces for reflection.',
                    'cmd-theme'
                ),
                __(
                    'Maintenance, signage, and respectful use of public spaces help ensure local memorials remain fitting tributes for generations to come.',
                    'cmd-theme'
                ),
            ),
        ),
    );
}

/**
 * Honour cards from ACF repeater or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{title: string, image: string, paragraphs: string[], image_seed: string}>
 */
function psm_get_remembrance_honour_cards($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('remembrance_cards', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $cards = array();
            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $title = isset($row['remembrance_card_title']) ? trim((string) $row['remembrance_card_title']) : '';
                if ('' === $title) {
                    continue;
                }

                $image = '';
                if (isset($row['remembrance_card_image'])) {
                    $image = psm_normalize_acf_image_url($row['remembrance_card_image']);
                }

                $paragraphs = array();
                if (isset($row['remembrance_card_text'])) {
                    $paragraphs = psm_split_acf_paragraphs($row['remembrance_card_text']);
                }

                $cards[] = array(
                    'title'      => $title,
                    'image'      => $image,
                    'paragraphs' => $paragraphs,
                    'image_seed' => 'psm-remembrance-card-' . (int) $index,
                );
            }

            if (!empty($cards)) {
                return $cards;
            }
        }
    }

    return psm_remembrance_honour_cards_static();
}
