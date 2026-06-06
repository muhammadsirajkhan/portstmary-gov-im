<?php
/**
 * Current Consultations — horizontal card grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id       = (int) get_queried_object_id();
$header        = psm_get_consultation_current_header($page_id);
$consultations = psm_get_current_consultations($page_id);

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);
$intro = trim((string) $header['intro']);

$has_header = '' !== $badge || '' !== $title || '' !== $intro;
$has_cards  = !empty($consultations);

if (!$has_header && !$has_cards) {
    return;
}
?>
<section class="psm-consultation-current" id="current-consultations" <?php echo $title ? ' aria-labelledby="psm-consultation-current-heading"' : ''; ?>>
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
                    'heading_id'  => $title ? 'psm-consultation-current-heading' : '',
                    'intro'       => '' !== $intro ? array($intro) : array(),
                    'class'       => 'psm-section-header--consultation-current',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_cards) : ?>
            <div class="psm-consultation-current__grid">
                <?php foreach ($consultations as $item) : ?>
                    <?php get_template_part('template-parts/components/consultation-card', null, $item); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
