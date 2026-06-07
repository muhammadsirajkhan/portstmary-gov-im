<?php
/**
 * Public amenities facility info card (overlapping image rows).
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string   $title      Card heading.
 *     @type string   $text       Description paragraph.
 *     @type string   $text_extra Optional second paragraph.
 *     @type string[] $list_items Optional checklist items.
 *     @type array    $read_more  { label, url }.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'      => '',
        'text'       => '',
        'text_extra' => '',
        'list_items' => array(),
        'read_more'  => array(),
    )
);

if (!$args['title']) {
    return;
}

$crest = psm_theme_image('header-logo.webp') ?: psm_theme_image('logo-placeholder.svg');
$list_count = count((array) $args['list_items']);
$list_class = 'psm-housing-checklist';
if ($list_count >= 4) {
    $list_class .= ' psm-housing-checklist--facility-grid';
}
if (5 === $list_count) {
    $list_class .= ' psm-housing-checklist--facility-grid-5';
}
?>
<article class="psm-amenities-facility-card">
    <div class="psm-amenities-facility-card__icon">
        <img
            src="<?php echo esc_url($crest); ?>"
            alt=""
            width="48"
            height="48"
            loading="lazy"
            decoding="async"
            role="presentation"
        >
    </div>

    <p class="psm-amenities-facility-card__kicker">
        <span aria-hidden="true">&bull;</span>
        <?php esc_html_e('Port St Mary Commissioners', 'cmd-theme'); ?>
        <span aria-hidden="true">&bull;</span>
    </p>

    <h3 class="psm-amenities-facility-card__title"><?php echo esc_html($args['title']); ?></h3>

    <?php if ($args['text']) : ?>
        <p class="psm-amenities-facility-card__text"><?php echo esc_html($args['text']); ?></p>
    <?php endif; ?>

    <?php if ($args['text_extra']) : ?>
        <p class="psm-amenities-facility-card__text"><?php echo esc_html($args['text_extra']); ?></p>
    <?php endif; ?>

    <?php if (!empty($args['list_items'])) : ?>
        <?php
        get_template_part(
            'template-parts/components/housing-check-list',
            null,
            array(
                'items'      => $args['list_items'],
                'list_class' => $list_class,
            )
        );
        ?>
    <?php endif; ?>

    <?php if (!empty($args['read_more']['url'])) : ?>
        <div class="psm-amenities-facility-card__cta">
            <?php
            get_template_part(
                'template-parts/components/button-pill',
                null,
                array(
                    'text' => $args['read_more']['label'] ?: __('Read More', 'cmd-theme'),
                    'url'  => $args['read_more']['url'],
                )
            );
            ?>
        </div>
    <?php endif; ?>
</article>
