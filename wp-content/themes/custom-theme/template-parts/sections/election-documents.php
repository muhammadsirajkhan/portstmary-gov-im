<?php
/**
 * Reusable elections document block — header, preview cards, footer copy.
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
        'badge_style'   => 'pill',
        'title'         => '',
        'heading_id'    => '',
        'intro'         => array(),
        'documents'     => array(),
        'layout'        => 'grid',
        'footer_text'   => array(),
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

$is_swiper = 'swiper' === $args['layout'];
$swiper_id = $is_swiper ? 'psm-election-documents-swiper-' . sanitize_html_class($args['section_id'] ?: wp_unique_id('notice')) : '';
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
                'badge_style' => $args['badge_style'],
                'title'       => $args['title'],
                'heading_id'  => $args['heading_id'],
                'intro'       => (array) $args['intro'],
                'class'       => 'psm-section-header--election-documents',
            )
        );
        ?>

        <?php if ($is_swiper) : ?>
            <div class="psm-election-documents__carousel">
                <div
                    class="swiper psm-election-documents-swiper"
                    <?php echo $swiper_id ? ' id="' . esc_attr($swiper_id) . '"' : ''; ?>
                >
                    <div class="swiper-wrapper">
                        <?php foreach ((array) $args['documents'] as $document) : ?>
                            <div class="swiper-slide">
                                <?php get_template_part('template-parts/components/document-preview-card', null, $document); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <ul class="psm-election-documents__pager" aria-label="<?php esc_attr_e('Election documents', 'cmd-theme'); ?>"></ul>
            </div>
        <?php else : ?>
            <div class="psm-election-documents__grid">
                <?php foreach ((array) $args['documents'] as $document) : ?>
                    <?php get_template_part('template-parts/components/document-preview-card', null, $document); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($args['footer_text'])) : ?>
            <div class="psm-election-documents__footer-text">
                <?php foreach ((array) $args['footer_text'] as $paragraph) : ?>
                    <?php if ('' !== trim((string) $paragraph)) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($args['footer_link']['url'])) : ?>
            <p class="psm-election-documents__footer">
                <a class="psm-election-documents__footer-link" href="<?php echo esc_url($args['footer_link']['url']); ?>" target="_blank" rel="noopener noreferrer">
                    <?php echo esc_html($args['footer_link']['label'] ?: $args['footer_link']['url']); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</section>
