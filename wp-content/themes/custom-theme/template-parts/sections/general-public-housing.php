<?php
/**
 * Supporting Local Housing Needs — single image + intro copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$data    = psm_get_general_public_housing_section($page_id);

$badge      = trim((string) $data['badge']);
$title      = trim((string) $data['title']);
$paragraphs = !empty($data['paragraphs']) ? (array) $data['paragraphs'] : array();
$image      = $data['image'] ?: psm_placeholder_image(600, 720, 'psm-general-public-housing');

$has_badge      = '' !== $badge;
$has_title      = '' !== $title;
$has_paragraphs = !empty($paragraphs);

if (!$has_badge && !$has_title && !$has_paragraphs && '' === $data['image']) {
    return;
}

$heading_id = $has_title ? 'psm-general-public-housing-heading' : '';
?>
<section class="psm-general-public-housing" id="supporting-housing"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-general-public-housing__grid psm-about__grid">
            <div class="psm-general-public-housing__media psm-about__media psm-about__media--plain">
                <img
                    class="psm-about__img-main"
                    src="<?php echo esc_url($image); ?>"
                    alt="<?php echo esc_attr($title ?: __('Supporting local housing in Port St Mary', 'cmd-theme')); ?>"
                    width="600"
                    height="720"
                    loading="lazy"
                    decoding="async"
                >
            </div>

            <div class="psm-general-public-housing__content psm-about__content">
                <?php if ($has_badge || $has_title) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'      => $badge,
                            'title'      => $title,
                            'heading_id' => $heading_id,
                            'align'      => 'left',
                            'class'      => 'psm-section-header--general-public-housing',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_paragraphs) : ?>
                <div class="psm-general-public-housing__prose">
                    <?php foreach ($paragraphs as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
