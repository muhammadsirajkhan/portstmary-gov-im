<?php
/**
 * Community Consultation & Engagement — about media + copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$img_main = psm_theme_image('consultation-harbor.jpg') ?: '';
$img_sub  = psm_theme_image('consultation-coast.jpg') ?: '';
?>
<section class="psm-consultation-engagement" id="consultation-engagement" aria-labelledby="psm-consultation-engagement-heading">
    <div class="container psm-container">
        <div class="psm-consultation-engagement__grid psm-about__grid">
            <?php
            get_template_part(
                'template-parts/components/about-media',
                null,
                array(
                    'image_main'         => $img_main,
                    'image_sub'          => $img_sub,
                    'image_main_alt'     => __('Port St Mary harbor consultation', 'cmd-theme'),
                    'image_sub_alt'      => __('Coastal view near Port St Mary', 'cmd-theme'),
                    'show_experience'    => true,
                    'show_welcome_badge' => true,
                    'show_accent'        => true,
                )
            );
            ?>

            <div class="psm-consultation-engagement__content psm-about__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => __('About Our Work', 'cmd-theme'),
                        'badge_style' => 'red',
                        'title'       => __('Community Consultation & Engagement', 'cmd-theme'),
                        'heading_id'  => 'psm-consultation-engagement-heading',
                        'align'       => 'left',
                        'class'       => 'psm-section-header--consultation-engagement',
                    )
                );
                ?>

                <div class="psm-consultation-engagement__prose">
                    <?php foreach (psm_get_consultation_engagement_paragraphs() as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
