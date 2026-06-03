<?php
/**
 * About Port St Mary — image + intro copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;
?>
<section class="psm-local-info-about" id="about-port-st-mary" aria-labelledby="psm-local-info-about-heading">
    <div class="container psm-container">
        <div class="psm-local-info-about__grid psm-about__grid">
            <?php
            get_template_part(
                'template-parts/components/housing-zigzag-media',
                null,
                array(
                    'variant'    => 'single-badge',
                    'image'      => psm_theme_image('local-info-lighthouse.jpg') ?: '',
                    'image_seed' => 'psm-local-info-lighthouse',
                    'accent'     => 'tl',
                    'alt'        => __('Port St Mary lighthouse', 'cmd-theme'),
                )
            );
            ?>

            <div class="psm-local-info-about__content psm-about__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => __('Welcome to', 'cmd-theme'),
                        'badge_style' => 'line',
                        'title'       => __('About Port St Mary', 'cmd-theme'),
                        'heading_id'  => 'psm-local-info-about-heading',
                        'align'       => 'left',
                        'class'       => 'psm-section-header--local-info-about',
                    )
                );
                ?>

                <div class="psm-local-info-about__prose">
                    <?php foreach (psm_get_local_info_about_paragraphs() as $index => $paragraph) : ?>
                        <p<?php echo 0 === $index ? ' class="psm-local-info-about__lead"' : ''; ?>><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
