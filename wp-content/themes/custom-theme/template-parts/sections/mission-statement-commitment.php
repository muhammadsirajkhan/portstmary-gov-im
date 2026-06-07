<?php
/**
 * Mission Statement — single image + commitment copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_mission_statement_commitment_section($page_id);

$image          = trim((string) $section['image']);
$badge          = trim((string) $section['badge']);
$title          = trim((string) $section['title']);
$paragraphs     = array_values(array_filter((array) $section['paragraphs']));
$document_label = trim((string) $section['document_label']);
$document_url   = trim((string) $section['document_url']);

$has_image    = '' !== $image;
$has_header   = '' !== $badge || '' !== $title;
$has_prose    = !empty($paragraphs);
$has_document = '' !== $document_label && '' !== $document_url;

if (!$has_image && !$has_header && !$has_prose && !$has_document) {
    return;
}

$image_alt = $title ?: __('Port St Mary harbor', 'cmd-theme');
$heading_id = '' !== $title ? 'psm-mission-statement-commitment-heading' : '';
?>
<section class="psm-mission-statement-commitment" id="our-commitment-to-the-community" <?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-mission-statement-commitment__grid psm-about__grid">
            <?php if ($has_image) : ?>
                <div class="psm-mission-statement-commitment__media psm-about__media psm-about__media--plain">
                    <img
                        class="psm-about__img-main"
                        src="<?php echo esc_url($image); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        width="600"
                        height="720"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            <?php endif; ?>

            <div class="psm-mission-statement-commitment__content psm-about__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'       => $badge,
                            'badge_style' => 'pill',
                            'title'       => $title,
                            'heading_id'  => $heading_id,
                            'align'       => 'left',
                            'class'       => 'psm-section-header--mission-statement-commitment',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                    <div class="psm-mission-statement-commitment__prose">
                        <?php foreach ($paragraphs as $index => $paragraph) : ?>
                            <p<?php echo 0 === $index ? ' class="psm-about__lead"' : ''; ?>><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($has_document) : ?>
                    <p class="psm-mission-statement-commitment__document">
                        <a
                            class="psm-mission-statement-commitment__document-link"
                            href="<?php echo esc_url($document_url); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                        ><?php echo esc_html($document_label); ?></a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
