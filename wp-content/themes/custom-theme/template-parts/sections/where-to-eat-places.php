<?php
/**
 * Places to Eat — dining venue card grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header  = psm_get_where_to_eat_places_header($page_id);
$places  = psm_get_where_to_eat_places($page_id);

$badge  = trim((string) $header['badge']);
$title  = trim((string) $header['title']);
$intro  = trim((string) $header['intro']);

$has_header = '' !== $badge || '' !== $title || '' !== $intro;
$has_places = !empty($places);

if (!$has_header && !$has_places) {
    return;
}
?>
<section class="psm-where-to-eat-places" id="places-to-eat" <?php echo $title ? ' aria-labelledby="psm-where-to-eat-places-heading"' : ''; ?>>
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
                    'heading_id'  => $title ? 'psm-where-to-eat-places-heading' : '',
                    'intro'       => '' !== $intro ? array($intro) : array(),
                    'class'       => 'psm-section-header--where-to-eat-places',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_places) : ?>
            <div class="psm-where-to-eat-places__grid">
                <?php foreach ($places as $place) : ?>
                    <?php get_template_part('template-parts/components/dining-place-card', null, $place); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
