<?php
/**
 * Three-image collage with centred crest badge (Refuse page).
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string[] $images      Three image URLs (top-left, top-right, bottom).
 *     @type string[] $image_seeds Placeholder seeds when URLs empty.
 *     @type string[] $alts        Alt text per image.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'images'      => array(),
        'image_seeds' => array(
            'psm-refuse-collage-1',
            'psm-refuse-collage-2',
            'psm-refuse-collage-3',
        ),
        'alts'        => array(),
    )
);

$seeds = array_values((array) $args['image_seeds']);
$urls  = array_values((array) $args['images']);
$alts  = array_values((array) $args['alts']);

$slots = array(
    array('pos' => 'tl', 'w' => 480, 'h' => 360),
    array('pos' => 'tr', 'w' => 480, 'h' => 360),
    array('pos' => 'bottom', 'w' => 980, 'h' => 420),
);
?>
<div class="psm-refuse-collage">
    <div class="psm-refuse-collage__grid">
        <?php foreach ($slots as $index => $slot) : ?>
            <?php
            $seed = isset($seeds[ $index ]) ? $seeds[ $index ] : 'psm-refuse-collage-' . ( $index + 1 );
            $url  = isset($urls[ $index ]) && $urls[ $index ] ? $urls[ $index ] : psm_placeholder_image($slot['w'], $slot['h'], $seed);
            $alt  = isset($alts[ $index ]) ? $alts[ $index ] : __('Port St Mary refuse and recycling', 'cmd-theme');
            ?>
            <img
                class="psm-refuse-collage__img psm-refuse-collage__img--<?php echo esc_attr($slot['pos']); ?>"
                src="<?php echo esc_url($url); ?>"
                alt="<?php echo esc_attr($alt); ?>"
                width="<?php echo (int) $slot['w']; ?>"
                height="<?php echo (int) $slot['h']; ?>"
                loading="lazy"
                decoding="async"
            >
        <?php endforeach; ?>
    </div>
    <div class="psm-refuse-collage__badge">
        <?php get_template_part('template-parts/components/welcome-badge'); ?>
    </div>
</div>
