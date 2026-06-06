<?php
/**
 * Consultations page — static content fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values for the Consultations page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_consultations_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Consultations', 'cmd-theme'),
        'ribbon' => __('Helping Shape Local Decisions', 'cmd-theme'),
        'intro'  => __(
            'Share your views on local projects and proposals. Your feedback helps Port St Mary Commissioners make informed community decisions.',
            'cmd-theme'
        ),
    );
}

/**
 * Default Community Consultation & Engagement section.
 *
 * @return array{image: string, badge: string, title: string, paragraphs: string[]}
 */
function psm_consultation_engagement_static() {
    return array(
        'image'      => psm_theme_image('consultation-harbor.jpg') ?: '',
        'badge'      => __('Port St Mary Commissioners', 'cmd-theme'),
        'title'      => __('Community Consultation & Engagement', 'cmd-theme'),
        'paragraphs' => array(
            __(
                'Port St Mary Commissioners value community feedback and encourage residents to participate in consultations regarding local services, projects, policies, and future developments.',
                'cmd-theme'
            ),
            __(
                'Consultations help ensure community voices are heard and considered when making decisions that affect Port St Mary and its residents.',
                'cmd-theme'
            ),
            __(
                'At Port St Mary Commissioners, we believe community feedback plays an important role in shaping local decisions and improving public services.',
                'cmd-theme'
            ),
            __(
                'We encourage residents to take part in consultations related to community projects, local services, policies, and future developments across Port St Mary. By sharing ideas, opinions, and feedback, residents help support positive changes that reflect the needs of the community.',
                'cmd-theme'
            ),
            __(
                'Our goal is to ensure local decision-making remains open, transparent, and connected to the people who live and work within Port St Mary.',
                'cmd-theme'
            ),
        ),
    );
}

/**
 * Engagement body textarea default (one paragraph per line).
 *
 * @return string
 */
function psm_consultation_engagement_body_default_lines() {
    return implode("\n", psm_consultation_engagement_static()['paragraphs']);
}

/**
 * Default Current Consultations section header.
 *
 * @return array{badge: string, title: string, intro: string}
 */
function psm_consultation_current_header_static() {
    return array(
        'badge' => __('Port St Mary Commissioners', 'cmd-theme'),
        'title' => __('Current Consultations', 'cmd-theme'),
        'intro' => __(
            'View active consultations and share your feedback on current community topics, proposals, and local initiatives.',
            'cmd-theme'
        ),
    );
}

/**
 * Default current consultation cards.
 *
 * @return array<int, array{title: string, url: string, image: string, image_seed: string}>
 */
function psm_consultation_current_items_static() {
    $items = array(
        array(
            'title'      => __('Consultation Title', 'cmd-theme'),
            'image_seed' => 'psm-consult-1',
        ),
        array(
            'title'      => __('Summary', 'cmd-theme'),
            'image_seed' => 'psm-consult-2',
        ),
        array(
            'title'      => __('Closing Date', 'cmd-theme'),
            'image_seed' => 'psm-consult-3',
        ),
        array(
            'title'      => __('Status', 'cmd-theme'),
            'image_seed' => 'psm-consult-4',
        ),
        array(
            'title'      => __('Feedback Button', 'cmd-theme'),
            'image_seed' => 'psm-consult-5',
        ),
    );

    foreach ($items as $index => $item) {
        $file = 'consultation-' . ( $index + 1 ) . '.jpg';
        $items[ $index ]['image'] = psm_theme_image($file) ?: '';
        $items[ $index ]['url']    = '#';
    }

    return $items;
}

/**
 * Default current consultation cards as ACF repeater rows.
 *
 * @return array<int, array<string, string>>
 */
function psm_consultation_current_cards_default_acf() {
    $rows = array();

    foreach (psm_consultation_current_items_static() as $item) {
        $rows[] = array(
            'consult_card_title' => $item['title'],
        );
    }

    return $rows;
}

/**
 * Default Why Your Feedback Matters section header.
 *
 * @return array{badge: string, title: string, intro: string}
 */
function psm_consultation_feedback_header_static() {
    return array(
        'badge' => __('Consultations', 'cmd-theme'),
        'title' => __('Why Your Feedback Matters', 'cmd-theme'),
        'intro' => __(
            'Community feedback helps guide local decisions and supports improvements that reflect the needs and priorities of residents. By taking part in consultations, you can help shape projects, services, and future plans within Port St Mary.',
            'cmd-theme'
        ),
    );
}

/**
 * Default feedback value cards.
 *
 * @return array<int, array{icon: string, icon_image: string, title: string, text: string}>
 */
function psm_consultation_feedback_values_static() {
    $lorem = __(
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'cmd-theme'
    );

    return array(
        array(
            'icon'       => 'community-representation',
            'icon_image' => '',
            'title'      => __('Community Representation', 'cmd-theme'),
            'text'       => $lorem,
        ),
        array(
            'icon'       => 'local-services',
            'icon_image' => '',
            'title'      => __('Better Local Services', 'cmd-theme'),
            'text'       => $lorem,
        ),
        array(
            'icon'       => 'transparent-decisions',
            'icon_image' => '',
            'title'      => __('Transparent Decision-Making', 'cmd-theme'),
            'text'       => $lorem,
        ),
        array(
            'icon'       => 'community-led',
            'icon_image' => '',
            'title'      => __('Community-Led Improvements', 'cmd-theme'),
            'text'       => $lorem,
        ),
    );
}

/**
 * Default feedback cards as ACF repeater rows.
 *
 * @return array<int, array<string, string>>
 */
function psm_consultation_feedback_cards_default_acf() {
    $rows = array();

    foreach (psm_consultation_feedback_values_static() as $card) {
        $rows[] = array(
            'consult_feedback_card_title' => $card['title'],
            'consult_feedback_card_text'  => $card['text'],
        );
    }

    return $rows;
}

/**
 * CSS icon fallback keys for feedback cards (when no image is uploaded).
 *
 * @return string[]
 */
function psm_consultation_feedback_icon_keys() {
    return array(
        'community-representation',
        'local-services',
        'transparent-decisions',
        'community-led',
    );
}
