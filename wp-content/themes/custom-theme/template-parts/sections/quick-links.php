<?php
/**
 * Quick links — service cards below hero.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
if (!$page_id && is_front_page()) {
    $page_id = (int) get_option('page_on_front');
}

$boxes = array();
if ($page_id && function_exists('get_field')) {
    $acf_boxes = get_field('boxes', $page_id);
    if (is_array($acf_boxes)) {
        foreach ($acf_boxes as $box) {
            if (!is_array($box)) {
                continue;
            }

            $icon = isset($box['icon']) ? $box['icon'] : '';
            if (is_array($icon)) {
                $icon = isset($icon['url']) ? $icon['url'] : '';
            } elseif (is_numeric($icon)) {
                $icon = wp_get_attachment_image_url((int) $icon, 'full') ?: '';
            }

            $boxes[] = array(
                'icon' => trim((string) $icon),
                'title' => isset($box['title']) ? trim((string) $box['title']) : '',
                'text' => isset($box['text']) ? trim((string) $box['text']) : '',
                'url' => isset($box['url']) ? trim((string) $box['url']) : '',
            );
        }
    }
}

$boxes = array_values(
    array_filter(
        $boxes,
        static function ($box) {
            return '' !== $box['icon'] || '' !== $box['title'] || '' !== $box['text'] || '' !== $box['url'];
        }
    )
);

if (empty($boxes)) {
    return;
}
?>
<section class="psm-quick-links" id="quick-links" aria-label="<?php esc_attr_e('Quick links', 'cmd-theme'); ?>">

    <div class="hero-scroll-badge">
        <a href="#quick-links" class="hero-scroll-badge__link"
            aria-label="<?php esc_attr_e('Scroll down', 'cmd-theme'); ?>">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-down.webp'); ?>"
                alt="<?php esc_attr_e('Scroll down', 'cmd-theme'); ?>" width="180" height="180">
        </a>
    </div>
    <div class="container psm-container">
        <div class="psm-quick-links__grid">
            <?php foreach ($boxes as $box): ?>
                <?php
                get_template_part(
                    'template-parts/components/quick-link-card',
                    null,
                    $box
                );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>