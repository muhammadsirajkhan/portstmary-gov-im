<?php
/**
 * Site footer — matches Figma footer section.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) && is_array($args) ? $args : array(),
    array(
        'variant' => 'default', // default|white
    )
);

$variant = 'white' === $args['variant'] ? 'white' : 'default';
$footer_class = 'psm-footer' . ( 'white' === $variant ? ' psm-footer--white' : '' );
$footer_style = 'white' === $variant
    ? ''
    : ' style="background-image: url(' . esc_url(get_template_directory_uri() . '/assets/images/footer-bg.png') . ');"';

$logo_url = psm_theme_image('logo.png');
$wave_url = psm_theme_image('footer-wave.svg');

$footer_about = array(
    'heading' => __('Want to know more?', 'cmd-theme'),
    'paragraphs' => array(
        __('Port St Mary Commissioners are dedicated to supporting residents, maintaining public spaces, and ensuring the village remains a welcoming and vibrant place to live and visit.

', 'cmd-theme'),
        __('From essential services like waste collection and housing to community events and local initiatives, our focus is on delivering practical support with a personal touch.', 'cmd-theme'),
    ),
);

$footer_link_columns = array(
    array(
        array(__('Home', 'cmd-theme'), home_url('/')),
        array(__('About', 'cmd-theme'), home_url('/#about')),
        array(__('Services', 'cmd-theme'), home_url('/#services')),
        array(__('Event', 'cmd-theme'), home_url('/#events')),
        array(__('Blog', 'cmd-theme'), '#'),
        array(__('Contact Us', 'cmd-theme'), psm_contact_page_url()),
    ),
    array(
        array(__('Where to Stay', 'cmd-theme'), home_url('/where-to-stay/')),
        array(__('Community', 'cmd-theme'), '#'),
        array(__('Council', 'cmd-theme'), '#'),
        array(__('Documents', 'cmd-theme'), '#'),
        array(__('Who We Are', 'cmd-theme'), home_url('/who-we-are/')),
        array(__('Where to Eat', 'cmd-theme'), home_url('/where-to-eat/')),
    ),
    array(
        array(__('Mission Statement', 'cmd-theme'), '#'),
        array(__('Byelaws', 'cmd-theme'), '#'),
        array(__('Climate Change', 'cmd-theme'), '#'),
        array(__('Complaints', 'cmd-theme'), '#'),
        array(__('Events', 'cmd-theme'), home_url('/#events')),
        array(__('FOI', 'cmd-theme'), '#'),
    ),
);

$social_networks = array(
    array('id' => 'facebook', 'label' => 'Facebook', 'url' => '#', 'modifier' => ''),
    array('id' => 'instagram', 'label' => 'Instagram', 'url' => '#', 'modifier' => 'is-instagram'),
    array('id' => 'twitter', 'label' => 'Twitter', 'url' => '#', 'modifier' => ''),
    array('id' => 'linkedin', 'label' => 'LinkedIn', 'url' => '#', 'modifier' => ''),
);

$phone_display = '(01624) 832101';
$phone_href = 'tel:+441624832101';
$email_display = 'commissioners@portstmary.gov.im';
$email_href = 'mailto:commissioners@portstmary.gov.im';

$legal_links = array(
    array(__('Privacy Policy', 'cmd-theme'), '#'),
    array(__('Terms', 'cmd-theme'), '#'),
    array(__('Accessibility', 'cmd-theme'), '#'),
);
?>
<footer class="<?php echo esc_attr($footer_class); ?>" id="contact"<?php echo $footer_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> style="background-image: url(<?php echo esc_url(get_template_directory_uri() . '/assets/images/footer-bg.png'); ?>);">
    <div class="psm-footer__transition">
        <?php if ($wave_url): ?>
            <!-- <div class="psm-footer__wave" aria-hidden="true">
                <img src="<?php echo esc_url($wave_url); ?>" alt="" width="1440" height="120" loading="lazy" decoding="async">
            </div> -->
        <?php endif; ?>

        <?php
        // get_template_part(
        //     'template-parts/components/scroll-badge',
        //     null,
        //     array(
        //         'href'  => '#footer-main',
        //         'label' => __('Scroll down to footer content', 'cmd-theme'),
        //     )
        // );
        ?>
        <div class="footer-scroll">
            <a href="#"><img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/footer-scroll.png'); ?>"
                    alt="" decoding="async"></a>
        </div>
    </div>

    <div class="psm-footer__body" id="footer-main">
        <div class="container psm-container">
            <div class="psm-footer__brand-row">
                <div class="psm-footer__logo">
                  
                        <img src="<?php echo get_template_directory_uri() . '/assets/images/header-logo.png'; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                            width="108" height="108" loading="lazy">
                  
                </div>
                <div class="psm-footer__social" role="navigation"
                    aria-label="<?php esc_attr_e('Social media', 'cmd-theme'); ?>">
                    <?php foreach ($social_networks as $network): ?>
                        <a href="<?php echo esc_url($network['url']); ?>"
                            class="psm-footer-social <?php echo esc_attr($network['modifier']); ?>"
                            data-network="<?php echo esc_attr($network['id']); ?>">
                            <span class="psm-footer-social__icon" aria-hidden="true"></span>
                            <span class="psm-footer-social__label"><?php echo esc_html($network['label']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="psm-footer__main">
                <div class="psm-footer__about">
                    <h2 class="psm-footer__about-title"><?php echo esc_html($footer_about['heading']); ?></h2>
                    <?php foreach ($footer_about['paragraphs'] as $paragraph): ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>

                <div class="psm-footer__links-area">
                    <div class="psm-footer__links-grid">
                        <?php foreach ($footer_link_columns as $column_index => $column_links): ?>
                            <?php
                            $sidebar_id = 'footer-col-' . ($column_index + 1);
                            if (is_active_sidebar($sidebar_id)):
                                ?>
                                <div class="psm-footer__links-col">
                                    <?php dynamic_sidebar($sidebar_id); ?>
                                </div>
                            <?php else: ?>
                                <div class="psm-footer__links-col">
                                    <h3 class="psm-footer__links-heading"><?php esc_html_e('Links', 'cmd-theme'); ?></h3>
                                    <ul class="psm-footer__links list-unstyled">
                                        <?php foreach ($column_links as $link): ?>
                                            <li>
                                                <a href="<?php echo esc_url($link[1]); ?>">
                                                    <span class="psm-footer__links-chevron" aria-hidden="true">»</span>
                                                    <?php echo esc_html($link[0]); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="psm-footer__utility">
                <div class="psm-footer__contact-group">
                    <a class="psm-footer-contact" href="<?php echo esc_url($phone_href); ?>">
                        <span class="psm-footer-contact__icon psm-footer-contact__icon-phone"
                            aria-hidden="true">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/footer-phone.png'; ?>" alt="" decoding="async">
                        </span>
                        <span class="psm-footer-contact__text">
                            <span
                                class="psm-footer-contact__label"><?php esc_html_e('Call Us Now', 'cmd-theme'); ?></span>
                            <span class="psm-footer-contact__value"><?php echo esc_html($phone_display); ?></span>
                        </span>
                        <span class="psm-footer-contact__arrow-icon" aria-hidden="true">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/footer-arrow.png'; ?>" alt="" decoding="async">
                        </span>
                    </a>
                    <a class="psm-footer-contact" href="<?php echo esc_url($email_href); ?>">
                        <span class="psm-footer-contact__icon psm-footer-contact__icon-email"
                            aria-hidden="true">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/footer-email.png'; ?>" alt="" decoding="async">
                        </span>
                        <span class="psm-footer-contact__text">
                            <span
                                class="psm-footer-contact__label"><?php esc_html_e('Chat With Us', 'cmd-theme'); ?></span>
                            <span class="psm-footer-contact__value"><?php echo esc_html($email_display); ?></span>
                        </span>
                        <span class="psm-footer-contact__arrow-icon" aria-hidden="true">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/footer-arrow.png'; ?>" alt="" decoding="async">
                        </span>
                    </a>
                </div>

                <div class="psm-footer__subscribe">
                    <p class="psm-footer__subscribe-label"><?php esc_html_e('Stay in Touch', 'cmd-theme'); ?></p>
                    <form class="psm-footer-subscribe" action="#" method="post">
                        <label class="screen-reader-text"
                            for="psm-footer-email"><?php esc_html_e('Email address', 'cmd-theme'); ?></label>
                        <input type="email" id="psm-footer-email" name="email" class="psm-footer-subscribe__input"
                            placeholder="<?php esc_attr_e('Email Address', 'cmd-theme'); ?>" required>
                        <button type="submit"
                            class="psm-footer-subscribe__btn"><?php esc_html_e('Subscribe', 'cmd-theme'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="psm-footer__legal">
        <div class="container psm-container">
            <div class="psm-footer__legal-inner">
                <p class="psm-footer__legal-copy mb-0">
                    &copy; <?php echo esc_html(gmdate('Y')); ?>
                    <?php // echo esc_html(get_bloginfo('name')); ?>.
                    <?php esc_html_e('Port St Mary Commissioners. All Rights Reserved', 'cmd-theme'); ?>
                    <!-- <span class="psm-footer__legal-sep" aria-hidden="true">|</span>
                    <a href="#"><?php esc_html_e('Sitemap', 'cmd-theme'); ?></a> -->
                </p>
                <nav class="psm-footer__legal-nav" aria-label="<?php esc_attr_e('Legal links', 'cmd-theme'); ?>">
                    <ul class="list-unstyled mb-0">
                        <?php foreach ($legal_links as $legal): ?>
                            <li><a href="<?php echo esc_url($legal[1]); ?>"><?php echo esc_html($legal[0]); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</footer>