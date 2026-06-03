<?php
/**
 * Opening hours — weekday schedule list.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_commissioners_hours_section($page_id);
$hours   = psm_get_commissioners_opening_hours($page_id);

$badge = trim((string) $section['badge']);
$title = trim((string) $section['title']);
$note  = trim((string) $section['note']);

if ('' === $badge && '' === $title && empty($hours) && '' === $note) {
    return;
}

$heading_id = '' !== $title ? 'psm-commissioners-hours-heading' : '';
?>
<section class="psm-commissioners-hours" id="opening-hours"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($badge || $title) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $heading_id,
                    'class'      => 'psm-section-header--commissioners-hours',
                )
            );
            ?>
        <?php endif; ?>

        <?php if (!empty($hours) || $note) : ?>
        <div class="psm-commissioners-hours__panel">
            <?php if (!empty($hours)) : ?>
            <ul class="psm-commissioners-hours__list">
                <?php foreach ($hours as $row) : ?>
                    <li class="psm-commissioners-hours__row<?php echo !empty($row['is_today']) ? ' is-today' : ''; ?>">
                        <div class="psm-commissioners-hours__day">
                            <span class="psm-commissioners-hours__clock" aria-hidden="true"></span>
                            <span class="psm-commissioners-hours__day-label"><?php echo esc_html($row['label']); ?></span>
                            <?php if (!empty($row['is_today'])) : ?>
                                <span class="psm-commissioners-hours__today"><?php esc_html_e('Today', 'cmd-theme'); ?></span>
                            <?php endif; ?>
                        </div>
                        <span class="psm-commissioners-hours__time"><?php echo esc_html($row['hours']); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if ($note) : ?>
            <p class="psm-commissioners-hours__note"><?php echo esc_html($note); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
