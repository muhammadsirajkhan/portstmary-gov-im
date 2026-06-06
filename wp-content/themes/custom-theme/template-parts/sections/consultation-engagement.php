<?php
/**
 * Community Consultation & Engagement — single image + copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_consultation_engagement_section($page_id);

$image      = trim((string) $section['image']);
$badge      = trim((string) $section['badge']);
$title      = trim((string) $section['title']);
$paragraphs = array_values(array_filter((array) $section['paragraphs']));

$has_image  = '' !== $image;
$has_header = '' !== $badge || '' !== $title;
$has_prose  = !empty($paragraphs);

if (!$has_image && !$has_header && !$has_prose) {
    return;
}

$image_alt = $title ?: __('Port St Mary harbor consultation', 'cmd-theme');
?>
<section class="psm-consultation-engagement" id="consultation-engagement" <?php echo $title ? ' aria-labelledby="psm-consultation-engagement-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-consultation-engagement__grid psm-about__grid">
            <?php if ($has_image) : ?>
                <?php
                get_template_part(
                    'template-parts/components/housing-zigzag-media',
                    null,
                    array(
                        'variant'    => 'single-badge',
                        'show_badge' => false,
                        'image'      => $image,
                        'image_seed' => 'psm-consultation-engagement',
                        'accent'     => 'tl',
                        'alt'        => $image_alt,
                    )
                );
                ?>
            <?php endif; ?>

            <div class="psm-consultation-engagement__content psm-about__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'       => $badge,
                            'badge_style' => 'pill',
                            'title'       => $title,
                            'heading_id'  => $title ? 'psm-consultation-engagement-heading' : '',
                            'align'       => 'left',
                            'class'       => 'psm-section-header--consultation-engagement',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                    <div class="psm-consultation-engagement__prose">
                        <?php foreach ($paragraphs as $paragraph) : ?>
                            <p><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
