<?php
/**
 * Shared PDF document helpers.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

function psm_sample_pdf_url() {
    return get_template_directory_uri() . '/assets/documents/sample-foi.pdf';
}

function psm_document_download_filename($label) {
    $slug = sanitize_title($label);
    return $slug ? $slug . '.pdf' : 'document.pdf';
}
