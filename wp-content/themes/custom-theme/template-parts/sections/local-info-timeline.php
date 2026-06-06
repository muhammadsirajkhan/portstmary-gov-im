<?php
/**
 * History Timeline — alternating central axis layout.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id      = (int) get_queried_object_id();
$header       = psm_get_local_info_timeline_header($page_id);
$entries      = psm_get_local_info_timeline_entries($page_id);
$footer_html  = psm_get_local_info_timeline_footer_html($page_id);

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);
$intro = trim((string) $header['intro']);

$has_header  = '' !== $badge || '' !== $title || '' !== $intro;
$has_entries = !empty($entries);
$has_footer  = '' !== $footer_html;

if (!$has_header && !$has_entries && !$has_footer) {
    return;
}
?>
<section class="psm-local-info-timeline" id="history-timeline" <?php echo $title ? ' aria-labelledby="psm-local-info-timeline-heading"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'       => $badge,
                    'badge_style' => 'pill',
                    'title'       => $title,
                    'heading_id'  => $title ? 'psm-local-info-timeline-heading' : '',
                    'intro'       => '' !== $intro ? array($intro) : array(),
                    'class'       => 'psm-section-header--local-info-timeline',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_entries) : ?>
            <div class="psm-history-timeline">
                <span class="psm-history-timeline__line" aria-hidden="true"></span>
                <span class="psm-history-timeline__start" aria-hidden="true"></span>
                <?php foreach ($entries as $entry) : ?>
                    <?php get_template_part('template-parts/components/history-timeline-entry', null, $entry); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($has_footer) : ?>
            <p class="psm-local-info-timeline__resources">
                <?php
                echo wp_kses(
                    $footer_html,
                    array(
                        'a' => array(
                            'href'   => true,
                            'target' => true,
                            'rel'    => true,
                        ),
                    )
                );
                ?>
            </p>
        <?php endif; ?>
    </div>
</section>
