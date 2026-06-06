<?php
/**
 * Why Your Feedback Matters — value cards.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header  = psm_get_consultation_feedback_header($page_id);
$values  = psm_get_consultation_feedback_values($page_id);

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);
$intro = trim((string) $header['intro']);

$has_header = '' !== $badge || '' !== $title || '' !== $intro;
$has_cards  = !empty($values);

if (!$has_header && !$has_cards) {
    return;
}
?>
<section class="psm-consultation-feedback" id="why-feedback-matters" <?php echo $title ? ' aria-labelledby="psm-consultation-feedback-heading"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <div class="psm-consultation-feedback__header">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => $badge,
                        'badge_style' => 'pill',
                        'title'       => $title,
                        'heading_id'  => $title ? 'psm-consultation-feedback-heading' : '',
                        'intro'       => '' !== $intro ? array($intro) : array(),
                        'align'       => 'left',
                        'class'       => 'psm-section-header--consultation-feedback psm-section-header--left',
                    )
                );
                ?>
                <div class="psm-consultation-feedback__stamp" aria-hidden="true">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/badge.png" alt="Port St Mary Commissioners">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($has_cards) : ?>
            <div class="psm-consultation-feedback__grid">
                <?php foreach ($values as $value) : ?>
                    <?php get_template_part('template-parts/components/facility-icon-card', null, $value); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
