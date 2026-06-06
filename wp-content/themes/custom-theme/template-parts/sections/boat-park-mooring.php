<?php
/**
 * Mooring Applications — video media + numbered application steps.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$steps    = psm_get_boat_park_mooring_steps();
$modal_id = 'psm-boat-park-mooring-video';
?>
<section class="psm-boat-park-mooring" id="mooring-applications" aria-labelledby="psm-boat-park-mooring-heading">
    <div class="container psm-container">
        <div class="psm-boat-park-mooring__grid psm-about__grid">
            <?php
            get_template_part(
                'template-parts/components/video-play-media',
                null,
                array(
                    'image'      => psm_theme_image('boat-park-mooring.jpg') ?: '',
                    'image_seed' => 'psm-boat-park-mooring',
                    'alt'        => __('Port St Mary lighthouse', 'cmd-theme'),
                    'modal_id'   => $modal_id,
                )
            );
            ?>

            <div class="psm-boat-park-mooring__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => __('Boat Park', 'cmd-theme'),
                        'badge_style' => 'pill',
                        'title'       => __('Mooring Applications', 'cmd-theme'),
                        'heading_id'  => 'psm-boat-park-mooring-heading',
                        'intro'       => array(
                            psm_get_boat_park_mooring_intro(),
                        ),
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

    <?php
    get_template_part(
        'template-parts/components/video-modal',
        null,
        array(
            'id'       => $modal_id,
            'video_id' => psm_get_boat_park_mooring_video_id(),
            'title'    => __('Boat Park mooring applications video', 'cmd-theme'),
        )
    );
    ?>
</section>
