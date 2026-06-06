<?php
/**
 * Supporting Community Spaces — single image + intro copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_public_amenities_intro_section($page_id);

$image      = trim((string) $section['image']);
$layout     = 'image-right' === $section['layout'] ? 'image-right' : 'image-left';
$badge      = trim((string) $section['badge']);
$title      = trim((string) $section['title']);
$paragraphs = array_values(array_filter((array) $section['paragraphs']));

$has_image  = '' !== $image;
$has_header = '' !== $badge || '' !== $title;
$has_prose  = !empty($paragraphs);

if (!$has_image && !$has_header && !$has_prose) {
    return;
}

$grid_class = 'psm-amenities-intro__grid psm-about__grid';
if ('image-right' === $layout) {
    $grid_class .= ' psm-amenities-intro__grid--image-right';
}

$image_alt = $title ?: __('Community spaces in Port St Mary', 'cmd-theme');
?>
<section class="psm-amenities-intro" id="supporting-community-spaces"<?php echo $title ? ' aria-labelledby="psm-amenities-intro-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="<?php echo esc_attr($grid_class); ?>">
            <?php if ($has_image) : ?>
                <?php
                get_template_part(
                    'template-parts/components/housing-zigzag-media',
                    null,
                    array(
                        'variant'    => 'single-badge',
                        'show_badge' => false,
                        'image'      => $image,
                        'image_seed' => 'psm-amenities-intro',
                        'accent'     => 'tl',
                        'alt'        => $image_alt,
                    )
                );
                ?>
            <?php endif; ?>

            <div class="psm-amenities-intro__content psm-about__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'       => $badge,
                            'title'       => $title,
                            'heading_id'  => 'psm-amenities-intro-heading',
                            'align'       => 'left',
                            'class'       => 'psm-section-header--amenities-intro',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                    <div class="psm-amenities-intro__prose">
                        <?php foreach ($paragraphs as $paragraph) : ?>
                            <p><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
