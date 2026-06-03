<?php
/**
 * Community Housing Tenders — single image + copy + PDF CTA.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_southern_sheltered_tenders_section($page_id);

$image  = trim((string) $section['image']);
$badge  = trim((string) $section['badge']);
$title  = trim((string) $section['title']);
$lead   = trim((string) $section['lead']);
$body   = trim((string) $section['body']);
$button = wp_parse_args(
    (array) $section['button'],
    array(
        'title'  => '',
        'url'    => '',
        'target' => '',
    )
);

$has_image  = '' !== $image;
$has_header = '' !== $badge || '' !== $title;
$has_lead   = '' !== $lead;
$has_body   = '' !== trim(wp_strip_all_tags($body));
$has_button = '' !== $button['url'];

if (!$has_image && !$has_header && !$has_lead && !$has_body && !$has_button) {
    return;
}

$image_alt = $title ?: __('Sheltered housing in Port St Mary', 'cmd-theme');
?>
<section class="psm-southern-sheltered-tenders" id="community-housing-tenders"<?php echo $title ? ' aria-labelledby="psm-southern-sheltered-tenders-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-southern-sheltered-tenders__grid psm-about__grid">
            <?php if ($has_image) : ?>
                <div class="psm-southern-sheltered-tenders__media psm-about__media psm-about__media--plain">
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

            <div class="psm-southern-sheltered-tenders__content psm-about__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'      => $badge,
                            'title'      => $title,
                            'heading_id' => $title ? 'psm-southern-sheltered-tenders-heading' : '',
                            'align'      => 'left',
                            'class'      => 'psm-section-header--southern-sheltered',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_lead) : ?>
                    <p class="psm-about__lead psm-southern-sheltered-tenders__lead"><?php echo esc_html($lead); ?></p>
                <?php endif; ?>

                <?php if ($has_body) : ?>
                    <div class="psm-southern-sheltered-tenders__prose">
                        <?php echo wp_kses_post($body); ?>
                    </div>
                <?php endif; ?>

                <?php if ($has_button) : ?>
                    <div class="psm-southern-sheltered-tenders__cta">
                        <?php
                        get_template_part(
                            'template-parts/components/button-pill',
                            null,
                            array(
                                'text' => $button['title'] ?: __('Download PDF', 'cmd-theme'),
                                'url'  => $button['url'],
                            )
                        );
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
