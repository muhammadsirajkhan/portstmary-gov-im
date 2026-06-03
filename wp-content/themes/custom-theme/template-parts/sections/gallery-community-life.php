<?php
/**
 * Capturing Community Life — collage + intro copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;
?>
<section class="psm-gallery-community-life" id="capturing-community-life" aria-labelledby="psm-gallery-community-life-heading">
    <div class="container psm-container">
        <div class="psm-gallery-community-life__grid psm-about__grid">
            <?php
            get_template_part(
                'template-parts/components/gallery-life-media',
                null,
                array(
                    'image_main' => psm_theme_image('gallery-life-main.jpg') ?: '',
                    'image_sub'  => psm_theme_image('gallery-life-sub.jpg') ?: '',
                )
            );
            ?>

            <div class="psm-gallery-community-life__content psm-about__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'        => __('Port St Mary Commissioners', 'cmd-theme'),
                        'badge_style'  => 'line',
                        'title'        => __('Capturing Community Life', 'cmd-theme'),
                        'heading_id'   => 'psm-gallery-community-life-heading',
                        'align'        => 'left',
                        'class'        => 'psm-section-header--gallery-community-life',
                    )
                );
                ?>

                <div class="psm-gallery-community-life__prose">
                    <?php foreach (psm_get_gallery_community_life_paragraphs() as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
