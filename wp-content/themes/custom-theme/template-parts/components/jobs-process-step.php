<?php
/**
 * Single step in the How To Apply process row.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type int    $number Step number (1–3).
 *     @type string $title  Step title.
 *     @type string $text   Step description.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'number' => 1,
        'title'  => '',
        'text'   => '',
    )
);

if (!$args['title']) {
    return;
}
?>
<div class="psm-jobs-process__step">
    <span class="psm-jobs-process__number" aria-hidden="true"><?php echo (int) $args['number']; ?></span>
    <div class="psm-jobs-process__body">
        <h3 class="psm-jobs-process__title"><?php echo esc_html($args['title']); ?></h3>
        <?php if ($args['text']) : ?>
            <p class="psm-jobs-process__text"><?php echo esc_html($args['text']); ?></p>
        <?php endif; ?>
    </div>
</div>
