<?php
/**
 * Latest Opportunities — job listing cards.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$jobs = psm_get_jobs_opportunities();

if (empty($jobs)) {
    return;
}
?>
<section class="psm-jobs-opportunities" id="latest-opportunities" aria-labelledby="psm-jobs-opportunities-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'      => __('Current Vacancies', 'cmd-theme'),
                'title'      => __('Latest Opportunities', 'cmd-theme'),
                'heading_id' => 'psm-jobs-opportunities-heading',
                'align'      => 'center',
                'class'      => 'psm-section-header--jobs-opportunities',
            )
        );
        ?>

        <div class="psm-jobs-opportunities__list">
            <?php foreach ($jobs as $job) : ?>
                <?php get_template_part('template-parts/components/job-listing-card', null, $job); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
