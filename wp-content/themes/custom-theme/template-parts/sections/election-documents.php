<?php
/**
 * Reusable elections document block — header, preview cards, footer link.
 *
 * @package CMD_Theme
 *
 * @var array $args Section configuration.
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'section_class' => '',
        'section_id'    => '',
        'badge'         => __('Elections', 'cmd-theme'),
        'title'         => '',
        'heading_id'    => '',
        'intro'         => array(),
        'documents'     => array(),
        'footer_link'   => array(),
    )
);

if (!$args['title'] || empty($args['documents'])) {
    return;
}

$section_class = 'psm-election-documents';
if ($args['section_class']) {
    $section_class .= ' ' . esc_attr($args['section_class']);
}
?>
<section
    class="<?php echo esc_attr($section_class); ?>"
    <?php echo $args['section_id'] ? ' id="' . esc_attr($args['section_id']) . '"' : ''; ?>
    <?php echo $args['heading_id'] ? ' aria-labelledby="' . esc_attr($args['heading_id']) . '"' : ''; ?>
>
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'       => $args['badge'],
                'badge_style' => 'red',
                'title'       => $args['title'],
                'heading_id'  => $args['heading_id'],
                'intro'       => (array) $args['intro'],
                'class'       => 'psm-section-header--election-documents',
            )
        );
        ?>

        <div class="psm-election-documents__grid">
            <?php foreach ((array) $args['documents'] as $document) : ?>
                <?php get_template_part('template-parts/components/document-preview-card', null, $document); ?>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($args['footer_link']['url'])) : ?>
            <p class="psm-election-documents__footer">
                <a class="psm-election-documents__footer-link" href="<?php echo esc_url($args['footer_link']['url']); ?>">
                    <?php echo esc_html($args['footer_link']['label'] ?: __('Click here to view', 'cmd-theme')); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</section>
