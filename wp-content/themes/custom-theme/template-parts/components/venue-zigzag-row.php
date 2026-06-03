<?php
/**
 * Venue hire zigzag row — alternating image and content.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string       $layout      image-left|image-right.
 *     @type string       $title       Row heading (no period).
 *     @type string       $heading_id  Optional h2 id.
 *     @type string[]     $paragraphs  Body copy paragraphs (plain text).
 *     @type string       $intro_html    WYSIWYG intro HTML.
 *     @type string       $extra_content WYSIWYG extra content HTML.
 *     @type string[]     $features    Feature list items.
 *     @type string       $image       Image URL.
 *     @type string       $image_seed  Placeholder seed.
 *     @type string       $image_alt   Image alt text.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'layout'      => 'image-left',
        'title'       => '',
        'heading_id'  => '',
        'paragraphs'    => array(),
        'intro_html'    => '',
        'extra_content' => '',
        'features'      => array(),
        'image'       => '',
        'image_seed'  => 'psm-venue',
        'image_alt'   => '',
        'read_more'   => array(),
    )
);

if (!$args['title']) {
    return;
}

$layout = 'image-right' === $args['layout'] ? 'image-right' : 'image-left';
$row_class = 'psm-venue-zigzag__row psm-venue-zigzag__row--' . $layout;
?>
<article class="<?php echo esc_attr($row_class); ?>">
    <?php
    get_template_part(
        'template-parts/components/venue-zigzag-media',
        null,
        array(
            'image'      => $args['image'],
            'image_seed' => $args['image_seed'],
            'alt'        => $args['image_alt'] ?: $args['title'],
            'layout'     => $layout,
        )
    );
    ?>

    <div class="psm-venue-zigzag__content">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'      => __('Port St Mary Commissioners', 'cmd-theme'),
                'title'      => $args['title'],
                'heading_id' => $args['heading_id'],
                'align'      => 'left',
                'class'      => 'psm-section-header--venue-zigzag',
            )
        );
        ?>

        <?php if (!empty($args['intro_html']) && '' !== trim(wp_strip_all_tags($args['intro_html']))) : ?>
            <div class="psm-venue-zigzag__prose">
                <?php echo wp_kses_post($args['intro_html']); ?>
            </div>
        <?php elseif (!empty($args['paragraphs'])) : ?>
            <div class="psm-venue-zigzag__prose">
                <?php foreach ((array) $args['paragraphs'] as $paragraph) : ?>
                    <p><?php echo esc_html($paragraph); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($args['features'])) : ?>
        <?php
        get_template_part(
            'template-parts/components/venue-feature-list',
            null,
            array(
                'items' => $args['features'],
            )
        );
        ?>
        <?php endif; ?>

        <?php if (!empty($args['extra_content']) && '' !== trim(wp_strip_all_tags($args['extra_content']))) : ?>
            <div class="psm-venue-zigzag__prose psm-venue-zigzag__extra">
                <?php echo wp_kses_post($args['extra_content']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($args['read_more']['url'])) : ?>
            <a class="psm-housing-zigzag__readmore" href="<?php echo esc_url($args['read_more']['url']); ?>">
                <span><?php echo esc_html($args['read_more']['label'] ?: __('Read More', 'cmd-theme')); ?></span>
                <span class="psm-housing-zigzag__readmore-arrow" aria-hidden="true"></span>
            </a>
        <?php endif; ?>
    </div>
</article>
