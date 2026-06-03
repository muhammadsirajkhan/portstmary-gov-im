<?php
/**
 * Latest News & Updates — Swiper carousel.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
if (!$page_id && is_front_page()) {
    $page_id = (int) get_option('page_on_front');
}

$template_args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'background'  => '',
        'badge'       => '',
        'badge_style' => '',
        'title'       => '',
        'title_dot'   => '',
    )
);

$is_home_news = psm_is_home_news_page($page_id);

// Static layout values (not editable in Home — News ACF).
$badge_style = 'pill';
$title_dot   = 'period';
$background  = 'grey';
$image_badge = __('Port St Mary', 'cmd-theme');

$badge      = '';
$title      = '';
$intro      = array();
$news_items = array();
$button     = psm_news_default_button();

if ($is_home_news && function_exists('get_field')) {
    $badge = get_field('news_badge', $page_id);
    $title = get_field('news_title', $page_id);

    $intro_raw = get_field('news_intro', $page_id);
    if (is_string($intro_raw) && '' !== trim($intro_raw)) {
        $intro = array_values(
            array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n\s*\r?\n/', $intro_raw))
            )
        );
    }

    $acf_button = get_field('news_button', $page_id);
    if (is_array($acf_button) && !empty($acf_button['url'])) {
        $button = array(
            'url'    => trim((string) $acf_button['url']),
            'title'  => isset($acf_button['title']) ? trim((string) $acf_button['title']) : '',
            'target' => isset($acf_button['target']) ? trim((string) $acf_button['target']) : '',
        );
    }

    $defaults = psm_home_news_section_defaults();

    if ('' === trim((string) $badge)) {
        $badge = $defaults['badge'];
    }
    if ('' === trim((string) $title)) {
        $title = $defaults['title'];
    }
    if (empty($intro)) {
        $intro = $defaults['intro'];
    }
    if ('' === $button['url']) {
        $button = $defaults['button'];
    }
} else {
    if ('' !== trim((string) $template_args['badge'])) {
        $badge = $template_args['badge'];
    }
    if ('' !== trim((string) $template_args['badge_style'])) {
        $badge_style = $template_args['badge_style'];
    }
    if ('' !== trim((string) $template_args['title'])) {
        $title = $template_args['title'];
    }
    if ('' !== trim((string) $template_args['title_dot'])) {
        $title_dot = $template_args['title_dot'];
    }
    if ('' !== trim((string) $template_args['background'])) {
        $background = $template_args['background'];
    }

    if ('' === trim((string) $badge)) {
        $badge = __('Community News', 'cmd-theme');
    }
    if ('' === trim((string) $title)) {
        $title = __('Latest News & Updates', 'cmd-theme');
    }
}

$badge = trim((string) $badge);
$title = trim((string) $title);

$news_ids = psm_get_home_news_post_ids($page_id);
foreach ($news_ids as $news_id) {
    $card = psm_get_news_card_args($news_id);
    if (psm_news_card_has_content($card)) {
        $news_items[] = $card;
    }
}

$has_header = '' !== $badge || '' !== $title || !empty($intro);
$has_news   = !empty($news_items);
$has_button = '' !== $button['url'];

$phone_display = '+ (01624) 832101';
$phone_href    = 'tel:+441624832101';

if (!$has_header && !$has_news && !$has_button) {
    return;
}

$section_class = 'psm-news';
if ('white' === $background) {
    $section_class .= ' psm-news--white';
}

$section_attrs = 'class="' . esc_attr($section_class) . '" id="news"';
if ($title) {
    $section_attrs .= ' aria-labelledby="psm-news-heading"';
}
?>
<section <?php echo $section_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'       => $badge,
                    'badge_style' => $badge_style,
                    'title'       => $title,
                    'title_dot'   => $title_dot,
                    'heading_id'  => $title ? 'psm-news-heading' : '',
                    'intro'       => $intro,
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_news) : ?>
            <div class="psm-news__carousel">
                <button type="button" class="psm-news-nav psm-news-nav--prev" aria-label="<?php esc_attr_e('Previous news', 'cmd-theme'); ?>"></button>

                <div class="swiper psm-news-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($news_items as $item) : ?>
                            <div class="swiper-slide">
                                <?php
                                get_template_part(
                                    'template-parts/components/news-card',
                                    null,
                                    array_merge(
                                        $item,
                                        array(
                                            'image_badge' => $image_badge,
                                        )
                                    )
                                );
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button type="button" class="psm-news-nav psm-news-nav--next" aria-label="<?php esc_attr_e('Next news', 'cmd-theme'); ?>"></button>
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
            )
        );
        ?>
    </div>
</section>
