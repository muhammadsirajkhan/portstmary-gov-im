<?php
/**
 * About Port St Mary Commissioners — single image + copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_who_we_are_about_section($page_id);

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

$image_alt = $title ?: __('Port St Mary Commissioners', 'cmd-theme');
$image_src = $image ?: psm_placeholder_image(600, 720, 'psm-who-we-are-about');
?>
<section class="psm-who-we-are-about" id="about-port-st-mary-commissioners" <?php echo $title ? ' aria-labelledby="psm-who-we-are-about-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-who-we-are-about__grid psm-about__grid">
            <?php if ($has_image || $has_header || $has_prose) : ?>
                <div class="psm-who-we-are-about__media psm-about__media psm-about__media--plain">
                    <img
                        class="psm-about__img-main"
                        src="<?php echo esc_url($image_src); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        width="600"
                        height="720"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            <?php endif; ?>

            <div class="psm-who-we-are-about__content psm-about__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'       => $badge,
                            'badge_style' => 'red',
                            'title'       => $title,
                            'heading_id'  => $title ? 'psm-who-we-are-about-heading' : '',
                            'align'       => 'left',
                            'class'       => 'psm-section-header--who-we-are-about',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                    <div class="psm-who-we-are-about__prose">
                        <?php foreach ($paragraphs as $index => $paragraph) : ?>
                            <p<?php echo 0 === $index ? ' class="psm-about__lead"' : ''; ?>><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
