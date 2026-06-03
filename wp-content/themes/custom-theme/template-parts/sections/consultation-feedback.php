<?php
/**
 * Why Your Feedback Matters — value cards.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$values = psm_get_consultation_feedback_values();
?>
<section class="psm-consultation-feedback" id="why-feedback-matters" aria-labelledby="psm-consultation-feedback-heading">
    <div class="container psm-container">
        <div class="psm-consultation-feedback__header">
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'       => __('Our Core Values', 'cmd-theme'),
                    'badge_style' => 'red',
                    'title'       => __('Why Your Feedback Matters', 'cmd-theme'),
                    'heading_id'  => 'psm-consultation-feedback-heading',
                    'intro'       => array(
                        __(
                            'Consultation helps Commissioners understand community priorities and make informed decisions that reflect local needs.',
                            'cmd-theme'
                        ),
                    ),
                    'align'       => 'left',
                    'class'       => 'psm-section-header--consultation-feedback psm-section-header--left',
                )
            );
            ?>
            <div class="psm-consultation-feedback__stamp" aria-hidden="true">
                <?php get_template_part('template-parts/components/welcome-badge'); ?>
            </div>
        </div>

        <div class="psm-consultation-feedback__grid">
            <?php foreach ($values as $value) : ?>
                <?php get_template_part('template-parts/components/facility-icon-card', null, $value); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
