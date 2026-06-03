<?php
/**
 * FOI information section — intro + PDF document grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();

$badge  = '';
$title  = '';
$intro  = array();

if ($page_id && function_exists('get_field')) {
    $badge = get_field('foi_badge', $page_id);
    $title = get_field('foi_title', $page_id);

    $intro_raw = get_field('foi_intro', $page_id);
    if (is_string($intro_raw) && '' !== trim($intro_raw)) {
        $intro = array_values(
            array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n\s*\r?\n/', $intro_raw))
            )
        );
    }
}

$badge = trim((string) $badge);
$title = trim((string) $title);

$has_badge = '' !== $badge;
$has_title = '' !== $title;
$has_intro = !empty($intro);

$columns         = psm_get_foi_document_columns($page_id);
$has_documents   = false;
$document_count  = 0;

foreach ($columns as $column) {
    $document_count += count($column);
}
$has_documents = $document_count > 0;

if (!$has_badge && !$has_title && !$has_intro && !$has_documents) {
    return;
}

$heading_id = $has_title ? 'psm-foi-heading' : '';
?>
<section class="psm-foi" id="foi-information"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_badge || $has_title || $has_intro) : ?>
        <div class="psm-foi__intro">
            <?php if ($has_badge || $has_title) : ?>
            <div class="psm-foi__intro-head">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'      => $badge,
                        'title'      => $title,
                        'heading_id' => $heading_id,
                        'align'      => 'left',
                        'class'      => 'psm-section-header--foi',
                    )
                );
                ?>
            </div>
            <?php endif; ?>
            <?php if ($has_intro) : ?>
            <div class="psm-foi__intro-text">
                <?php foreach ($intro as $paragraph) : ?>
                    <p><?php echo esc_html($paragraph); ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if ($has_documents) : ?>
        <div class="psm-foi__documents">
            <?php foreach ($columns as $column) : ?>
                <?php if (empty($column)) : ?>
                    <?php continue; ?>
                <?php endif; ?>
                <ul class="psm-foi__documents-col">
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
                                    'label'    => $label,
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
