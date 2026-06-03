<?php
/**
 * Work With Us media — wide top image, square sub-image, crest badge.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image_top     Top image URL.
 *     @type string $image_sub     Bottom-left image URL.
 *     @type string $seed_top      Placeholder seed for top image.
 *     @type string $seed_sub      Placeholder seed for sub image.
 *     @type string $alt_top       Top image alt text.
 *     @type string $alt_sub       Sub image alt text.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image_top' => '',
        'image_sub' => '',
        'seed_top'  => 'psm-jobs-work-top',
        'seed_sub'  => 'psm-jobs-work-sub',
        'alt_top'   => __('Port St Mary Commissioners at work', 'cmd-theme'),
        'alt_sub'   => __('Team member in Port St Mary', 'cmd-theme'),
    )
);

$img_top = $args['image_top'] ?: psm_placeholder_image(980, 420, $args['seed_top']);
$img_sub = $args['image_sub'] ?: psm_placeholder_image(360, 360, $args['seed_sub']);
?>
<div class="psm-jobs-work-media">
    <img
        class="psm-jobs-work-media__top"
        src="<?php echo esc_url($img_top); ?>"
        alt="<?php echo esc_attr($args['alt_top']); ?>"
        width="980"
        height="420"
        loading="lazy"
        decoding="async"
    >
    <div class="psm-jobs-work-media__lower">
        <img
            class="psm-jobs-work-media__sub"
            src="<?php echo esc_url($img_sub); ?>"
            alt="<?php echo esc_attr($args['alt_sub']); ?>"
            width="360"
            height="360"
            loading="lazy"
            decoding="async"
        >
    </div>
    <div class="psm-jobs-work-media__badge">
        <?php get_template_part('template-parts/components/welcome-badge'); ?>
    </div>
</div>
