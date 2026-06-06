<?php
/**
 * About Port St Mary — single image + intro copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_local_info_about_section($page_id);

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

$image_alt = $title ?: __('Port St Mary lighthouse', 'cmd-theme');
?>
<section class="psm-local-info-about" id="about-port-st-mary" <?php echo $title ? ' aria-labelledby="psm-local-info-about-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-local-info-about__grid psm-about__grid">
            <?php if ($has_image) : ?>
                <?php
                get_template_part(
                    'template-parts/components/housing-zigzag-media',
                    null,
                    array(
                        'variant'    => 'single-badge',
                        'show_badge' => true,
                        'image'      => $image,
                        'image_seed' => 'psm-local-info-lighthouse',
                        'accent'     => 'tl',
                        'alt'        => $image_alt,
                    )
                );
                ?>
            <?php endif; ?>

            <div class="psm-local-info-about__content psm-about__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'       => $badge,
                            'badge_style' => 'pill',
                            'title'       => $title,
                            'heading_id'  => $title ? 'psm-local-info-about-heading' : '',
                            'align'       => 'left',
                            'class'       => 'psm-section-header--local-info-about',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                    <div class="psm-local-info-about__prose">
                        <?php foreach ($paragraphs as $index => $paragraph) : ?>
                            <p<?php echo 0 === $index ? ' class="psm-about__lead"' : ''; ?>><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
