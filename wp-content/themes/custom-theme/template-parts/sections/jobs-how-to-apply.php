<?php
/**
 * How To Apply — three-step process row.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$steps = psm_get_jobs_apply_steps();
?>
<section class="psm-jobs-apply" id="how-to-apply" aria-labelledby="psm-jobs-apply-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'      => __('Application Process', 'cmd-theme'),
                'title'      => __('How To Apply', 'cmd-theme'),
                'heading_id' => 'psm-jobs-apply-heading',
                'align'      => 'center',
                'class'      => 'psm-section-header--jobs-apply',
            )
        );
        ?>

        <div class="psm-jobs-process" role="list">
            <?php foreach ($steps as $index => $step) : ?>
                <?php if ($index > 0) : ?>
                    <span class="psm-jobs-process__connector" aria-hidden="true"></span>
                <?php endif; ?>
                <div class="psm-jobs-process__item" role="listitem">
                    <?php
                    get_template_part(
                        'template-parts/components/jobs-process-step',
                        null,
                        array_merge(
                            $step,
                            array('number' => $index + 1)
                        )
                    );
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
