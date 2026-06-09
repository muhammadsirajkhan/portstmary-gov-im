<?php
/**
 * Elections page helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Elections page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_elections_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-elections.php' === get_page_template_slug($post_id);
}

/**
 * Extract document URL from an ACF repeater row.
 *
 * @param array  $row          Repeater row.
 * @param string $fallback_url Default URL when link is empty.
 * @return string
 */
function psm_election_doc_link_from_row(array $row, $fallback_url) {
    if (!isset($row['election_doc_link'])) {
        return $fallback_url;
    }

    $link = $row['election_doc_link'];

    if (is_string($link) && '' !== trim($link)) {
        return trim($link);
    }

    if (is_array($link)) {
        $normalized = psm_normalize_acf_link_button(
            $link,
            array(
                'title' => '',
                'url'   => $fallback_url,
            )
        );
        if ('' !== $normalized['url']) {
            return $normalized['url'];
        }
    }

    return $fallback_url;
}

/**
 * Parse election document repeater rows from ACF.
 *
 * @param mixed $rows         ACF repeater rows.
 * @param array $static_items Static fallback cards.
 * @return array<int, array{title: string, image: string, image_seed: string, url: string, alt: string}>
 */
function psm_parse_election_document_cards($rows, array $static_items) {
    if (!is_array($rows) || empty($rows)) {
        return $static_items;
    }

    $items = array();

    foreach ($rows as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $title = isset($row['election_doc_title']) ? trim((string) $row['election_doc_title']) : '';
        $image = isset($row['election_doc_image']) ? psm_normalize_acf_image_url($row['election_doc_image']) : '';
        $fallback_url = psm_sample_pdf_url();
        $url          = psm_election_doc_link_from_row($row, $fallback_url);

        $has_link = isset($row['election_doc_link']) && (
            (is_string($row['election_doc_link']) && '' !== trim($row['election_doc_link']))
            || (is_array($row['election_doc_link']) && !empty($row['election_doc_link']['url']))
        );

        if ('' === $image && '' === $title && !$has_link) {
            continue;
        }

        if ('' === $title && isset($static_items[ $index ]['title'])) {
            $title = $static_items[ $index ]['title'];
        }

        $seed = isset($static_items[ $index ]['image_seed'])
            ? $static_items[ $index ]['image_seed']
            : 'psm-election-doc-' . ( (int) $index + 1 );

        if ('' === $image && isset($static_items[ $index ]['image'])) {
            $image = $static_items[ $index ]['image'];
        }

        $alt = isset($static_items[ $index ]['alt']) ? $static_items[ $index ]['alt'] : ( $title ?: __('Document preview', 'cmd-theme') );

        $items[] = array(
            'title'      => $title,
            'image'      => $image,
            'image_seed' => $seed,
            'url'        => $url,
            'alt'        => $alt,
        );
    }

    return !empty($items) ? $items : $static_items;
}

/**
 * General Election Results section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<string, mixed>
 */
function psm_get_election_results_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $header      = psm_election_results_header_static();
    $documents   = psm_election_results_documents_static();
    $footer_text = psm_election_results_footer_text_static();
    $footer_url  = psm_election_results_footer_link_static();

    if ($page_id && function_exists('get_field')) {
        $badge = get_field('election_results_badge', $page_id);
        if (is_string($badge) && '' !== trim($badge)) {
            $header['badge'] = trim($badge);
        }

        $title = get_field('election_results_title', $page_id);
        if (is_string($title) && '' !== trim($title)) {
            $header['title'] = trim($title);
        }

        $intro = get_field('election_results_intro', $page_id);
        if (is_string($intro) && '' !== trim($intro)) {
            $header['intro'] = trim($intro);
        }

        $rows = get_field('election_results_cards', $page_id);
        $documents = psm_parse_election_document_cards($rows, $documents);

        $footer_body = get_field('election_results_footer', $page_id);
        if (is_string($footer_body) && '' !== trim($footer_body)) {
            $paragraphs = psm_split_acf_lines($footer_body);
            if (!empty($paragraphs)) {
                $footer_text = $paragraphs;
            }
        }

        $footer_link = get_field('election_results_footer_link', $page_id);
        if (is_string($footer_link) && '' !== trim($footer_link)) {
            $footer_url = trim($footer_link);
        }
    }

    return array(
        'section_id'  => 'election-results',
        'heading_id'  => 'psm-election-results-heading',
        'badge'       => $header['badge'],
        'title'       => $header['title'],
        'intro'       => '' !== $header['intro'] ? array($header['intro']) : array(),
        'documents'   => $documents,
        'layout'      => 'grid',
        'footer_text' => $footer_text,
        'footer_link' => array(
            'label' => $footer_url,
            'url'   => $footer_url,
        ),
    );
}

/**
 * Notice of Election section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<string, mixed>
 */
function psm_get_election_notice_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $header    = psm_election_notice_header_static();
    $documents = psm_election_notice_documents_static();

    if ($page_id && function_exists('get_field')) {
        $badge = get_field('election_notice_badge', $page_id);
        if (is_string($badge) && '' !== trim($badge)) {
            $header['badge'] = trim($badge);
        }

        $title = get_field('election_notice_title', $page_id);
        if (is_string($title) && '' !== trim($title)) {
            $header['title'] = trim($title);
        }

        $intro = get_field('election_notice_intro', $page_id);
        if (is_string($intro) && '' !== trim($intro)) {
            $header['intro'] = trim($intro);
        }

        $rows = get_field('election_notice_cards', $page_id);
        $documents = psm_parse_election_document_cards($rows, $documents);
    }

    return array(
        'section_class' => 'psm-election-documents--notice',
        'section_id'    => 'notice-of-election',
        'heading_id'    => 'psm-election-notice-heading',
        'badge'         => $header['badge'],
        'title'         => $header['title'],
        'intro'         => '' !== $header['intro'] ? array($header['intro']) : array(),
        'documents'     => $documents,
        'layout'        => 'swiper',
        'footer_text'   => array(),
        'footer_link'   => array(),
    );
}

/**
 * Candidates section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     badge: string,
 *     title: string,
 *     lead: string,
 *     link_url: string,
 *     phone: string,
 *     email: string,
 *     image: string,
 *     video_id: string
 * }
 */
function psm_get_election_candidates_content($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_election_candidates_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('election_candidates_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('election_candidates_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $lead = get_field('election_candidates_lead', $page_id);
    if (is_string($lead) && '' !== trim($lead)) {
        $data['lead'] = trim($lead);
    }

    $link_url = get_field('election_candidates_link_url', $page_id);
    if (is_string($link_url) && '' !== trim($link_url)) {
        $data['link_url'] = trim($link_url);
    }

    $phone = get_field('election_candidates_phone', $page_id);
    if (is_string($phone) && '' !== trim($phone)) {
        $data['phone'] = trim($phone);
    }

    $email = get_field('election_candidates_email', $page_id);
    if (is_string($email) && '' !== trim($email)) {
        $data['email'] = trim($email);
    }

    $image = psm_normalize_acf_image_url(get_field('election_candidates_image', $page_id));
    if ('' !== $image) {
        $data['image'] = $image;
    }

    $video_id = get_field('election_candidates_video_id', $page_id);
    if (is_string($video_id) && '' !== trim($video_id)) {
        $data['video_id'] = trim($video_id);
    }

    $site_phone = psm_get_site_phone();
    if ('' !== $site_phone['display']) {
        $data['phone'] = $site_phone['display'];
    }

    return $data;
}

/**
 * Voting section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string, link_url: string, image: string}
 */
function psm_get_election_voting_content($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_election_voting_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('election_voting_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('election_voting_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $intro = get_field('election_voting_intro', $page_id);
    if (is_string($intro) && '' !== trim($intro)) {
        $data['intro'] = trim($intro);
    }

    $link_url = get_field('election_voting_link_url', $page_id);
    if (is_string($link_url) && '' !== trim($link_url)) {
        $data['link_url'] = trim($link_url);
    }

    $image = psm_normalize_acf_image_url(get_field('election_voting_image', $page_id));
    if ('' !== $image) {
        $data['image'] = $image;
    }

    return $data;
}
