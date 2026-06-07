<?php
/**
 * Quick link card — icon, title, description, learn more.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $icon  Icon image URL.
 *     @type string $title Card title.
 *     @type string $text  Description.
 *     @type string $url   Link URL.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'icon'  => '',
        'title' => '',
        'text'  => '',
        'url'   => '',
    )
);

$icon  = trim((string) $args['icon']);
$title = trim((string) $args['title']);
$text  = trim((string) $args['text']);
$url   = trim((string) $args['url']);

if ('' === $icon && '' === $title && '' === $text && '' === $url) {
    return;
}

$has_url   = '' !== $url;
$tag       = $has_url ? 'a' : 'div';
$card_attr = $has_url ? ' href="' . esc_url($url) . '"' : '';
?>
<<?php echo $tag; ?> class="psm-quick-card"<?php echo $card_attr; ?>>
    <?php if ('' !== $icon || '' !== $title) : ?>
        <div class="psm-quick-card__head">
            <?php if ('' !== $icon) : ?>
                <img
                    class="psm-quick-card__icon"
                    src="<?php echo esc_url($icon); ?>"
                    alt="<?php echo '' !== $title ? esc_attr($title) : ''; ?>"
                  
                    decoding="async"
                >
            <?php endif; ?>
            <?php if ('' !== $title) : ?>
                <h3 class="psm-quick-card__title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ('' !== $text) : ?>
        <p class="psm-quick-card__text"><?php echo esc_html($text); ?></p>
    <?php endif; ?>

    <?php if ($has_url) : ?>
        <span class="psm-quick-card__link">
            <span class="psm-quick-card__link-text"><?php esc_html_e('Learn More', 'cmd-theme'); ?></span>
            <span class="psm-quick-card__link-icon" aria-hidden="true">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/arrow-right.webp'); ?>" alt="<?php esc_attr_e('Arrow', 'cmd-theme'); ?>">
            </span>
        </span>
    <?php endif; ?>
</<?php echo $tag; ?>>
