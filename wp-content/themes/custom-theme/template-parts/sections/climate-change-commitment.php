<?php
/**
 * Climate Change — decorative image + commitment copy and document link.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_climate_change_commitment_section($page_id);

$image          = trim((string) $section['image']);
$badge          = trim((string) $section['badge']);
$title          = trim((string) $section['title']);
$paragraphs     = array_values(array_filter((array) $section['paragraphs']));
$document_label = trim((string) $section['document_label']);
$document_url   = trim((string) $section['document_url']);
$phone          = trim((string) $section['phone']);
$phone_href     = trim((string) $section['phone_href']);
$social_links   = isset($section['social_links']) && is_array($section['social_links']) ? $section['social_links'] : array();

$has_image    = '' !== $image;
$has_header   = '' !== $badge || '' !== $title;
$has_prose    = !empty($paragraphs);
$has_document = '' !== $document_label && '' !== $document_url;
$has_content  = $has_header || $has_prose || $has_document;

if (!$has_image && !$has_content) {
    return;
}

$image_alt  = $title ?: __('Port St Mary Commissioners', 'cmd-theme');
$heading_id = '' !== $title ? 'psm-climate-change-commitment-heading' : '';
?>
<section class="psm-climate-change-commitment" id="climate-change-commitment" <?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-climate-change-commitment__grid psm-about__grid">
            <?php if ($has_image) : ?>
                <div class="psm-climate-change-commitment__media">
                    <?php
                    get_template_part(
                        'template-parts/components/climate-change-media',
                        null,
                        array(
                            'image'      => $image,
                            'image_alt'  => $image_alt,
                            'phone'        => $phone,
                            'phone_href'   => $phone_href,
                            'social_links' => $social_links,
                        )
                    );
                    ?>
                </div>
            <?php endif; ?>

            <?php if ($has_content) : ?>
                <div class="psm-climate-change-commitment__content psm-about__content">
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
                                'class'       => 'psm-section-header--climate-change-commitment',
                            )
                        );
                        ?>
                    <?php endif; ?>

                    <?php if ($has_prose) : ?>
                        <div class="psm-climate-change-commitment__prose">
                            <?php foreach ($paragraphs as $paragraph) : ?>
                                <p><?php echo esc_html($paragraph); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($has_document) : ?>
                        <p class="psm-climate-change-commitment__document">
                            <a
                                class="psm-climate-change-commitment__document-link"
                                href="<?php echo esc_url($document_url); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            ><?php echo esc_html($document_label); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
