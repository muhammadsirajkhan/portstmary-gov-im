<?php
/**
 * Our Officers — profile card grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header  = psm_get_commissioners_officers_header($page_id);
$officers = psm_get_commissioners_officers($page_id);

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);

if ('' === $badge && '' === $title && empty($officers)) {
    return;
}

$heading_id = '' !== $title ? 'psm-commissioners-officers-heading' : '';
?>
<section class="psm-commissioners-officers" id="our-officers"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($badge || $title) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $heading_id,
                    'class'      => 'psm-section-header--commissioners-officers',
                )
            );
            ?>
        <?php endif; ?>

        <?php if (!empty($officers)) : ?>
        <div class="psm-commissioners-officers__grid">
            <?php foreach ($officers as $officer) : ?>
                <?php get_template_part('template-parts/components/officer-card', null, $officer); ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
