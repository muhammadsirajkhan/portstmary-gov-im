<?php
/**
 * Reusable section header: badge, title, intro.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string       $badge        Badge / kicker label (plain text).
 *     @type string       $badge_style  pill|dash|line|red — badge / kicker variants.
 *     @type string       $title        Heading without trailing period.
 *     @type string       $title_dot    period|square — title end marker.
 *     @type string       $heading_id   Optional id for h2 (a11y).
 *     @type string[]     $intro        Intro paragraph strings.
 *     @type string       $class        Optional extra header class.
 *     @type string       $align        center|left — text alignment.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'badge' => '',
        'badge_style' => 'pill',
        'title' => '',
        'title_dot' => 'period',
        'heading_id' => '',
        'intro' => array(),
        'class' => '',
        'align' => 'center',
    )
);

$header_class = 'psm-section-header';
if ('left' === $args['align']) {
    $header_class .= ' psm-section-header--left';
}
if ($args['class']) {
    $header_class .= ' ' . esc_attr($args['class']);
}

$heading_attrs = '';
if ($args['heading_id']) {
    $heading_attrs = ' id="' . esc_attr($args['heading_id']) . '"';
}
?>
<header class="<?php echo esc_attr($header_class); ?>">
    <?php if ($args['badge']): ?>
        <?php if ('dash' === $args['badge_style']): ?>
            <p class="psm-section-header__kicker">
                <span class="psm-section-header__kicker-dot" aria-hidden="true"></span>
                <span class="psm-section-header__kicker-dash" aria-hidden="true">&mdash;</span>
                <?php echo esc_html(strtoupper($args['badge'])); ?>
            </p>
        <?php elseif ('line' === $args['badge_style']): ?>
            <p class="psm-section-header__eyebrow">
                <span class="psm-section-header__eyebrow-line" aria-hidden="true"></span>
                <?php echo esc_html(strtoupper($args['badge'])); ?>
            </p>
        <?php elseif ('red' === $args['badge_style']): ?>
            <p class="psm-section-header__eyebrow-red">
                <?php echo esc_html(strtoupper($args['badge'])); ?>
            </p>
        <?php else: ?>
            <p class="psm-section-header__badge">
                <span class="psm-section-header__badge-dot" aria-hidden="true"></span>
                <?php echo esc_html(strtoupper($args['badge'])); ?>
            </p>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($args['title']): ?>
        <h2 class="psm-section-header__title" <?php echo $heading_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
            <?php echo esc_html($args['title']); ?><?php if ('square' === $args['title_dot']): ?><span
                    class="psm-section-header__title-square" aria-hidden="true"></span><?php else: ?><span
                    class="psm-section-header__title-dot" aria-hidden="true">.</span><?php endif; ?>
        </h2>
    <?php endif; ?>
    <?php if (!empty($args['intro'])): ?>
        <div class="psm-section-header__intro">
            <?php foreach ((array) $args['intro'] as $line): ?>
                <p><?php echo esc_html($line); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</header>