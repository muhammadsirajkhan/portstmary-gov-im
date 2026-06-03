<?php
/**
 * Refuse Services zigzag row — single image, pill header, opening times.
 *
 * @package CMD_Theme
 *
 * @var array $args Row configuration from psm_get_refuse_services_rows().
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'layout'        => 'image-left',
        'background'    => 'white',
        'title'         => '',
        'heading_id'    => '',
        'media'         => array(),
        'intro_html'    => '',
        'opening_times' => array(),
        'subheading'    => '',
        'extra_html'    => '',
    )
);

if (!$args['title']) {
    return;
}

$layout = 'image-right' === $args['layout'] ? 'image-right' : 'image-left';
$bg     = 'grey' === $args['background'] ? 'grey' : 'white';

$row_class     = 'psm-refuse-zigzag__row psm-refuse-zigzag__row--' . $layout;
$section_class = 'psm-housing-zigzag__block psm-housing-zigzag__block--' . $bg;
?>
<div class="<?php echo esc_attr($section_class); ?>">
    <div class="container psm-container">
        <article class="<?php echo esc_attr($row_class); ?>">
            <?php
            get_template_part(
                'template-parts/components/housing-zigzag-media',
                null,
                array_merge(
                    array(
                        'variant' => 'single-badge',
                        'alt'     => $args['title'],
                    ),
                    (array) $args['media']
                )
            );
            ?>

            <div class="psm-refuse-zigzag__content">
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

                <?php if ('' !== trim(wp_strip_all_tags($args['intro_html']))) : ?>
                    <div class="psm-venue-zigzag__prose">
                        <?php echo wp_kses_post($args['intro_html']); ?>
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

                <?php if ($args['subheading']) : ?>
                    <h3 class="psm-refuse-zigzag__subheading"><?php echo esc_html($args['subheading']); ?></h3>
                <?php endif; ?>

                <?php if ('' !== trim(wp_strip_all_tags($args['extra_html']))) : ?>
                    <div class="psm-venue-zigzag__prose psm-refuse-zigzag__extra">
                        <?php echo wp_kses_post($args['extra_html']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </article>
    </div>
</div>
