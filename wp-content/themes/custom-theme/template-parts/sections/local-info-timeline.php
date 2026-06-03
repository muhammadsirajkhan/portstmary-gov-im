<?php
/**
 * History Timeline — alternating central axis layout.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$entries   = psm_get_local_info_timeline_entries();
$resources = psm_get_local_info_timeline_resources();
?>
<section class="psm-local-info-timeline" id="history-timeline" aria-labelledby="psm-local-info-timeline-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'       => __('Timeline', 'cmd-theme'),
                'badge_style' => 'red',
                'title'       => __('History Timeline', 'cmd-theme'),
                'heading_id'  => 'psm-local-info-timeline-heading',
                'intro'       => array(
                    __(
                        'Discover key moments in Port St Mary\'s development from a working harbor to the community we know today.',
                        'cmd-theme'
                    ),
                ),
                'class'       => 'psm-section-header--local-info-timeline',
            )
        );
        ?>

        <div class="psm-history-timeline">
            <span class="psm-history-timeline__line" aria-hidden="true"></span>
            <?php foreach ($entries as $entry) : ?>
                <?php get_template_part('template-parts/components/history-timeline-entry', null, $entry); ?>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($resources)) : ?>
            <p class="psm-local-info-timeline__resources">
                <?php esc_html_e('Further reading:', 'cmd-theme'); ?>
                <?php foreach ($resources as $index => $resource) : ?>
                    <?php if ($index > 0) : ?>
                        <span class="psm-local-info-timeline__resources-sep" aria-hidden="true"> · </span>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($resource['url']); ?>"><?php echo esc_html($resource['label']); ?></a>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>
    </div>
</section>
