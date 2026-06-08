<?php
/**
 * Climate Change — decorative image + commitment copy and document link.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$commitment_defaults = psm_mission_statement_commitment_defaults();

$badge          = $commitment_defaults['badge'];
$title          = $commitment_defaults['title'];
$document_label = $commitment_defaults['document_label'];
$document_url   = '#';

$paragraphs = array_values(
    array_filter(
        array_map(
            'trim',
            preg_split('/\r\n|\r|\n/', psm_mission_statement_commitment_body_default_lines())
        )
    )
);

$image_alt  = $title ?: __('Port St Mary harbor', 'cmd-theme');
$heading_id = 'psm-climate-change-commitment-heading';
$image      = psm_theme_image('c-image.webp') ?: psm_placeholder_image(600, 720, 'psm-climate-change-commitment');
$phone_href = 'tel:+441624832101';
?>
<section class="psm-climate-change-commitment" id="climate-change-commitment" aria-labelledby="<?php echo esc_attr($heading_id); ?>">
    <div class="container psm-container">
        <div class="psm-climate-change-commitment__grid psm-about__grid">
            <div class="psm-climate-change-commitment__media">
                <?php
                get_template_part(
                    'template-parts/components/climate-change-media',
                    null,
                    array(
                        'image'      => $image,
                        'image_alt'  => $image_alt,
                        'phone_href' => $phone_href,
                    )
                );
                ?>
            </div>

            <div class="psm-climate-change-commitment__content psm-about__content">
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

                <div class="psm-climate-change-commitment__prose">
                    <?php foreach ($paragraphs as $index => $paragraph) : ?>
                        <p<?php echo 0 === $index ? ' class="psm-about__lead"' : ''; ?>><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>

                <?php if ('' !== $document_label && '' !== $document_url) : ?>
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
        </div>
    </div>
</section>
