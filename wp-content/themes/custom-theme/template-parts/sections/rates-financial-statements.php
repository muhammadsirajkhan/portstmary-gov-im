<?php
/**
 * Financial Statements — cream section with PDF document grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$columns   = psm_get_rates_financial_statement_columns();
$watermark = psm_theme_image('rates-financial-watermark.png') ?: psm_theme_image('local-info-lighthouse.jpg');
?>
<section class="psm-rates-financial-statements" id="financial-statements" aria-labelledby="psm-rates-financial-statements-heading">
    <?php if ($watermark) : ?>
        <img
            class="psm-rates-financial-statements__watermark"
            src="<?php echo esc_url($watermark); ?>"
            alt=""
            width="480"
            height="620"
            loading="lazy"
            decoding="async"
            aria-hidden="true"
        >
    <?php endif; ?>
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'       => __('Information', 'cmd-theme'),
                'badge_style' => 'pill',
                'title'       => __('Financial Statements', 'cmd-theme'),
                'heading_id'  => 'psm-rates-financial-statements-heading',
                'intro'       => psm_get_rates_financial_statements_intro(),
                'align'       => 'left',
                'class'       => 'psm-section-header--rates-financial-statements',
            )
        );
        ?>

        <div class="psm-rates-financial-statements__documents psm-minutes__documents">
            <?php foreach ($columns as $column) : ?>
                <ul class="psm-minutes__documents-col">
                    <?php foreach ($column as $label) : ?>
                        <li>
                            <?php
                            get_template_part(
                                'template-parts/components/pdf-document-link',
                                null,
                                array(
                                    'label' => $label,
                                )
                            );
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</section>
