<?php
/**
 * Boat Park Facilities — icon cards + feature image.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_boat_park_facilities_section($page_id);

$badge         = trim((string) $section['badge']);
$title         = trim((string) $section['title']);
$intro         = trim((string) $section['intro']);
$cards         = array_values(array_filter((array) $section['cards']));
$feature_image = trim((string) $section['feature_image']);

if ('' === $badge && '' === $title && '' === $intro && empty($cards) && '' === $feature_image) {
    return;
}

if ('' === $feature_image) {
    $feature_image = psm_placeholder_image(1200, 520, 'psm-boat-park-pier');
}
?>
<section class="psm-boat-park-facilities" id="boat-park-facilities"<?php echo $title ? ' aria-labelledby="psm-boat-park-facilities-heading"' : ''; ?>>
    <div class="container psm-container">
        <?php if ('' !== $badge || '' !== $title || '' !== $intro) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'       => $badge,
                    'badge_style' => 'pill',
                    'title'       => $title,
                    'heading_id'  => 'psm-boat-park-facilities-heading',
                    'intro'       => '' !== $intro ? array($intro) : array(),
                    'class'       => 'psm-section-header--boat-park-facilities',
                )
            );
            ?>
        <?php endif; ?>

        <?php if (!empty($cards)) : ?>
            <div class="psm-boat-park-facilities__grid">
                <?php foreach ($cards as $facility) : ?>
                    <?php get_template_part('template-parts/components/facility-icon-card', null, $facility); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <img
            class="psm-boat-park-facilities__feature"
            src="<?php echo esc_url($feature_image); ?>"
            alt="<?php esc_attr_e('Stone pier and lighthouse at Port St Mary boat park', 'cmd-theme'); ?>"
            width="1200"
            height="520"
            loading="lazy"
            decoding="async"
        >
    </div>
</section>
