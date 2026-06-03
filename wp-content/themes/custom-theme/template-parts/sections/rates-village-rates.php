<?php
/**
 * Village Rates — image + intro copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;
?>
<section class="psm-rates-village-rates" id="village-rates" aria-labelledby="psm-rates-village-rates-heading">
    <div class="container psm-container">
        <div class="psm-rates-village-rates__grid psm-about__grid">
            <?php
            get_template_part(
                'template-parts/components/housing-zigzag-media',
                null,
                array(
                    'variant'    => 'single-badge',
                    'image'      => psm_theme_image('rates-village-rates.jpg') ?: '',
                    'image_seed' => 'psm-rates-village-rates',
                    'accent'     => 'tl',
                    'alt'        => __('Working at a desk reviewing village rates documents', 'cmd-theme'),
                )
            );
            ?>

            <div class="psm-rates-village-rates__content psm-about__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => __('Village Rates', 'cmd-theme'),
                        'badge_style' => 'pill',
                        'title'       => __('Village Rates', 'cmd-theme'),
                        'heading_id'  => 'psm-rates-village-rates-heading',
                        'align'       => 'left',
                        'class'       => 'psm-section-header--rates-village-rates',
                    )
                );
                ?>

                <div class="psm-rates-village-rates__prose">
                    <?php foreach (psm_get_rates_village_rates_paragraphs() as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>

                <p class="psm-rates-village-rates__contact">
                    <a class="psm-housing-zigzag__readmore" href="<?php echo esc_url(psm_contact_page_url()); ?>">
                        <span><?php esc_html_e('Contact the office', 'cmd-theme'); ?></span>
                        <span class="psm-housing-zigzag__readmore-arrow" aria-hidden="true"></span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
