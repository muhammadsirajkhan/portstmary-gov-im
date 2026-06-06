<?php
/**
 * Default ACF values for the Elections page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Apply Elections page text defaults when ACF value is empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_elections_page_default_value($value, $post_id, $field) {
    if (!psm_is_elections_page($post_id)) {
        return $value;
    }

    if (null !== $value && false !== $value && '' !== $value) {
        return $value;
    }

    $name        = isset($field['name']) ? $field['name'] : '';
    $banner      = psm_elections_inner_banner_defaults();
    $results     = psm_election_results_header_static();
    $notice      = psm_election_notice_header_static();
    $candidates  = psm_election_candidates_static();
    $voting      = psm_election_voting_static();

    $map = array(
        'inner_banner_kicker'          => $banner['kicker'],
        'inner_banner_title'           => $banner['title'],
        'inner_banner_ribbon'          => $banner['ribbon'],
        'inner_banner_intro'           => $banner['intro'],
        'election_results_badge'       => $results['badge'],
        'election_results_title'       => $results['title'],
        'election_results_intro'       => $results['intro'],
        'election_results_footer'      => psm_election_results_footer_body_default_lines(),
        'election_results_footer_link' => psm_election_results_footer_link_static(),
        'election_notice_badge'        => $notice['badge'],
        'election_notice_title'        => $notice['title'],
        'election_notice_intro'        => $notice['intro'],
        'election_candidates_badge'    => $candidates['badge'],
        'election_candidates_title'    => $candidates['title'],
        'election_candidates_lead'     => $candidates['lead'],
        'election_candidates_link_url' => $candidates['link_url'],
        'election_candidates_phone'    => $candidates['phone'],
        'election_candidates_email'    => $candidates['email'],
        'election_candidates_video_id' => $candidates['video_id'],
        'election_voting_badge'        => $voting['badge'],
        'election_voting_title'        => $voting['title'],
        'election_voting_intro'        => $voting['intro'],
        'election_voting_link_url'     => $voting['link_url'],
    );

    return isset($map[ $name ]) ? $map[ $name ] : $value;
}

/**
 * Default results document cards repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_election_results_cards_default($value, $post_id, $field) {
    if (!psm_is_elections_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_election_results_cards_default_acf();
}

/**
 * Default notice document cards repeater when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @param array $field   ACF field array.
 * @return mixed
 */
function psm_acf_election_notice_cards_default($value, $post_id, $field) {
    if (!psm_is_elections_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return psm_election_notice_cards_default_acf();
}

$psm_elections_text_fields = array(
    'inner_banner_kicker',
    'inner_banner_title',
    'inner_banner_ribbon',
    'inner_banner_intro',
    'election_results_badge',
    'election_results_title',
    'election_results_intro',
    'election_results_footer',
    'election_results_footer_link',
    'election_notice_badge',
    'election_notice_title',
    'election_notice_intro',
    'election_candidates_badge',
    'election_candidates_title',
    'election_candidates_lead',
    'election_candidates_link_url',
    'election_candidates_phone',
    'election_candidates_email',
    'election_candidates_video_id',
    'election_voting_badge',
    'election_voting_title',
    'election_voting_intro',
    'election_voting_link_url',
);

foreach ($psm_elections_text_fields as $field_name) {
    add_filter(
        'acf/load_value/name=' . $field_name,
        'psm_acf_elections_page_default_value',
        10,
        3
    );
}

add_filter('acf/load_value/name=election_results_cards', 'psm_acf_election_results_cards_default', 10, 3);
add_filter('acf/load_value/name=election_notice_cards', 'psm_acf_election_notice_cards_default', 10, 3);
