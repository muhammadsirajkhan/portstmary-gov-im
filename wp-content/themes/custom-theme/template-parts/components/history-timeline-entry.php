<?php
/**
 * History timeline row — alternating content and icon sides.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $layout     left|right.
 *     @type string $period     Date period label.
 *     @type string $icon       crane|ship|anchor|harbor — CSS fallback icon.
 *     @type string $icon_image Optional icon image URL.
 *     @type string $title      Entry title.
 *     @type string $text       Card description.
 *     @type array  $read_more  { label, url }.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'layout'     => 'left',
        'period'     => '',
        'icon'       => 'anchor',
        'icon_image' => '',
        'title'      => '',
        'text'       => '',
        'read_more'  => array(),
    )
);

if (!$args['title']) {
    return;
}

$layout     = 'right' === $args['layout'] ? 'right' : 'left';
$icons      = array('crane', 'ship', 'anchor', 'harbor');
$icon       = in_array($args['icon'], $icons, true) ? $args['icon'] : 'anchor';
$icon_image = trim((string) $args['icon_image']);

$render_meta = static function () use ($args, $icon, $icon_image) {
    ?>
    <div class="psm-history-timeline__side psm-history-timeline__side--meta">
        <div class="psm-history-timeline__visual">
            <?php if ($args['period']) : ?>
                <span class="psm-history-timeline__period"><?php echo esc_html($args['period']); ?></span>
            <?php endif; ?>
            <?php if ('' !== $icon_image) : ?>
                <img
                    class="psm-history-timeline__icon-img"
                    src="<?php echo esc_url($icon_image); ?>"
                    alt=""
                   
                    loading="lazy"
                    decoding="async"
                >
            <?php else : ?>
                <span class="psm-history-timeline__icon psm-history-timeline__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
            <?php endif; ?>
        </div>
    </div>
    <?php
};

$render_content = static function () use ($args) {
    ?>
    <div class="psm-history-timeline__side psm-history-timeline__side--content">
        <h3 class="psm-history-timeline__entry-title"><?php echo esc_html($args['title']); ?></h3>
        <div class="psm-history-timeline__card">
            <?php if ($args['text']) : ?>
                <p class="psm-history-timeline__card-text"><?php echo esc_html($args['text']); ?></p>
            <?php endif; ?>
            <?php if (!empty($args['read_more']['url'])) : ?>
                <a class="psm-history-timeline__link" href="<?php echo esc_url($args['read_more']['url']); ?>">
                    <?php echo esc_html($args['read_more']['label'] ?: __('Learn More', 'cmd-theme')); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php
};
?>
<article class="psm-history-timeline__entry psm-history-timeline__entry--<?php echo esc_attr($layout); ?>">
    <?php if ('right' === $layout) : ?>
        <?php $render_meta(); ?>
        <div class="psm-history-timeline__axis" aria-hidden="true">
            <span class="psm-history-timeline__dot"></span>
        </div>
        <?php $render_content(); ?>
    <?php else : ?>
        <?php $render_content(); ?>
        <div class="psm-history-timeline__axis" aria-hidden="true">
            <span class="psm-history-timeline__dot"></span>
        </div>
        <?php $render_meta(); ?>
    <?php endif; ?>
</article>
