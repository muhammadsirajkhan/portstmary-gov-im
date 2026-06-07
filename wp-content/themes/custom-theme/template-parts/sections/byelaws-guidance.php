<?php
/**
 * Local Byelaws — single image + guidance copy and document links.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_byelaws_guidance_section($page_id);
$documents = psm_get_byelaws_documents($page_id);

$image       = trim((string) $section['image']);
$badge       = trim((string) $section['badge']);
$title       = trim((string) $section['title']);
$subheading  = trim((string) $section['subheading']);
$paragraphs  = array_values(array_filter((array) $section['paragraphs']));

$has_image      = '' !== $image;
$has_header     = '' !== $badge || '' !== $title;
$has_prose      = !empty($paragraphs);
$has_subheading = '' !== $subheading;
$has_documents  = !empty($documents);

if (!$has_image && !$has_header && !$has_prose && !$has_subheading && !$has_documents) {
    return;
}

$image_alt  = $title ?: __('Port St Mary coastal village', 'cmd-theme');
$heading_id = '' !== $title ? 'psm-byelaws-guidance-heading' : '';
?>
<section class="psm-byelaws-guidance" id="local-byelaws-guidance" <?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-byelaws-guidance__grid psm-about__grid">
            <?php if ($has_image) : ?>
                <div class="psm-byelaws-guidance__media psm-about__media psm-about__media--plain">
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

            <div class="psm-byelaws-guidance__content psm-about__content">
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
                            'class'       => 'psm-section-header--byelaws-guidance',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_subheading) : ?>
                    <h3 class="psm-byelaws-guidance__subheading"><?php echo esc_html($subheading); ?></h3>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                    <div class="psm-byelaws-guidance__prose">
                        <?php foreach ($paragraphs as $paragraph) : ?>
                            <p><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($has_documents) : ?>
                    <ul class="psm-byelaws-guidance__documents">
                        <?php foreach ($documents as $document) : ?>
                            <li>
                                <a
                                    class="psm-byelaws-guidance__document-link"
                                    href="<?php echo esc_url($document['file_url']); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                ><?php echo esc_html($document['label']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
