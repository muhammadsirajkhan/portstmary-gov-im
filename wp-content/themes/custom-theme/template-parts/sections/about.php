<?php
/**
 * About section — image + content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
if (!$page_id && is_front_page()) {
    $page_id = (int) get_option('page_on_front');
}

$image   = '';
$badge   = '';
$title   = '';
$lead    = '';
$body    = '';
$closing = '';
$button  = array(
    'url'    => '',
    'title'  => '',
    'target' => '',
);

if ($page_id && function_exists('get_field')) {
    $acf_image = get_field('about_image', $page_id);
    if (is_array($acf_image)) {
        $image = isset($acf_image['url']) ? $acf_image['url'] : '';
    } elseif (is_numeric($acf_image)) {
        $image = wp_get_attachment_image_url((int) $acf_image, 'full') ?: '';
    } else {
        $image = (string) $acf_image;
    }

    $badge   = get_field('about_badge', $page_id);
    $title   = get_field('about_title', $page_id);
    $lead    = get_field('about_lead', $page_id);
    $body    = get_field('about_body', $page_id);
    $closing = get_field('about_closing', $page_id);

    $acf_button = get_field('about_button', $page_id);
    if (is_array($acf_button)) {
        $button = array(
            'url'    => isset($acf_button['url']) ? trim((string) $acf_button['url']) : '',
            'title'  => isset($acf_button['title']) ? trim((string) $acf_button['title']) : '',
            'target' => isset($acf_button['target']) ? trim((string) $acf_button['target']) : '',
        );
    }
}

$image   = trim((string) $image);
$badge   = trim((string) $badge);
$title   = trim((string) $title);
$lead    = trim((string) $lead);
$body    = trim((string) $body);
$closing = trim((string) $closing);

$has_image   = '' !== $image;
$has_header  = '' !== $badge || '' !== $title;
$has_lead    = '' !== $lead;
$has_body    = '' !== trim(wp_strip_all_tags($body));
$has_closing = '' !== $closing;
$has_button  = '' !== $button['url'];

$site_phone    = psm_get_site_phone();
$phone_display = $site_phone['display'];
$phone_href    = $site_phone['href'];

if (!$has_image && !$has_header && !$has_lead && !$has_body && !$has_closing && !$has_button) {
    return;
}

$section_attrs = 'class="psm-about" id="about"';
if ($title) {
    $section_attrs .= ' aria-labelledby="psm-about-heading"';
}
?>
<section <?php echo $section_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
    <div class="container psm-container">
        <div class="psm-about__grid">
            <?php if ($has_image) : ?>
                <div class="psm-about__media psm-about__media--plain">
                    <img
                        class="psm-about__img-main"
                        src="<?php echo esc_url($image); ?>"
                        alt="<?php echo esc_attr($title); ?>"
                        width="600"
                        height="720"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            <?php endif; ?>

            <div class="psm-about__content">
                    <?php if ($has_header) : ?>
                        <?php
                        get_template_part(
                            'template-parts/components/section-header',
                            null,
                            array(
                                'badge'      => $badge,
                                'title'      => $title,
                                'heading_id' => $title ? 'psm-about-heading' : '',
                                'align'      => 'left',
                            )
                        );
                        ?>
                    <?php endif; ?>

                    <?php if ($has_lead) : ?>
                        <p class="psm-about__lead"><?php echo esc_html($lead); ?></p>
                    <?php endif; ?>

                    <?php if ($has_body || $has_closing) : ?>
                        <div class="psm-about__prose">
                            <?php if ($has_body) : ?>
                                <?php echo wp_kses_post($body); ?>
                            <?php endif; ?>
                            <?php if ($has_closing) : ?>
                                <p class="psm-about__closing"><?php echo esc_html($closing); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    get_template_part(
                        'template-parts/components/section-cta',
                        null,
                        array(
                            'button_text'   => $button['title'],
                            'button_url'    => $button['url'],
                            'button_target' => $button['target'],
                            'phone_display' => $phone_display,
                            'phone_href'    => $phone_href,
                            'align'         => 'left',
                        )
                    );
                    ?>
            </div>
        </div>
    </div>
</section>
