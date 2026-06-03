<?php
/**
 * Mooring Applications — image + numbered application steps.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$steps = psm_get_boat_park_mooring_steps();
?>
<section class="psm-boat-park-mooring" id="mooring-applications" aria-labelledby="psm-boat-park-mooring-heading">
    <div class="container psm-container">
        <div class="psm-boat-park-mooring__grid psm-about__grid">
            <?php
            get_template_part(
                'template-parts/components/housing-zigzag-media',
                null,
                array(
                    'variant'    => 'single-badge',
                    'image'      => psm_theme_image('boat-park-mooring.jpg') ?: '',
                    'image_seed' => 'psm-boat-park-mooring',
                    'accent'     => 'tl',
                    'alt'        => __('Port St Mary lighthouse', 'cmd-theme'),
                )
            );
            ?>

            <div class="psm-boat-park-mooring__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => __('Apply For a Mooring', 'cmd-theme'),
                        'badge_style' => 'red',
                        'title'       => __('Mooring Applications', 'cmd-theme'),
                        'heading_id'  => 'psm-boat-park-mooring-heading',
                        'align'       => 'left',
                        'class'       => 'psm-section-header--boat-park-mooring',
                    )
                );
                ?>

                <div class="psm-boat-park-mooring__steps">
                    <?php foreach ($steps as $step) : ?>
                        <?php get_template_part('template-parts/components/mooring-application-item', null, $step); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
