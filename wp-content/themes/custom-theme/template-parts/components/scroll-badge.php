<?php
/**
 * Reusable scroll-down circular badge.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $href Anchor target.
 *     @type string $label Accessible label.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'href'  => '#quick-links',
        'label' => __('Scroll down', 'cmd-theme'),
    )
);

$circle_id = 'psm-scroll-circle-' . wp_unique_id();
?>
<a href="<?php echo esc_url($args['href']); ?>" class="psm-scroll-badge" aria-label="<?php echo esc_attr($args['label']); ?>">
    <span class="psm-scroll-badge__ring" aria-hidden="true">
        <svg class="psm-scroll-badge__svg" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <path id="<?php echo esc_attr($circle_id); ?>" d="M 60,60 m -44,0 a 44,44 0 1,1 88,0 a 44,44 0 1,1 -88,0"/>
            </defs>
            <circle cx="60" cy="60" r="54" fill="#ffffff" stroke="#d8d8d8" stroke-width="1"/>
            <text fill="#111111" font-family="Montserrat, sans-serif" font-size="9" font-weight="700" letter-spacing="2">
                <textPath href="#<?php echo esc_attr($circle_id); ?>" startOffset="6%">
                    <?php echo esc_html(strtoupper(__('Scroll down', 'cmd-theme'))); ?>
                    <tspan fill="#e31e24"> • </tspan>
                    <?php echo esc_html(strtoupper(__('Scroll down', 'cmd-theme'))); ?>
                    <tspan fill="#e31e24"> • </tspan>
                </textPath>
            </text>
            <g transform="translate(48, 46)">
                <rect x="4" y="0" width="16" height="26" rx="8" fill="#111111"/>
                <rect x="10.5" y="5" width="3" height="6" rx="1.5" fill="#e31e24"/>
            </g>
        </svg>
    </span>
    <span class="psm-scroll-badge__line" aria-hidden="true"></span>
</a>
