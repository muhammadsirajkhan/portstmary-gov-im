<?php
/**
 * Contact section — info column + Contact Form 7 card.
 *
 * @package CMD_Theme
 *
 * CF7 form markup (add in WP admin). Use these classes on fields:
 * your-name  → class:psm-cf7-input psm-cf7-input--user
 * your-email → class:psm-cf7-input psm-cf7-input--email
 * your-phone → class:psm-cf7-input psm-cf7-input--phone
 * work-type  → class:psm-cf7-input psm-cf7-input--work
 * your-message → class:psm-cf7-input psm-cf7-input--message
 * your-file  → class:psm-cf7-input psm-cf7-input--file
 * Submit button → class:psm-cf7-submit
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();

$label = '';
$title = '';
$subtitle = '';
$lead = '';
$phone = '';
$email = '';
$address = '';
$button = array(
    'url' => '',
    'title' => '',
    'target' => '',
);
$facebook_url = '';
$twitter_url = '';
$form_title = '';
$form_intro = '';

if ($page_id && function_exists('get_field')) {
    $label = get_field('contact_info_label', $page_id);
    $title = get_field('contact_info_title', $page_id);
    $subtitle = get_field('contact_info_subtitle', $page_id);
    $lead = get_field('contact_info_lead', $page_id);
    $phone = get_field('contact_phone', $page_id);
    $email = get_field('contact_email', $page_id);
    $address = get_field('contact_address', $page_id);

    $acf_button = get_field('contact_cta_button', $page_id);
    if (is_array($acf_button)) {
        $button = array(
            'url' => isset($acf_button['url']) ? trim((string) $acf_button['url']) : '',
            'title' => isset($acf_button['title']) ? trim((string) $acf_button['title']) : '',
            'target' => isset($acf_button['target']) ? trim((string) $acf_button['target']) : '',
        );
    }

    $facebook_url = get_field('contact_facebook_url', $page_id);
    $twitter_url = get_field('contact_twitter_url', $page_id);
    $form_title = get_field('contact_form_title', $page_id);
    $form_intro = get_field('contact_form_intro', $page_id);
}

$label = trim((string) $label);
$title = trim((string) $title);
$subtitle = trim((string) $subtitle);
$lead = trim((string) $lead);
$phone = trim((string) $phone);
$email = trim((string) $email);
$address = trim((string) $address);
$facebook_url = trim((string) $facebook_url);
$twitter_url = trim((string) $twitter_url);
$form_title = trim((string) $form_title);
$form_intro = trim((string) $form_intro);

$site_phone = psm_get_site_phone();
if ('' !== $site_phone['display']) {
    $phone = $site_phone['display'];
}

$phone_href = psm_phone_href_from_display($phone);
$email_href = '' !== $email ? 'mailto:' . $email : '';

$has_label = '' !== $label;
$has_title = '' !== $title;
$has_subtitle = '' !== $subtitle;
$has_lead = '' !== $lead;
$has_phone = '' !== $phone;
$has_email = '' !== $email;
$has_address = '' !== $address;
$has_button = '' !== $button['url'];
$has_facebook = '' !== $facebook_url;
$has_twitter = '' !== $twitter_url;
$has_social = $has_facebook || $has_twitter;
$has_form_title = '' !== $form_title;
$has_form_intro = '' !== $form_intro;

$has_info_header = $has_label || $has_title || $has_subtitle || $has_lead;
$has_info_list = $has_phone || $has_email || $has_address;
$has_info_column = $has_info_header || $has_info_list || $has_button || $has_social;
$has_form_header = $has_form_title || $has_form_intro;

$form_shortcode = function_exists('psm_get_contact_form_shortcode') ? trim((string) psm_get_contact_form_shortcode()) : '';
$has_form = '' !== $form_shortcode;

if (!$has_info_column && !$has_form_header && !$has_form) {
    return;
}

$logo_mark = psm_theme_image('header-logo.webp') ?: psm_theme_image('logo-placeholder.svg');

$form_heading_id = $has_form_title ? 'psm-contact-form-heading' : '';
$section_labelledby = $form_heading_id ?: ($has_title ? 'psm-contact-info-title' : '');
?>
<style>
    .psm-contact-form .psm-cf7-input--user,
    .psm-contact-form input.psm-cf7-input--user {
        background-image: url('<?php echo get_template_directory_uri() . '/assets/images/f1.webp'; ?>');
    }

    .psm-contact-form .psm-cf7-input--email,
    .psm-contact-form input.psm-cf7-input--email {
        background-image: url('<?php echo get_template_directory_uri() . '/assets/images/f2.webp'; ?>');
    }

    .psm-contact-form .psm-cf7-input--phone,
    .psm-contact-form input.psm-cf7-input--phone {
        background-image: url('<?php echo get_template_directory_uri() . '/assets/images/f3.webp'; ?>');
    }



    .psm-contact-form .psm-cf7-input--work,
    .psm-contact-form select.psm-cf7-input--work {
        background-image:
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23111' d='M1 1l5 5 5-5'/%3E%3C/svg%3E"), 
            url('<?php echo get_template_directory_uri() . '/assets/images/f4.webp'; ?>');
            /* url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M4 20V8l8-4 8 4v12' stroke='%23111' stroke-width='2'/%3E%3Cpath d='M9 20v-6h6v6' stroke='%23e31e24' stroke-width='2'/%3E%3C/svg%3E"),  */
    }

    .psm-contact-form .psm-cf7-input--location,
    .psm-contact-form input.psm-cf7-input--psm-cf7-input--location {
        background-image: url('<?php echo get_template_directory_uri() . '/assets/images/f5.webp'; ?>');
    }

    .psm-contact-form .psm-cf7-input--message,
    .psm-contact-form textarea.psm-cf7-input--message {
        background-image: url('<?php echo get_template_directory_uri() . '/assets/images/f6.webp'; ?>');
    }
</style>

<section class="psm-contact" id="contact-main" <?php echo $section_labelledby ? ' aria-labelledby="' . esc_attr($section_labelledby) . '"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-contact__grid">
            <?php if ($has_info_column): ?>
                <div class="psm-contact-info">
                    <?php if ($logo_mark): ?>
                        <img class="psm-contact-info__mark" src="<?php echo esc_url($logo_mark); ?>" alt="" width="56"
                            height="56" decoding="async">
                    <?php endif; ?>

                    <?php if ($has_label): ?>
                        <p class="psm-section-header__badge">
                            <span class="psm-section-header__badge-dot" aria-hidden="true"></span>
                            <?php echo esc_html($label); ?>
                        </p>

                    <?php endif; ?>

                    <?php if ($has_title): ?>
                        <h2 class="psm-contact-info__title" id="psm-contact-info-title">
                            <?php echo esc_html($title); ?><span class="psm-contact-info__title-dot" aria-hidden="true">.</span>
                        </h2>
                    <?php endif; ?>

                    <?php if ($has_subtitle): ?>
                        <p class="psm-contact-info__subtitle"><?php echo esc_html($subtitle); ?></p>
                    <?php endif; ?>

                    <?php if ($has_lead): ?>
                        <p class="psm-contact-info__lead"><?php echo esc_html($lead); ?></p>
                    <?php endif; ?>

                    <?php if ($has_info_list): ?>
                        <ul class="psm-contact-info__list">
                            <?php if ($has_phone): ?>
                                <li>
                                    <span class="psm-contact-info__list-icon" aria-hidden="true">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/c1.webp'; ?>" alt=""
                                            decoding="async">
                                    </span>
                                    <?php if ($phone_href): ?>
                                        <a href="<?php echo esc_url($phone_href); ?>"><?php echo esc_html($phone); ?></a>
                                    <?php else: ?>
                                        <span><?php echo esc_html($phone); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($has_email): ?>
                                <li>
                                    <span class="psm-contact-info__list-icon" aria-hidden="true">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/c2.webp'; ?>" alt=""
                                            decoding="async">
                                    </span>
                                    <?php if ($email_href): ?>
                                        <a
                                            href="<?php echo esc_url($email_href); ?>"><?php echo esc_html(sprintf(/* translators: %s: email */ __('Email: %s', 'cmd-theme'), $email)); ?></a>
                                    <?php else: ?>
                                        <span><?php echo esc_html(sprintf(/* translators: %s: email */ __('Email: %s', 'cmd-theme'), $email)); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                            <?php if ($has_address): ?>
                                <li>
                                    <span class="psm-contact-info__list-icon" aria-hidden="true">
                                        <img src="<?php echo get_template_directory_uri() . '/assets/images/c3.webp'; ?>" alt=""
                                            decoding="async">
                                    </span>
                                    <span><?php echo esc_html($address); ?></span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($has_button || $has_social): ?>
                        <div class="psm-contact-info__actions">
                            <?php if ($has_button): ?>
                                <?php
                                get_template_part(
                                    'template-parts/components/button-pill',
                                    null,
                                    array(
                                        'text' => $button['title'] ?: __('Request A Free Quote', 'cmd-theme'),
                                        'url' => $button['url'],
                                    )
                                );
                                ?>
                            <?php endif; ?>
                            <?php if ($has_social): ?>
                                <div class="psm-contact-info__social">
                                    <?php if ($has_facebook): ?>
                                        <a class="psm-contact-info__social-btn" href="<?php echo esc_url($facebook_url); ?>"
                                            aria-label="<?php esc_attr_e('Facebook', 'cmd-theme'); ?>">
                                            <span class="psm-contact-info__social-icon" aria-hidden="true">
                                                <img src="<?php echo get_template_directory_uri() . '/assets/images/contact-face.webp'; ?>"
                                                    alt="" decoding="async">
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($has_twitter): ?>
                                        <a class="psm-contact-info__social-btn" href="<?php echo esc_url($twitter_url); ?>"
                                            aria-label="<?php esc_attr_e('X (Twitter)', 'cmd-theme'); ?>">
                                            <span class="psm-contact-info__social-icon" aria-hidden="true">
                                                <img src="<?php echo get_template_directory_uri() . '/assets/images/contact-twit.webp'; ?>"
                                                    alt="" decoding="async">
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($has_form_header || $has_form): ?>
                <div class="psm-contact-form-card">
                    <?php if ($has_form_header): ?>
                        <header class="psm-contact-form-card__header">
                            <?php if ($logo_mark): ?>
                                <img class="psm-contact-form-card__mark" src="<?php echo esc_url($logo_mark); ?>" alt="" width="48"
                                    height="48" decoding="async">
                            <?php endif; ?>
                            <div class="psm-contact-form-card__head-copy">
                                <?php if ($has_form_title): ?>
                                    <h2 class="psm-contact-form-card__title" id="psm-contact-form-heading">
                                        <?php echo esc_html($form_title); ?><span class="psm-contact-form-card__title-dot"
                                            aria-hidden="true">.</span>
                                    </h2>
                                <?php endif; ?>
                                <?php if ($has_form_intro): ?>
                                    <p class="psm-contact-form-card__intro"><?php echo esc_html($form_intro); ?></p>
                                <?php endif; ?>
                            </div>
                        </header>
                    <?php endif; ?>

                    <?php if ($has_form): ?>
                        <div class="psm-contact-form">
                            <?php psm_render_contact_form(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>