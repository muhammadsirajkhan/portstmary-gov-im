<?php
/**
 * Jobs / Careers page — static content fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default inner banner values for the Jobs page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_jobs_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Careers With Us', 'cmd-theme'),
        'ribbon' => __('Opportunities to Grow, Work That Matters', 'cmd-theme'),
        'intro'  => __(
            'Explore careers with Port St Mary Commissioners and find opportunities to contribute to our community.',
            'cmd-theme'
        ),
    );
}

/**
 * Default Work With Us section.
 *
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
function psm_jobs_work_with_us_static() {
    return array(
        'image'          => psm_theme_image('jobs-work.jpg') ?: '',
        'badge'          => __('Opportunities', 'cmd-theme'),
        'title'          => __('Work With Us', 'cmd-theme'),
        'lead'           => __(
            'We offer a professional and supportive environment where individuals can grow, develop their skills, and contribute to meaningful work.',
            'cmd-theme'
        ),
        'body'           => __(
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
 * Default How To Apply section header and steps.
 *
 * @return array{badge: string, title: string, steps: array<int, array{title: string, text: string}>}
 */
function psm_jobs_apply_section_static() {
    return array(
        'badge'  => __('Application Process', 'cmd-theme'),
        'title'  => __('How To Apply', 'cmd-theme'),
        'steps'  => array(
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
        ),
    );
}

/**
 * Default Latest Opportunities section header.
 *
 * @return array{badge: string, title: string}
 */
function psm_jobs_opportunities_header_static() {
    return array(
        'badge' => __('Current Vacancies', 'cmd-theme'),
        'title' => __('Latest Opportunities', 'cmd-theme'),
    );
}

/**
 * Default benefits list as textarea lines for ACF.
 *
 * @return string
 */
function psm_jobs_work_benefits_default_lines() {
    return implode(
        "\n",
        psm_jobs_work_with_us_static()['benefits']
    );
}

/**
 * Default apply steps as ACF repeater rows.
 *
 * @return array<int, array{step_title: string, step_text: string}>
 */
function psm_jobs_apply_steps_default_rows() {
    $rows = array();

    foreach (psm_jobs_apply_section_static()['steps'] as $step) {
        $rows[] = array(
            'step_title' => $step['title'],
            'step_text'  => $step['text'],
        );
    }

    return $rows;
}
