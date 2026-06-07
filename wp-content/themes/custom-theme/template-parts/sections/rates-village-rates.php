<?php
/**
 * Village Rates — single image + intro copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id  = (int) get_queried_object_id();
$section  = psm_get_rates_village_rates_section($page_id);
$image    = trim((string) $section['image']);
$badge    = trim((string) $section['badge']);
$title    = trim((string) $section['title']);
$paragraphs = array_values(array_filter((array) $section['paragraphs']));

$has_image  = '' !== $image;
$has_header = '' !== $badge || '' !== $title;
$has_prose  = !empty($paragraphs);

if (!$has_image && !$has_header && !$has_prose) {
    return;
}

$image_alt = $title ?: __('Working at a desk reviewing village rates documents', 'cmd-theme');
?>
<section class="psm-rates-village-rates" id="village-rates" <?php echo $title ? ' aria-labelledby="psm-rates-village-rates-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-rates-village-rates__grid psm-about__grid">
            <?php if ($has_image) : ?>
                <?php
                get_template_part(
                    'template-parts/components/housing-zigzag-media',
                    null,
                    array(
                        'variant'    => 'single-badge',
                        'show_badge' => true,
                        'image'      => $image,
                        'image_seed' => 'psm-rates-village-rates',
                        'accent'     => 'tl',
                        'alt'        => $image_alt,
                    )
                );
                ?>
            <?php endif; ?>

            <div class="psm-rates-village-rates__content psm-about__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'       => $badge,
                            'badge_style' => 'pill',
                            'title'       => $title,
                            'heading_id'  => $title ? 'psm-rates-village-rates-heading' : '',
                            'align'       => 'left',
                            'class'       => 'psm-section-header--rates-village-rates',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                    <div class="psm-rates-village-rates__prose">
                        <?php foreach ($paragraphs as $index => $paragraph) : ?>
                            <p<?php echo 0 === $index ? ' class="psm-about__lead"' : ''; ?>><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
