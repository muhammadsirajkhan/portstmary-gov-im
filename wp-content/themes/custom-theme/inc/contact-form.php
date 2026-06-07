<?php
/**
 * Contact Form 7 integration helpers.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Contact page URL.
 */
function psm_contact_page_url() {
    $page = get_page_by_path('contact');
    if ($page) {
        return get_permalink($page);
    }
    return home_url('/contact/');
}

/**
 * CF7 shortcode for the contact form.
 *
 * Set via filter, Customizer, or page meta `_psm_cf7_shortcode`.
 */
function psm_get_contact_form_shortcode() {
    $shortcode = '';

    if (is_singular('page')) {
        $page_id = get_queried_object_id();

        if (function_exists('get_field')) {
            $acf_shortcode = get_field('contact_form_shortcode', $page_id);
            if (is_string($acf_shortcode) && '' !== trim($acf_shortcode)) {
                $shortcode = trim($acf_shortcode);
            }
        }

        if ('' === $shortcode) {
            $meta = get_post_meta($page_id, '_psm_cf7_shortcode', true);
            if (is_string($meta) && '' !== trim($meta)) {
                $shortcode = trim($meta);
            }
        }
    }

    if ('' === $shortcode) {
        $shortcode = apply_filters('psm_contact_form_shortcode', '');
    }

    return $shortcode;
}

/**
 * Render Contact Form 7 or admin placeholder.
 */
function psm_render_contact_form() {
    $shortcode = psm_get_contact_form_shortcode();

    if ($shortcode && function_exists('wpcf7_contact_form')) {
        echo do_shortcode($shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        return;
    }

    echo '<p class="psm-contact-form__notice">';
    esc_html_e(
        'Install Contact Form 7 and add your form shortcode via the page custom field _psm_cf7_shortcode or the psm_contact_form_shortcode filter.',
        'cmd-theme'
    );
    echo '</p>';
}

/**
 * Job application form settings from the Jobs page.
 *
 * @return array{title: string, intro: string, shortcode: string}
 */
function psm_get_job_application_form_settings() {
    $defaults = array(
        'title'      => __('Apply for this Role', 'cmd-theme'),
        'intro'      => __(
            'Complete the form below to submit your application. Please attach your CV where requested.',
            'cmd-theme'
        ),
        'shortcode'  => '',
    );

    $page_id = function_exists('psm_get_jobs_page_id') ? psm_get_jobs_page_id() : 0;
    if ($page_id <= 0 || !function_exists('get_field')) {
        return $defaults;
    }

    $title = get_field('job_form_title', $page_id);
    if (is_string($title) && '' !== trim($title)) {
        $defaults['title'] = trim($title);
    }

    $intro = get_field('job_form_intro', $page_id);
    if (is_string($intro) && '' !== trim($intro)) {
        $defaults['intro'] = trim($intro);
    }

    $shortcode = get_field('job_form_shortcode', $page_id);
    if (is_string($shortcode) && '' !== trim($shortcode)) {
        $defaults['shortcode'] = trim($shortcode);
    }

    return $defaults;
}

/**
 * CF7 shortcode for the job application form (Jobs page ACF field).
 */
function psm_get_job_application_form_shortcode() {
    $settings = psm_get_job_application_form_settings();
    $shortcode = trim((string) ($settings['shortcode'] ?? ''));

    if ('' === $shortcode) {
        $shortcode = apply_filters('psm_job_application_form_shortcode', '');
    }

    return $shortcode;
}

/**
 * Render job application Contact Form 7 or admin placeholder.
 */
function psm_render_job_application_form() {
    $shortcode = psm_get_job_application_form_shortcode();

    if ($shortcode && function_exists('wpcf7_contact_form')) {
        echo do_shortcode($shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        return;
    }

    echo '<p class="psm-contact-form__notice">';
    esc_html_e(
        'Add your job application Contact Form 7 shortcode on the Jobs page (Job Application Form fields) or via the psm_job_application_form_shortcode filter.',
        'cmd-theme'
    );
    echo '</p>';
}

/**
 * Pass current job context into CF7 hidden fields.
 *
 * @param array<string, string> $fields Hidden fields.
 * @return array<string, string>
 */
function psm_job_application_cf7_hidden_fields($fields) {
    if (!is_singular('psm_job')) {
        return $fields;
    }

    $fields['job-title'] = get_the_title();
    $fields['job-id']    = (string) get_queried_object_id();

    return $fields;
}
add_filter('wpcf7_form_hidden_fields', 'psm_job_application_cf7_hidden_fields');
