<?php
/**
 * Work With Us — single image + copy + benefits.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$copy = psm_get_jobs_work_with_us_copy();
?>
<section class="psm-jobs-work" id="work-with-us" aria-labelledby="psm-jobs-work-heading">
    <div class="container psm-container">
        <div class="psm-jobs-work__grid psm-about__grid">
            <?php
            get_template_part(
                'template-parts/components/housing-zigzag-media',
                null,
                array(
                    'variant'    => 'single-badge',
                    'show_badge' => true,
                    'image'      => psm_theme_image('jobs-work.jpg') ?: '',
                    'image_seed' => 'psm-jobs-work',
                    'accent'     => 'tl',
                    'alt'        => __('Work with Port St Mary Commissioners', 'cmd-theme'),
                )
            );
            ?>

            <div class="psm-jobs-work__content psm-about__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'      => __('Opportunities', 'cmd-theme'),
                        'title'      => __('Work With Us', 'cmd-theme'),
                        'heading_id' => 'psm-jobs-work-heading',
                        'align'      => 'left',
                        'class'      => 'psm-section-header--southern-sheltered',
                    )
                );
                ?>

                <?php if (!empty($copy['lead'])) : ?>
                    <p class="psm-about__lead"><?php echo esc_html($copy['lead']); ?></p>
                <?php endif; ?>

                <?php if (!empty($copy['body'])) : ?>
                    <div class="psm-jobs-work__prose psm-venue-zigzag__prose">
                        <p><?php echo esc_html($copy['body']); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($copy['benefits_intro'])) : ?>
                    <p class="psm-jobs-work__benefits-intro"><?php echo esc_html($copy['benefits_intro']); ?></p>
                <?php endif; ?>

                <?php
                get_template_part(
                    'template-parts/components/housing-check-list',
                    null,
                    array(
                        'items' => $copy['benefits'],
                    )
                );
                ?>
            </div>
        </div>
    </div>
</section>
