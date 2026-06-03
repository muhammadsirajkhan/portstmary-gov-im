<?php
/**
 * Public amenities facility info card (overlapping image rows).
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string   $title      Card heading (without period).
 *     @type string   $text       Description paragraph.
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
        'list_items' => array(),
        'read_more'  => array(),
    )
);

if (!$args['title']) {
    return;
}

$crest = psm_theme_image('header-logo.png') ?: psm_theme_image('logo-placeholder.svg');
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

    <h3 class="psm-amenities-facility-card__title">
        <?php echo esc_html($args['title']); ?><span class="psm-amenities-facility-card__title-dot" aria-hidden="true">.</span>
    </h3>

    <?php if ($args['text']) : ?>
        <p class="psm-amenities-facility-card__text"><?php echo esc_html($args['text']); ?></p>
    <?php endif; ?>

    <?php if (!empty($args['list_items'])) : ?>
        <?php
        get_template_part(
            'template-parts/components/housing-check-list',
            null,
            array(
                'items' => $args['list_items'],
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
