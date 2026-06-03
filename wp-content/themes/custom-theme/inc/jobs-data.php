<?php
/**
 * Jobs / Careers page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Work With Us section copy and benefits list.
 *
 * @return array{lead: string, body: string, benefits_intro: string, benefits: string[]}
 */
function psm_get_jobs_work_with_us_copy() {
    return array(
        'lead' => __(
            'We offer a professional and supportive environment where individuals can grow, develop their skills, and contribute to meaningful work.',
            'cmd-theme'
        ),
        'body' => __(
            'We are committed to creating a positive workplace culture where every team member is valued. Whether you are starting your career or bringing years of experience, we provide the tools and support you need to succeed while serving the residents of Port St Mary.',
            'cmd-theme'
        ),
        'benefits_intro' => __('As part of our team, you will benefit from:', 'cmd-theme'),
        'benefits'       => array(
            __('A respectful and supportive working environment', 'cmd-theme'),
            __('Opportunities for learning and development', 'cmd-theme'),
            __('Meaningful work that benefits the community', 'cmd-theme'),
            __('A culture of teamwork and accountability', 'cmd-theme'),
        ),
    );
}

/**
 * How to apply process steps.
 *
 * @return array<int, array{title: string, text: string}>
 */
function psm_get_jobs_apply_steps() {
    return array(
        array(
            'title' => __('Review the Job Description', 'cmd-theme'),
            'text'  => __(
                'Carefully review the job description to ensure you meet the required qualifications and understand the responsibilities of the role.',
                'cmd-theme'
            ),
        ),
        array(
            'title' => __('Prepare Your Application', 'cmd-theme'),
            'text'  => __(
                'Update your CV and gather any relevant supporting documents.',
                'cmd-theme'
            ),
        ),
        array(
            'title' => __('Submit Your Application', 'cmd-theme'),
            'text'  => __(
                'Submit your application before the stated closing date.',
                'cmd-theme'
            ),
        ),
    );
}

/**
 * Current job vacancy listings.
 *
 * @return array<int, array{title: string, location: string, category: string, url: string}>
 */
function psm_get_jobs_opportunities() {
    $sample = array(
        'title'    => __('Administrative Assistant', 'cmd-theme'),
        'location' => __('Port St Mary, Isle of Man, IM9 5DA', 'cmd-theme'),
        'category' => __('Administration & Office Support', 'cmd-theme'),
        'url'      => '#',
    );

    return array_fill(0, 5, $sample);
}
