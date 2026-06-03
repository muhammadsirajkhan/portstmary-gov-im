<?php
/**
 * How To Apply — three-step process row.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_jobs_apply_section($page_id);

$badge = trim((string) $section['badge']);
$title = trim((string) $section['title']);
$steps = array_values(array_filter((array) $section['steps'], static function ($step) {
    return is_array($step) && !empty($step['title']);
}));

$has_header = '' !== $badge || '' !== $title;

if (!$has_header && empty($steps)) {
    return;
}
?>
<section class="psm-jobs-apply" id="how-to-apply"<?php echo $title ? ' aria-labelledby="psm-jobs-apply-heading"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $title ? 'psm-jobs-apply-heading' : '',
                    'align'      => 'center',
                    'class'      => 'psm-section-header--jobs-apply',
                )
            );
            ?>
        <?php endif; ?>

        <?php if (!empty($steps)) : ?>
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
        <?php endif; ?>
    </div>
</section>
