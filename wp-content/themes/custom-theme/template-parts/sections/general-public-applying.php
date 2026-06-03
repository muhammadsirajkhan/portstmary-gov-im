<?php
/**
 * Applying for Housing — four process step cards.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_general_public_applying_section($page_id);
$steps   = psm_get_general_public_housing_steps($page_id);

$badge = trim((string) $section['badge']);
$title = trim((string) $section['title']);
$intro = !empty($section['intro']) ? (array) $section['intro'] : array();

if ('' === $badge && '' === $title && empty($intro) && empty($steps)) {
    return;
}

$heading_id = '' !== $title ? 'psm-general-public-applying-heading' : '';
?>
<section class="psm-general-public-applying" id="applying-for-housing"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($badge || $title || !empty($intro)) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $heading_id,
                    'intro'      => $intro,
                    'class'      => 'psm-section-header--general-public-applying',
                )
            );
            ?>
        <?php endif; ?>

        <?php if (!empty($steps)) : ?>
        <div class="psm-general-public-applying__grid">
            <?php foreach ($steps as $index => $step) : ?>
                <?php
                if (!isset($step['step'])) {
                    $step['step'] = str_pad((string) ((int) $index + 1), 2, '0', STR_PAD_LEFT);
                }
                get_template_part('template-parts/components/housing-step-card', null, $step);
                ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
