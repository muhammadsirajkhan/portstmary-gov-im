<?php
/**
 * Document preview card — title, image thumbnail linking to PDF.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $title      Card title.
 *     @type string $image      Preview image URL.
 *     @type string $image_seed Placeholder seed.
 *     @type string $url        Document URL.
 *     @type string $alt        Image alt text.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'      => '',
        'image'      => '',
        'image_seed' => 'psm-doc-preview',
        'url'        => '#',
        'alt'        => __('Document preview', 'cmd-theme'),
    )
);

$image = $args['image'] ?: psm_placeholder_image(560, 720, $args['image_seed']);
$url   = $args['url'] ?: psm_sample_pdf_url();
$alt   = $args['alt'] ?: ($args['title'] ?: __('Document preview', 'cmd-theme'));
?>
<a
    class="psm-doc-preview-card"
    href="<?php echo esc_url($url); ?>"
    target="_blank"
    rel="noopener noreferrer"
>
    <div class="psm-doc-preview-card__body">
        <?php if ($args['title']) : ?>
            <h3 class="psm-doc-preview-card__title"><?php echo esc_html($args['title']); ?></h3>
        <?php endif; ?>
        <img
            class="psm-doc-preview-card__image"
            src="<?php echo esc_url($image); ?>"
            alt="<?php echo esc_attr($alt); ?>"
            width="560"
            height="720"
            loading="lazy"
            decoding="async"
        >
    </div>
</a>
