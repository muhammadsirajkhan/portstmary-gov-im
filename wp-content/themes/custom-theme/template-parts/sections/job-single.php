<?php
/**
 * Single job layout — content column + application form.
 *
 * CF7 field classes (match contact form):
 * your-name  → psm-cf7-input psm-cf7-input--user
 * your-email → psm-cf7-input psm-cf7-input--email
 * your-phone → psm-cf7-input psm-cf7-input--phone
 * your-message → psm-cf7-input psm-cf7-input--message
 * your-cv → psm-cf7-input psm-cf7-input--file
 * Submit → psm-cf7-submit
 *
 * Hidden fields job-title and job-id are injected automatically on this template.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$post_id = (int) get_the_ID();
if ($post_id <= 0) {
    return;
}

$data = psm_get_job_single_data($post_id);
$form = psm_get_job_application_form_settings();
$form_title = trim((string) ($form['title'] ?? ''));
$form_intro = trim((string) ($form['intro'] ?? ''));
$shortcode = function_exists('psm_get_job_application_form_shortcode')
    ? trim((string) psm_get_job_application_form_shortcode())
    : '';

if ('' === ($data['title'] ?? '')) {
    return;
}

$has_meta = '' !== ($data['location'] ?? '') || '' !== ($data['category'] ?? '');
$has_content = get_the_content();
$has_form = '' !== $shortcode;
$has_form_header = '' !== $form_title || '' !== $form_intro;
$logo_mark = psm_theme_image('header-logo.webp') ?: psm_theme_image('logo-placeholder.svg');
$form_heading_id = '' !== $form_title ? 'psm-job-application-form-heading' : '';
$aside_attrs = '' !== $form_heading_id
    ? ' aria-labelledby="' . esc_attr($form_heading_id) . '"'
    : ' aria-label="' . esc_attr__('Job application form', 'cmd-theme') . '"';
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
<article <?php post_class('psm-job-single'); ?> id="post-<?php echo esc_attr((string) $post_id); ?>">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/breadcrumbs',
            null,
            array('items' => $data['breadcrumb'])
        );
        ?>

        <div class="psm-job-single__grid">
            <div class="psm-job-single__content-col">
                <header class="psm-job-single__header">
                    <?php if ($has_meta): ?>
                        <div class="psm-news-card__meta psm-job-single__meta">
                            <?php if ('' !== ($data['category'] ?? '')): ?>
                                <span class="psm-news-card__cat"><?php echo esc_html(strtoupper($data['category'])); ?></span>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>

                    <h1 class="psm-job-single__title"><?php echo esc_html($data['title']); ?></h1>
                    <?php if ('' !== ($data['location'] ?? '')): ?>
                        <span class="psm-news-card__time">
                            <!-- <span class="psm-news-card__clock" aria-hidden="true"></span> -->
                            <?php echo esc_html(strtoupper($data['location'])); ?>
                        </span>
                    <?php endif; ?>
                </header>

                <?php if ($has_content): ?>
                    <div class="psm-news-single__content psm-job-single__content entry-content">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($has_form_header || $has_form): ?>
                <aside class="psm-job-single__form-col" <?php echo $aside_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
                    <div class="psm-contact-form-card psm-job-single__form-card">
                        <?php if ($has_form_header): ?>
                            <header class="psm-contact-form-card__header">
                                <?php if ($logo_mark): ?>
                                    <img class="psm-contact-form-card__mark" src="<?php echo esc_url($logo_mark); ?>" alt=""
                                        width="48" height="48" decoding="async">
                                <?php endif; ?>
                                <div class="psm-contact-form-card__head-copy">
                                    <?php if ('' !== $form_title): ?>
                                        <h2 class="psm-contact-form-card__title" id="psm-job-application-form-heading">
                                            <?php echo esc_html($form_title); ?><span class="psm-contact-form-card__title-dot"
                                                aria-hidden="true">.</span>
                                        </h2>
                                    <?php endif; ?>
                                    <?php if ('' !== $form_intro): ?>
                                        <p class="psm-contact-form-card__intro"><?php echo esc_html($form_intro); ?></p>
                                    <?php endif; ?>
                                </div>
                            </header>
                        <?php endif; ?>

                        <?php if ($has_form): ?>
                            <div class="psm-contact-form psm-job-single__form" id="psm-job-application-form">
                                <?php
                                if (function_exists('psm_render_job_application_form')) {
                                    psm_render_job_application_form();
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</article>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('.psm-cf7-input--file');

        if (input) {
            input.style.display = 'none';

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.classList.add('psm-cf7-input--file-btn');
            btn.classList.add('psm-cf7-input--file-btn-text');
            btn.classList.add('psm-cf7-input--file-btn-text-no-file');
            btn.textContent = 'Choose CV';

            const fileName = document.createElement('span');
            fileName.textContent = ' No file chosen';

            input.parentNode.insertBefore(btn, input);
            input.parentNode.insertBefore(fileName, input.nextSibling);

            btn.addEventListener('click', () => input.click());

            input.addEventListener('change', function () {
                fileName.textContent = this.files.length
                    ? ' ' + this.files[0].name
                    : ' No file chosen';
            });
        }
    });
</script>