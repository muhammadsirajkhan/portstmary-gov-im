<?php
/**
 * Board meeting minutes — heading, intro, PDF document grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id  = (int) get_queried_object_id();
$defaults = psm_minutes_section_defaults();

$badge      = '';
$title      = '';
$intro      = '';
$viewer_url = '';

if ($page_id && function_exists('get_field')) {
    $badge      = get_field('minutes_badge', $page_id);
    $title      = get_field('minutes_title', $page_id);
    $intro      = get_field('minutes_intro', $page_id);
    $viewer_url = get_field('minutes_viewer_url', $page_id);
}

$badge      = trim((string) $badge);
$title      = trim((string) $title);
$intro      = trim((string) $intro);
$viewer_url = trim((string) $viewer_url);

if ('' === $badge) {
    $badge = $defaults['badge'];
}
if ('' === $title) {
    $title = $defaults['title'];
}
if ('' === $intro) {
    $intro = $defaults['intro'];
}
if ('' === $viewer_url) {
    $viewer_url = $defaults['viewer_url'];
}

$has_badge = '' !== $badge;
$has_title = '' !== $title;
$has_intro = '' !== $intro;
$has_note  = '' !== $viewer_url;

$documents      = psm_get_minutes_documents($page_id);
$document_count = count($documents);

$has_documents = $document_count > 0;

if (!$has_badge && !$has_title && !$has_intro && !$has_note && !$has_documents) {
    return;
}

$heading_id = $has_title ? 'psm-minutes-heading' : '';
?>
<section class="psm-minutes" id="board-meeting-minutes"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_badge || $has_title || $has_intro || $has_note) : ?>
        <header class="psm-minutes__header">
            <?php if ($has_badge || $has_title) : ?>
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'      => $badge,
                        'title'      => $title,
                        'heading_id' => $heading_id,
                        'align'      => 'left',
                        'class'      => 'psm-section-header--minutes',
                    )
                );
                ?>
            <?php endif; ?>

            <?php if ($has_intro || $has_note) : ?>
            <div class="psm-minutes__intro">
                <?php if ($has_intro) : ?>
                <p class="psm-minutes__intro-lead"><?php echo $intro; ?></p>
                <?php endif; ?>
                <?php if ($has_note) : ?>
                <p class="psm-minutes__note">
                    <?php
                    esc_html_e(
                        'Note that each of these documents is published in pdf format. If you require a viewer in order to see these files, please',
                        'cmd-theme'
                    );
                    ?>
                    <a href="<?php echo esc_url($viewer_url); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e('click here', 'cmd-theme'); ?></a>
                </p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </header>
        <?php endif; ?>

        <?php if ($has_documents) : ?>
        <div class="psm-minutes__documents">
            <?php foreach (array_chunk($documents, 71) as $column) : ?>
                <ul class="psm-minutes__documents-col">
                    <?php foreach ($column as $document) : ?>
                        <?php
                        $label = isset($document['label']) ? trim((string) $document['label']) : '';
                        if ('' === $label) {
                            continue;
                        }
                        ?>
                        <li>
                            <?php
                            get_template_part(
                                'template-parts/components/pdf-document-link',
                                null,
                                array(
                                    'label'    => psm_minutes_format_label($label),
                                    'file_url' => isset($document['file_url']) ? (string) $document['file_url'] : '',
                                )
                            );
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
