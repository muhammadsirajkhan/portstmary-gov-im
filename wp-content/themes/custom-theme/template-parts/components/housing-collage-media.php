<?php
/**
 * Four-image collage with centred crest badge (General Public).
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string[] $images      Four image URLs (top-left, top-right, bottom-left, bottom-right).
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
            'psm-gp-collage-1',
            'psm-gp-collage-2',
            'psm-gp-collage-3',
            'psm-gp-collage-4',
        ),
        'alts'        => array(),
    )
);

$seeds = array_values((array) $args['image_seeds']);
$urls  = array_values((array) $args['images']);
$alts  = array_values((array) $args['alts']);

$positions = array('tl', 'tr', 'bl', 'br');
?>
<div class="psm-housing-collage">
    <div class="psm-housing-collage__grid">
        <?php foreach ($positions as $index => $pos) : ?>
            <?php
            $seed = isset($seeds[ $index ]) ? $seeds[ $index ] : 'psm-gp-collage-' . ( $index + 1 );
            $url  = isset($urls[ $index ]) && $urls[ $index ] ? $urls[ $index ] : psm_placeholder_image(480, 480, $seed);
            $alt  = isset($alts[ $index ]) ? $alts[ $index ] : __('Port St Mary housing and community', 'cmd-theme');
            ?>
            <img
                class="psm-housing-collage__img psm-housing-collage__img--<?php echo esc_attr($pos); ?>"
                src="<?php echo esc_url($url); ?>"
                alt="<?php echo esc_attr($alt); ?>"
                width="480"
                height="480"
                loading="lazy"
                decoding="async"
            >
        <?php endforeach; ?>
    </div>
    <div class="psm-housing-collage__badge">
        <?php get_template_part('template-parts/components/welcome-badge'); ?>
    </div>
</div>
