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
