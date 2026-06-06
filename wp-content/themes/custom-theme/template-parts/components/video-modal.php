<?php
/**
 * Accessible YouTube video modal.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $id        Modal element ID.
 *     @type string $video_id  YouTube video ID.
 *     @type string $title     Accessible dialog title.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'id'       => '',
        'video_id' => '',
        'title'    => __('Video player', 'cmd-theme'),
    )
);

$id       = trim((string) $args['id']);
$video_id = trim((string) $args['video_id']);

if ('' === $id || '' === $video_id) {
    return;
}

$embed_url = 'https://www.youtube.com/embed/' . rawurlencode($video_id) . '?rel=0&modestbranding=1&enablejsapi=1';
?>
<div
    id="<?php echo esc_attr($id); ?>"
    class="psm-video-modal"
    hidden
    aria-hidden="true"
>
    <div class="psm-video-modal__backdrop" data-video-modal-close tabindex="-1"></div>
    <div
        class="psm-video-modal__dialog"
        role="dialog"
        aria-modal="true"
        aria-label="<?php echo esc_attr($args['title']); ?>"
    >
        <button
            type="button"
            class="psm-video-modal__close"
            data-video-modal-close
            aria-label="<?php esc_attr_e('Close video', 'cmd-theme'); ?>"
        >
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="psm-video-modal__frame-wrap">
            <iframe
                class="psm-video-modal__iframe"
                title="<?php echo esc_attr($args['title']); ?>"
                data-src="<?php echo esc_url($embed_url); ?>"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen
            ></iframe>
        </div>
    </div>
</div>
