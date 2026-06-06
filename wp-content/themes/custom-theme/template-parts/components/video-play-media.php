<?php
/**
 * Single image with welcome badge and play-video trigger.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image       Image URL.
 *     @type string $image_seed  Placeholder seed when image is empty.
 *     @type string $alt         Image alt text.
 *     @type string $modal_id    ID of the linked video modal element.
 *     @type string $play_label  Play button label.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image'      => '',
        'image_seed' => 'psm-video-media',
        'alt'        => '',
        'modal_id'   => '',
        'play_label' => __('Play Video', 'cmd-theme'),
    )
);

$image    = $args['image'] ?: psm_placeholder_image(600, 720, $args['image_seed']);
$alt      = $args['alt'] ?: __('Port St Mary boat park', 'cmd-theme');
$modal_id = trim((string) $args['modal_id']);
?>
<div class="psm-video-media">
    <!-- <span class="psm-video-media__accent" aria-hidden="true"></span> -->
    <div class="psm-video-media__wrap">
        <img
            class="psm-video-media__img"
            src="<?php echo esc_url($image); ?>"
            alt="<?php echo esc_attr($alt); ?>"
            width="600"
            height="720"
            loading="lazy"
            decoding="async"
        >
        <?php // get_template_part('template-parts/components/welcome-badge'); ?>

        <?php if ($modal_id) : ?>
            <button
                type="button"
                class="psm-video-media__overlay"
                data-video-modal="<?php echo esc_attr($modal_id); ?>"
                aria-haspopup="dialog"
                aria-controls="<?php echo esc_attr($modal_id); ?>"
                aria-label="<?php echo esc_attr($args['play_label']); ?>"
            ></button>
            <!-- <button
                type="button"
                class="psm-video-media__play"
                data-video-modal="<?php echo esc_attr($modal_id); ?>"
                aria-haspopup="dialog"
                aria-controls="<?php echo esc_attr($modal_id); ?>"
            >
                <span class="psm-video-media__play-icon" aria-hidden="true"></span>
                <span class="psm-video-media__play-label"><?php echo esc_html($args['play_label']); ?></span>
            </button> -->
        <?php endif; ?>
    </div>
</div>
