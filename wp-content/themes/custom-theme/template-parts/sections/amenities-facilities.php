<?php
/**
 * Community Spaces & Facilities — overlapping card rows.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header = psm_get_public_amenities_facilities_header($page_id);
$rows = psm_get_amenities_facility_rows($page_id);

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);

if ('' === $badge && '' === $title && empty($rows)) {
    return;
}
?>
<section class="psm-amenities-facilities" id="community-spaces-facilities" <?php echo $title ? ' aria-labelledby="psm-amenities-facilities-heading"' : ''; ?>>
    <div class="container psm-container">
        <?php if ('' !== $badge || '' !== $title): ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge' => $badge,
                    'badge_style' => 'pill',
                    'title' => $title,
                    'title_dot' => 'period',
                    'heading_id' => 'psm-amenities-facilities-heading',
                    'class' => 'psm-section-header--amenities-facilities',
                )
            );
            ?>
        <?php endif; ?>

        <?php if (!empty($rows)): ?>
            <div class="psm-amenities-facilities__rows">
                <?php foreach ($rows as $index => $row): ?>
                    <?php if ($index > 0): ?>
                        <div class="psm-amenities-facilities__divider" aria-hidden="true">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pa-divider.png" alt="" class="img-fluid">
                        </div>
                    <?php endif; ?>
                    <?php get_template_part('template-parts/components/amenities-facility-row', null, $row); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>