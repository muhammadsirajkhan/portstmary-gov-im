<?php
/**
 * Financial Statements — cream section with PDF document grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_rates_financial_statements_section($page_id);
$columns = psm_get_rates_financial_document_columns($page_id);

$background = trim((string) $section['background']);
$badge      = trim((string) $section['badge']);
$title      = trim((string) $section['title']);
$intro      = array_values(array_filter((array) $section['intro']));

$document_count = 0;
foreach ($columns as $column) {
    $document_count += count($column);
}

$has_background = '' !== $background;
$has_header     = '' !== $badge || '' !== $title || !empty($intro);
$has_documents  = $document_count > 0;

if (!$has_background && !$has_header && !$has_documents) {
    return;
}
?>
<section class="psm-rates-financial-statements" id="financial-statements" <?php echo $title ? ' aria-labelledby="psm-rates-financial-statements-heading"' : ''; ?>>
    <?php if ($has_background) : ?>
        <img
            class="psm-rates-financial-statements__watermark"
            src="<?php echo esc_url($background); ?>"
            alt=""
            width="480"
            height="620"
            loading="lazy"
            decoding="async"
            aria-hidden="true"
        >
    <?php endif; ?>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'       => $badge,
                    'badge_style' => 'pill',
                    'title'       => $title,
                    'heading_id'  => $title ? 'psm-rates-financial-statements-heading' : '',
                    'intro'       => $intro,
                    'align'       => 'left',
                    'class'       => 'psm-section-header--rates-financial-statements',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_documents) : ?>
            <div class="psm-rates-financial-statements__documents psm-minutes__documents">
                <?php foreach ($columns as $column) : ?>
                    <?php if (empty($column)) : ?>
                        <?php continue; ?>
                    <?php endif; ?>
                    <ul class="psm-minutes__documents-col">
                        <?php foreach ($column as $document) : ?>
                            <li>
                                <?php
                                get_template_part(
                                    'template-parts/components/pdf-document-link',
                                    null,
                                    array(
                                        'label'    => $document['label'],
                                        'file_url' => $document['file_url'],
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
