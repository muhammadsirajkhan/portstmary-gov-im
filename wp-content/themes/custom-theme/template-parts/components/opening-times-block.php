<?php
/**
 * Opening times info block for zigzag content areas.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string       $title       Block heading.
 *     @type array[]      $rows        { label, value } rows.
 *     @type string       $note        Optional footnote below rows.
 *     @type string       $closed_note Optional closed/holiday note.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'       => __('Opening Times', 'cmd-theme'),
        'rows'        => array(),
        'note'        => '',
        'closed_note' => '',
    )
);

if (empty($args['rows']) && !$args['note'] && !$args['closed_note']) {
    return;
}
?>
<div class="psm-opening-times">
    <?php if ($args['title']) : ?>
        <h3 class="psm-opening-times__title"><?php echo esc_html($args['title']); ?></h3>
    <?php endif; ?>

    <?php if (!empty($args['rows'])) : ?>
        <dl class="psm-opening-times__list">
            <?php foreach ((array) $args['rows'] as $row) : ?>
                <?php
                $row = wp_parse_args(
                    (array) $row,
                    array(
                        'label' => '',
                        'value' => '',
                    )
                );
                if (!$row['label'] && !$row['value']) {
                    continue;
                }
                ?>
                <div class="psm-opening-times__row">
                    <?php if ($row['label']) : ?>
                        <dt class="psm-opening-times__label"><?php echo esc_html($row['label']); ?></dt>
                    <?php endif; ?>
                    <?php if ($row['value']) : ?>
                        <dd class="psm-opening-times__value"><?php echo esc_html($row['value']); ?></dd>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </dl>
    <?php endif; ?>

    <?php if ($args['note']) : ?>
        <p class="psm-opening-times__note"><?php echo esc_html($args['note']); ?></p>
    <?php endif; ?>

    <?php if ($args['closed_note']) : ?>
        <p class="psm-opening-times__closed"><?php echo esc_html($args['closed_note']); ?></p>
    <?php endif; ?>
</div>
