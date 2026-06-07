<?php
/**
 * How to Make a Complaint — single image + guidance copy, contact and CTA.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_complaints_how_to_section($page_id);

$image      = trim((string) $section['image']);
$badge      = trim((string) $section['badge']);
$title      = trim((string) $section['title']);
$paragraphs = array_values(array_filter((array) $section['paragraphs']));
$phone      = trim((string) $section['phone']);
$email      = trim((string) $section['email']);
$button     = (array) $section['button'];

$phone_href = psm_phone_href_from_display($phone);
$email_href = '' !== $email ? 'mailto:' . $email : '';

$has_image   = '' !== $image;
$has_header  = '' !== $badge || '' !== $title;
$has_prose   = !empty($paragraphs);
$has_phone   = '' !== $phone;
$has_email   = '' !== $email;
$has_contact = $has_phone || $has_email;
$has_button  = '' !== trim((string) ($button['url'] ?? ''));

if (!$has_image && !$has_header && !$has_prose && !$has_contact && !$has_button) {
    return;
}

$image_alt  = $title ?: __('Port St Mary coastal town', 'cmd-theme');
$heading_id = '' !== $title ? 'psm-complaints-how-to-heading' : '';
?>
<section class="psm-complaints-how-to" id="how-to-make-a-complaint" <?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-complaints-how-to__grid psm-about__grid">
            <?php if ($has_image) : ?>
                <div class="psm-complaints-how-to__media psm-about__media psm-about__media--plain">
                    <img
                        class="psm-about__img-main"
                        src="<?php echo esc_url($image); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            <?php endif; ?>

            <div class="psm-complaints-how-to__content psm-about__content">
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
                            'class'       => 'psm-section-header--complaints-how-to',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                    <div class="psm-complaints-how-to__prose">
                        <?php foreach ($paragraphs as $index => $paragraph) : ?>
                            <p<?php echo 0 === $index ? ' class="psm-about__lead"' : ''; ?>><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($has_contact) : ?>
                    <ul class="psm-complaints-how-to__contact">
                        <?php if ($has_phone) : ?>
                            <li>
                                <span class="psm-complaints-how-to__contact-icon psm-complaints-how-to__contact-icon--phone" aria-hidden="true"></span>
                                <?php if ($phone_href) : ?>
                                    <a href="<?php echo esc_url($phone_href); ?>"><?php echo esc_html(sprintf(/* translators: %s: phone number */ __('Tel: %s', 'cmd-theme'), $phone)); ?></a>
                                <?php else : ?>
                                    <span><?php echo esc_html(sprintf(/* translators: %s: phone number */ __('Tel: %s', 'cmd-theme'), $phone)); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                        <?php if ($has_email) : ?>
                            <li>
                                <span class="psm-complaints-how-to__contact-icon psm-complaints-how-to__contact-icon--email" aria-hidden="true"></span>
                                <?php if ($email_href) : ?>
                                    <a href="<?php echo esc_url($email_href); ?>"><?php echo esc_html(sprintf(/* translators: %s: email address */ __('Email: %s', 'cmd-theme'), $email)); ?></a>
                                <?php else : ?>
                                    <span><?php echo esc_html(sprintf(/* translators: %s: email address */ __('Email: %s', 'cmd-theme'), $email)); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>

                <?php if ($has_button) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/button-pill',
                        null,
                        array(
                            'text'    => $button['title'] ?: __('Complaints Form', 'cmd-theme'),
                            'url'     => $button['url'],
                            'variant' => 'primary',
                        )
                    );
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
