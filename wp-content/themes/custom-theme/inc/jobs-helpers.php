<?php
/**
 * Jobs page and job listing helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Whether the post uses the Jobs page template.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function psm_is_jobs_page($post_id = 0) {
    if (!$post_id) {
        $post_id = (int) get_queried_object_id();
    }

    if (!$post_id) {
        return false;
    }

    return 'page-jobs.php' === get_page_template_slug($post_id);
}

/**
 * Work With Us section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{
 *     image: string,
 *     badge: string,
 *     title: string,
 *     lead: string,
 *     body: string,
 *     benefits_intro: string,
 *     benefits: string[]
 * }
 */
function psm_get_jobs_work_with_us_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_jobs_work_with_us_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $image = psm_normalize_acf_image_url(get_field('work_image', $page_id));
    if ('' !== $image) {
        $data['image'] = $image;
    }

    $badge = get_field('work_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('work_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $lead = get_field('work_lead', $page_id);
    if (is_string($lead) && '' !== trim($lead)) {
        $data['lead'] = trim($lead);
    }

    $body = get_field('work_body', $page_id);
    if (is_string($body) && '' !== trim($body)) {
        $data['body'] = trim($body);
    }

    $benefits_intro = get_field('work_benefits_intro', $page_id);
    if (is_string($benefits_intro) && '' !== trim($benefits_intro)) {
        $data['benefits_intro'] = trim($benefits_intro);
    }

    $benefits = get_field('work_benefits', $page_id);
    if (is_string($benefits) && '' !== trim($benefits)) {
        $lines = psm_split_acf_lines($benefits);
        if (!empty($lines)) {
            $data['benefits'] = $lines;
        }
    }

    return $data;
}

/**
 * How To Apply section from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, steps: array<int, array{title: string, text: string}>}
 */
function psm_get_jobs_apply_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_jobs_apply_section_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('apply_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('apply_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    $rows = get_field('apply_steps', $page_id);
    if (is_array($rows) && !empty($rows)) {
        $steps = array();

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $step_title = isset($row['step_title']) ? trim((string) $row['step_title']) : '';
            $step_text  = isset($row['step_text']) ? trim((string) $row['step_text']) : '';

            if ('' === $step_title) {
                continue;
            }

            $steps[] = array(
                'title' => $step_title,
                'text'  => $step_text,
            );
        }

        if (!empty($steps)) {
            $data['steps'] = $steps;
        }
    }

    return $data;
}

/**
 * Latest Opportunities section header from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string}
 */
function psm_get_jobs_opportunities_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $data = psm_jobs_opportunities_header_static();

    if (!$page_id || !function_exists('get_field')) {
        return $data;
    }

    $badge = get_field('opportunities_badge', $page_id);
    if (is_string($badge) && '' !== trim($badge)) {
        $data['badge'] = trim($badge);
    }

    $title = get_field('opportunities_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $data['title'] = trim($title);
    }

    return $data;
}

/**
 * Build job-listing-card template args from a psm_job post.
 *
 * @param int $post_id Job post ID.
 * @return array{title: string, location: string, category: string, url: string, target: string}
 */
function psm_get_job_listing_card_args($post_id) {
    $post_id = (int) $post_id;
    if ($post_id <= 0) {
        return array();
    }

    $title = get_the_title($post_id);
    $location = '';
    $category = '';
    $pdf_url  = '';

    if (function_exists('get_field')) {
        $location = get_field('job_location', $post_id);
        $category = get_field('job_category', $post_id);
        $pdf_url  = psm_normalize_acf_image_url(get_field('job_pdf', $post_id));
    }

    $url    = '' !== $pdf_url ? $pdf_url : (get_permalink($post_id) ?: '#');
    $target = '' !== $pdf_url ? '_blank' : '';

    return array(
        'title'    => trim((string) $title),
        'location' => trim((string) $location),
        'category' => trim((string) $category),
        'url'      => $url,
        'target'   => $target,
    );
}

/**
 * Published job post IDs for the Latest Opportunities list.
 *
 * @return int[]
 */
function psm_get_job_post_ids() {
    $query = new WP_Query(
        array(
            'post_type'      => 'psm_job',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => array(
                'menu_order' => 'ASC',
                'date'       => 'DESC',
            ),
            'fields'         => 'ids',
            'no_found_rows'  => true,
        )
    );

    $ids = !empty($query->posts) ? array_map('intval', $query->posts) : array();

    wp_reset_postdata();

    return $ids;
}

/**
 * Job listing cards for the Latest Opportunities section.
 *
 * @return array<int, array{title: string, location: string, category: string, url: string, target: string}>
 */
function psm_get_jobs_opportunities() {
    $cards = array();

    foreach (psm_get_job_post_ids() as $post_id) {
        $card = psm_get_job_listing_card_args($post_id);
        if (!empty($card['title'])) {
            $cards[] = $card;
        }
    }

    return $cards;
}
