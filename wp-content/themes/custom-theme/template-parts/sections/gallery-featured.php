<?php
/**
 * Featured Gallery — asymmetrical image masonry grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$items = psm_get_gallery_featured_items();
?>
<section class="psm-gallery-featured" id="featured-gallery" aria-labelledby="psm-gallery-featured-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'        => __('Port St Mary Commissioners Gallery', 'cmd-theme'),
                'badge_style'  => 'line',
                'title'        => __('Featured Gallery', 'cmd-theme'),
                'heading_id'   => 'psm-gallery-featured-heading',
                'intro'        => array(
                    __(
                        'A selection of photographs showcasing community events, harbour life, and the landscapes of Port St Mary.',
                        'cmd-theme'
                    ),
                ),
                'class'        => 'psm-section-header--gallery-featured',
            )
        );
        ?>

        <div class="psm-gallery-masonry" role="list">
            <?php foreach ($items as $item) : ?>
                <?php
                $image = $item['image'] ?: psm_placeholder_image(600, 400, $item['image_seed']);
                $span  = in_array($item['span'], array('a', 'b', 'c', 'd', 'e', 'f', 'g'), true) ? $item['span'] : 'a';
                ?>
                <figure class="psm-gallery-masonry__item psm-gallery-masonry__item--<?php echo esc_attr($span); ?>" role="listitem">
                    <img
                        class="psm-gallery-masonry__img"
                        src="<?php echo esc_url($image); ?>"
                        alt="<?php echo esc_attr($item['alt']); ?>"
                        width="600"
                        height="400"
                        loading="lazy"
                        decoding="async"
                    >
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>
