<?php
/**
 * Featured Places to Stay — accommodation card grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header  = psm_get_where_to_stay_featured_header($page_id);
$items   = psm_get_where_to_stay_accommodations($page_id);

$badge    = trim((string) $header['badge']);
$title    = trim((string) ($header['title'] ?? ''));
$intro    = trim((string) $header['intro']);
$category = trim((string) $header['category']);

$has_header = '' !== $badge || '' !== $title || '' !== $intro || '' !== $category;
$has_items  = !empty($items);

if (!$has_header && !$has_items) {
    return;
}
?>
<section class="psm-where-to-stay-featured" id="featured-places-to-stay" <?php echo $title ? ' aria-labelledby="psm-where-to-stay-featured-heading"' : ''; ?>>
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
                    'heading_id'  => $title ? 'psm-where-to-stay-featured-heading' : '',
                    'intro'       => '' !== $intro ? array($intro) : array(),
                    'class'       => 'psm-section-header--where-to-stay-featured',
                )
            );
            ?>
            <?php if ($category) : ?>
                <p class="psm-where-to-stay-featured__category"><?php echo esc_html(strtoupper($category)); ?></p>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($has_items) : ?>
            <div class="psm-where-to-stay-featured__grid">
                <?php foreach ($items as $item) : ?>
                    <?php get_template_part('template-parts/components/accommodation-place-card', null, $item); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
