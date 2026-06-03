<?php
/**
 * History timeline row — alternating card and icon.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $layout    left|right.
 *     @type string $period    Date period label.
 *     @type string $icon      crane|ship|anchor|harbor.
 *     @type string $title     Card title.
 *     @type string $text      Card description.
 *     @type array  $read_more { label, url }.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'layout'    => 'left',
        'period'    => '',
        'icon'      => 'anchor',
        'title'     => '',
        'text'      => '',
        'read_more' => array(),
    )
);

if (!$args['title']) {
    return;
}

$layout = 'right' === $args['layout'] ? 'right' : 'left';
$icons  = array('crane', 'ship', 'anchor', 'harbor');
$icon   = in_array($args['icon'], $icons, true) ? $args['icon'] : 'anchor';
?>
<article class="psm-history-timeline__entry psm-history-timeline__entry--<?php echo esc_attr($layout); ?>">
    <div class="psm-history-timeline__side psm-history-timeline__side--card">
        <div class="psm-history-timeline__card">
            <h3 class="psm-history-timeline__card-title"><?php echo esc_html($args['title']); ?></h3>
            <?php if ($args['text']) : ?>
                <p class="psm-history-timeline__card-text"><?php echo esc_html($args['text']); ?></p>
            <?php endif; ?>
            <?php if (!empty($args['read_more']['url'])) : ?>
                <a class="psm-housing-zigzag__readmore" href="<?php echo esc_url($args['read_more']['url']); ?>">
                    <span><?php echo esc_html($args['read_more']['label'] ?: __('Read More', 'cmd-theme')); ?></span>
                    <span class="psm-housing-zigzag__readmore-arrow" aria-hidden="true"></span>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="psm-history-timeline__axis" aria-hidden="true">
        <span class="psm-history-timeline__dot"></span>
        <?php if ($args['period']) : ?>
            <span class="psm-history-timeline__period"><?php echo esc_html($args['period']); ?></span>
        <?php endif; ?>
    </div>

    <div class="psm-history-timeline__side psm-history-timeline__side--icon">
        <span class="psm-history-timeline__icon psm-history-timeline__icon--<?php echo esc_attr($icon); ?>" aria-hidden="true"></span>
    </div>
</article>
