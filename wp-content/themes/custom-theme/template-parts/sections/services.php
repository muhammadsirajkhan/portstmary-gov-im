<?php
/**
 * Services for Residents — image card grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
if (!$page_id && is_front_page()) {
    $page_id = (int) get_option('page_on_front');
}

$badge   = '';
$title   = '';
$intro   = array();
$cards   = array();
$button  = array(
    'url'    => '',
    'title'  => '',
    'target' => '',
);

if ($page_id && function_exists('get_field')) {
    $badge = get_field('services_badge', $page_id);
    $title = get_field('services_title', $page_id);

    $intro_raw = get_field('services_intro', $page_id);
    if (is_string($intro_raw) && '' !== trim($intro_raw)) {
        $intro = array_values(
            array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n\s*\r?\n/', $intro_raw))
            )
        );
    }

    $acf_cards = get_field('services_cards', $page_id);
    if (is_array($acf_cards)) {
        foreach ($acf_cards as $card) {
            if (!is_array($card)) {
                continue;
            }

            $image = isset($card['image']) ? $card['image'] : '';
            if (is_array($image)) {
                $image = isset($image['url']) ? $image['url'] : '';
            } elseif (is_numeric($image)) {
                $image = wp_get_attachment_image_url((int) $image, 'full') ?: '';
            }

            $link_url = '';
            $acf_link = isset($card['link']) ? $card['link'] : '';
            if (is_array($acf_link) && !empty($acf_link['url'])) {
                $link_url = trim((string) $acf_link['url']);
            }

            $cards[] = array(
                'image'   => trim((string) $image),
                'title'   => isset($card['title']) ? trim((string) $card['title']) : '',
                'excerpt' => isset($card['excerpt']) ? trim((string) $card['excerpt']) : '',
                'url'     => $link_url,
            );
        }
    }

    $acf_button = get_field('services_button', $page_id);
    if (is_array($acf_button)) {
        $button = array(
            'url'    => isset($acf_button['url']) ? trim((string) $acf_button['url']) : '',
            'title'  => isset($acf_button['title']) ? trim((string) $acf_button['title']) : '',
            'target' => isset($acf_button['target']) ? trim((string) $acf_button['target']) : '',
        );
    }
}

$badge = trim((string) $badge);
$title = trim((string) $title);

$cards = array_values(
    array_filter(
        $cards,
        static function ($card) {
            return '' !== $card['image'] || '' !== $card['title'] || '' !== $card['excerpt'] || '' !== $card['url'];
        }
    )
);

$has_header = '' !== $badge || '' !== $title || !empty($intro);
$has_cards  = !empty($cards);
$has_button = '' !== $button['url'];

$site_phone    = psm_get_site_phone();
$phone_display = $site_phone['display'];
$phone_href    = $site_phone['href'];

if (!$has_header && !$has_cards && !$has_button) {
    return;
}

$section_attrs = 'class="psm-services" id="services"';
if ($title) {
    $section_attrs .= ' aria-labelledby="psm-services-heading"';
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
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $title ? 'psm-services-heading' : '',
                    'intro'      => $intro,
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_cards) : ?>
            <div class="psm-services__grid">
                <?php foreach ($cards as $card) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/service-card',
                        null,
                        $card
                    );
                    ?>
                <?php endforeach; ?>
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
