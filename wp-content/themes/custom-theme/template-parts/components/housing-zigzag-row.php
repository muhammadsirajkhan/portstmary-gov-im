<?php
/**
 * Housing Services zigzag row.
 *
 * @package CMD_Theme
 *
 * @var array $args Row configuration from psm_get_housing_services_rows().
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'layout'     => 'image-left',
        'background' => 'white',
        'badge'      => '',
        'title'      => '',
        'heading_id' => '',
        'media'      => array(),
        'paragraphs' => array(),
        'list_type'     => '',
        'list_items'    => array(),
        'read_more'     => array(),
        'opening_times' => array(),
        'footnote'      => '',
        'subheading'    => '',
    )
);

if (!$args['title']) {
    return;
}

$layout = 'image-right' === $args['layout'] ? 'image-right' : 'image-left';
$bg     = 'grey' === $args['background'] ? 'grey' : 'white';

$row_class = 'psm-housing-zigzag__row psm-housing-zigzag__row--' . $layout;
$section_class = 'psm-housing-zigzag__block psm-housing-zigzag__block--' . $bg;
?>
<div class="<?php echo esc_attr($section_class); ?>">
    <article class="<?php echo esc_attr($row_class); ?>">
        <?php
        get_template_part(
            'template-parts/components/housing-zigzag-media',
            null,
            array_merge(
                array('alt' => $args['title']),
                (array) $args['media']
            )
        );
        ?>

        <div class="psm-housing-zigzag__content">
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'        => $args['badge'],
                    'badge_style'  => 'red',
                    'title'        => $args['title'],
                    'heading_id'   => $args['heading_id'],
                    'align'        => 'left',
                    'class'        => 'psm-section-header--housing-zigzag',
                )
            );
            ?>

            <?php if (!empty($args['paragraphs'])) : ?>
                <div class="psm-housing-zigzag__prose">
                    <?php foreach ((array) $args['paragraphs'] as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($args['opening_times'])) : ?>
                <?php
                get_template_part(
                    'template-parts/components/opening-times-block',
                    null,
                    (array) $args['opening_times']
                );
                ?>
            <?php endif; ?>

            <?php if ($args['footnote']) : ?>
                <p class="psm-housing-zigzag__footnote"><?php echo esc_html($args['footnote']); ?></p>
            <?php endif; ?>

            <?php if ($args['subheading']) : ?>
                <h3 class="psm-housing-zigzag__subheading"><?php echo esc_html(strtoupper($args['subheading'])); ?></h3>
            <?php endif; ?>

            <?php if ('check' === $args['list_type'] && !empty($args['list_items'])) : ?>
                <?php
                get_template_part(
                    'template-parts/components/housing-check-list',
                    null,
                    array(
                        'items' => $args['list_items'],
                    )
                );
                ?>
            <?php elseif ('numbered' === $args['list_type'] && !empty($args['list_items'])) : ?>
                <ol class="psm-housing-numbered">
                    <?php foreach ((array) $args['list_items'] as $item) : ?>
                        <li><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ol>
            <?php endif; ?>

            <?php if (!empty($args['read_more']['url'])) : ?>
                <a class="psm-housing-zigzag__readmore" href="<?php echo esc_url($args['read_more']['url']); ?>">
                    <span><?php echo esc_html($args['read_more']['label'] ?: __('Read More', 'cmd-theme')); ?></span>
                    <span class="psm-housing-zigzag__readmore-arrow" aria-hidden="true"></span>
                </a>
            <?php endif; ?>
        </div>
    </article>
</div>
