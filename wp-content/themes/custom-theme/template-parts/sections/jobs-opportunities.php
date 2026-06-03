<?php
/**
 * Latest Opportunities — job listing cards from Jobs CPT.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header  = psm_get_jobs_opportunities_header($page_id);
$jobs    = psm_get_jobs_opportunities();

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);

$has_header = '' !== $badge || '' !== $title;
$has_jobs   = !empty($jobs);

if (!$has_header && !$has_jobs) {
    return;
}
?>
<section class="psm-jobs-opportunities" id="latest-opportunities"<?php echo $title ? ' aria-labelledby="psm-jobs-opportunities-heading"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $title ? 'psm-jobs-opportunities-heading' : '',
                    'align'      => 'center',
                    'class'      => 'psm-section-header--jobs-opportunities',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_jobs) : ?>
            <div class="psm-jobs-opportunities__list">
                <?php foreach ($jobs as $job) : ?>
                    <?php get_template_part('template-parts/components/job-listing-card', null, $job); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
