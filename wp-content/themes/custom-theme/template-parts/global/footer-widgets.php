<?php
/**
 * Site footer — ACF Footer Settings.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) && is_array($args) ? $args : array(),
    array(
        'variant' => 'default',
    )
);

$variant      = 'white' === $args['variant'] ? 'white' : 'default';
$footer_class = 'psm-footer' . ('white' === $variant ? ' psm-footer--white' : '');
$footer       = function_exists('psm_get_footer_settings') ? psm_get_footer_settings() : array();

$logo_url           = trim((string) ($footer['logo_url'] ?? ''));
$social_links       = isset($footer['social_links']) && is_array($footer['social_links']) ? $footer['social_links'] : array();
$show_about         = !empty($footer['show_about']);
$about_heading      = trim((string) ($footer['about_heading'] ?? ''));
$about_paragraphs   = isset($footer['about_paragraphs']) && is_array($footer['about_paragraphs']) ? $footer['about_paragraphs'] : array();
$link_columns       = !empty($footer['show_links']) && !empty($footer['link_columns']) ? $footer['link_columns'] : array();
$show_phone         = !empty($footer['show_phone']) && '' !== ($footer['phone_display'] ?? '');
$show_email         = !empty($footer['show_email']) && '' !== ($footer['email_display'] ?? '');
$show_subscribe      = !empty($footer['show_subscribe']);
$subscribe_label     = trim((string) ($footer['subscribe_label'] ?? ''));
$subscribe_shortcode = trim((string) ($footer['subscribe_shortcode'] ?? ''));
$has_subscribe       = $show_subscribe && ('' !== $subscribe_label || '' !== $subscribe_shortcode);
$copyright          = trim((string) ($footer['copyright'] ?? ''));
$legal_links        = !empty($footer['show_legal']) && !empty($footer['legal_links']) ? $footer['legal_links'] : array();

$has_brand_row  = ('' !== $logo_url || !empty($social_links));
$has_about      = $show_about && ('' !== $about_heading || !empty($about_paragraphs));
$has_main       = $has_about || !empty($link_columns);
$has_contact    = $show_phone || $show_email;
$has_utility    = $has_contact || $has_subscribe;
$has_legal      = '' !== $copyright || !empty($legal_links);
$theme_uri      = get_template_directory_uri();
?>
<footer class="<?php echo esc_attr($footer_class); ?>" id="contact" style="background-image: url(<?php echo esc_url($theme_uri . '/assets/images/footer-bg.webp'); ?>);">
    <div class="psm-footer__transition">
        <div class="footer-scroll">
            <a href="#footer-main">
                <img src="<?php echo esc_url($theme_uri . '/assets/images/footer-scroll.webp'); ?>" alt="" decoding="async">
            </a>
        </div>
    </div>

    <div class="psm-footer__body" id="footer-main">
        <div class="container psm-container">
            <?php if ($has_brand_row) : ?>
                <div class="psm-footer__brand-row">
                    <?php if ('' !== $logo_url) : ?>
                        <div class="psm-footer__logo">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" width="108" height="108" loading="lazy">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($social_links)) : ?>
                        <div class="psm-footer__social" role="navigation" aria-label="<?php esc_attr_e('Social media', 'cmd-theme'); ?>">
                            <?php foreach ($social_links as $network) : ?>
                                <a
                                    href="<?php echo esc_url($network['url']); ?>"
                                    class="psm-footer-social <?php echo esc_attr($network['modifier']); ?>"
                                    data-network="<?php echo esc_attr($network['id']); ?>"
                                    aria-label="<?php echo esc_attr($network['label']); ?>"
                                    <?php echo 0 === strpos($network['url'], 'http') ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>
                                >
                                    <span class="psm-footer-social__icon" aria-hidden="true"></span>
                                    <span class="psm-footer-social__label"><?php echo esc_html($network['label']); ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($has_main) : ?>
                <div class="psm-footer__main">
                    <?php if ($has_about) : ?>
                        <div class="psm-footer__about">
                            <?php if ('' !== $about_heading) : ?>
                                <h2 class="psm-footer__about-title"><?php echo esc_html($about_heading); ?></h2>
                            <?php endif; ?>
                            <?php foreach ($about_paragraphs as $paragraph) : ?>
                                <p><?php echo esc_html($paragraph); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($link_columns)) : ?>
                        <div class="psm-footer__links-area">
                            <div class="psm-footer__links-grid">
                                <?php foreach ($link_columns as $column) : ?>
                                    <?php
                                    $column_heading = trim((string) ($column['heading'] ?? ''));
                                    $column_links   = isset($column['links']) && is_array($column['links']) ? $column['links'] : array();
                                    if ('' === $column_heading && empty($column_links)) {
                                        continue;
                                    }
                                    ?>
                                    <div class="psm-footer__links-col">
                                        <?php if ('' !== $column_heading) : ?>
                                            <h3 class="psm-footer__links-heading"><?php echo esc_html($column_heading); ?></h3>
                                        <?php endif; ?>
                                        <?php if (!empty($column_links)) : ?>
                                            <ul class="psm-footer__links list-unstyled">
                                                <?php foreach ($column_links as $link) : ?>
                                                    <li>
                                                        <a
                                                            href="<?php echo esc_url($link['url']); ?>"
                                                            <?php echo '_blank' === ($link['target'] ?? '') ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>
                                                        >
                                                            <span class="psm-footer__links-chevron" aria-hidden="true">»</span>
                                                            <?php echo esc_html($link['label']); ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($has_utility) : ?>
                <div class="psm-footer__utility">
                    <?php if ($has_contact) : ?>
                        <div class="psm-footer__contact-group">
                            <?php if ($show_phone) : ?>
                                <a class="psm-footer-contact" href="<?php echo esc_url($footer['phone_href']); ?>">
                                    <span class="psm-footer-contact__icon psm-footer-contact__icon-phone" aria-hidden="true">
                                        <img src="<?php echo esc_url($theme_uri . '/assets/images/footer-phone.webp'); ?>" alt="" decoding="async">
                                    </span>
                                    <span class="psm-footer-contact__text">
                                        <?php if ('' !== ($footer['phone_label'] ?? '')) : ?>
                                            <span class="psm-footer-contact__label"><?php echo esc_html($footer['phone_label']); ?></span>
                                        <?php endif; ?>
                                        <span class="psm-footer-contact__value"><?php echo esc_html($footer['phone_display']); ?></span>
                                    </span>
                                    <span class="psm-footer-contact__arrow-icon" aria-hidden="true">
                                        <img src="<?php echo esc_url($theme_uri . '/assets/images/footer-arrow.webp'); ?>" alt="" decoding="async">
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if ($show_email) : ?>
                                <a class="psm-footer-contact" href="<?php echo esc_url($footer['email_href']); ?>">
                                    <span class="psm-footer-contact__icon psm-footer-contact__icon-email" aria-hidden="true">
                                        <img src="<?php echo esc_url($theme_uri . '/assets/images/footer-email.webp'); ?>" alt="" decoding="async">
                                    </span>
                                    <span class="psm-footer-contact__text">
                                        <?php if ('' !== ($footer['email_label'] ?? '')) : ?>
                                            <span class="psm-footer-contact__label"><?php echo esc_html($footer['email_label']); ?></span>
                                        <?php endif; ?>
                                        <span class="psm-footer-contact__value"><?php echo esc_html($footer['email_display']); ?></span>
                                    </span>
                                    <span class="psm-footer-contact__arrow-icon" aria-hidden="true">
                                        <img src="<?php echo esc_url($theme_uri . '/assets/images/footer-arrow.webp'); ?>" alt="" decoding="async">
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($has_subscribe) : ?>
                        <div class="psm-footer__subscribe">
                            <?php if ('' !== $subscribe_label) : ?>
                                <p class="psm-footer__subscribe-label"><?php echo esc_html($subscribe_label); ?></p>
                            <?php endif; ?>
                            <div class="psm-footer-subscribe">
                                <?php
                                if (function_exists('psm_render_footer_subscribe_form')) {
                                    psm_render_footer_subscribe_form();
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ($has_legal) : ?>
        <div class="psm-footer__legal">
            <div class="container psm-container">
                <div class="psm-footer__legal-inner">
                    <?php if ('' !== $copyright) : ?>
                        <p class="psm-footer__legal-copy mb-0">
                            &copy; <?php echo esc_html(gmdate('Y')); ?> <?php echo esc_html($copyright); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($legal_links)) : ?>
                        <nav class="psm-footer__legal-nav" aria-label="<?php esc_attr_e('Legal links', 'cmd-theme'); ?>">
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($legal_links as $legal) : ?>
                                    <li>
                                        <a
                                            href="<?php echo esc_url($legal['url']); ?>"
                                            <?php echo '_blank' === ($legal['target'] ?? '') ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>
                                        ><?php echo esc_html($legal['label']); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</footer>
