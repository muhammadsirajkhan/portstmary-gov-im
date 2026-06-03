<?php
/**
 * Circular welcome badge with curved label and crest.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $label Curved ring text.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'label' => __('#Welcome to Port St Mary Commissioners', 'cmd-theme'),
    )
);

$crest     = psm_theme_image('header-logo.png') ?: psm_theme_image('logo-placeholder.svg');
$circle_id = 'psm-welcome-circle-' . wp_unique_id();
$label     = strtoupper($args['label']);
?>
<div class="psm-welcome-badge" aria-hidden="true">
    <svg class="psm-welcome-badge__svg" viewBox="0 0 140 140" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <path id="<?php echo esc_attr($circle_id); ?>" d="M 70,70 m -50,0 a 50,50 0 1,1 100,0 a 50,50 0 1,1 -100,0"/>
        </defs>
        <circle cx="70" cy="70" r="66" fill="#ffffff" stroke="#e31e24" stroke-width="3"/>
        <text fill="#111111" font-family="Montserrat, sans-serif" font-size="8.5" font-weight="700" letter-spacing="1.8">
            <textPath href="#<?php echo esc_attr($circle_id); ?>" startOffset="2%">
                <?php echo esc_html($label); ?>
            </textPath>
        </text>
        <?php if ($crest) : ?>
            <image href="<?php echo esc_url($crest); ?>" x="42" y="42" width="56" height="56" preserveAspectRatio="xMidYMid meet"/>
        <?php else : ?>
            <circle cx="70" cy="70" r="24" fill="#e31e24"/>
        <?php endif; ?>
    </svg>
</div>
