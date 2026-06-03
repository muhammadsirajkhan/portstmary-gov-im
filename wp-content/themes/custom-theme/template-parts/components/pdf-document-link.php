<?php
/**
 * PDF download link with icon.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $label    Document title.
 *     @type string $file_url PDF URL (optional).
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'label'    => '',
        'file_url' => '',
    )
);

if (!$args['label']) {
    return;
}

$file_url = $args['file_url'] ?: psm_sample_pdf_url();
$filename = psm_document_download_filename($args['label']);
?>
<a
    class="psm-pdf-doc"
    href="<?php echo esc_url($file_url); ?>"
    download="<?php echo esc_attr($filename); ?>"
    target="_blank"
    rel="noopener noreferrer"
>
    <span class="" aria-hidden="true">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/download-icon.png'); ?>" alt="" width="24" height="24" decoding="async">
    </span>
    <span class="psm-pdf-doc__label"><?php echo esc_html($args['label']); ?></span>
</a>
