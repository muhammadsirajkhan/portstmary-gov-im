<?php
/**
 * Mooring Applications — video media + numbered application steps.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id  = (int) get_queried_object_id();
$section  = psm_get_boat_park_mooring_section($page_id);
$modal_id = 'psm-boat-park-mooring-video';

$badge    = trim((string) $section['badge']);
$title    = trim((string) $section['title']);
$intro    = trim((string) $section['intro']);
$image    = trim((string) $section['image']);
$video_id = trim((string) $section['video_id']);
$steps    = array_values(array_filter((array) $section['steps']));

$has_header = '' !== $badge || '' !== $title || '' !== $intro;
$has_media  = '' !== $image || '' !== $video_id;
$has_steps  = !empty($steps);

if (!$has_media && !$has_header && !$has_steps) {
    return;
}
?>
<section class="psm-boat-park-mooring" id="mooring-applications"<?php echo $title ? ' aria-labelledby="psm-boat-park-mooring-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-boat-park-mooring__grid psm-about__grid">
            <?php if ($has_media) : ?>
                <?php
                get_template_part(
                    'template-parts/components/video-play-media',
                    null,
                    array(
                        'image'      => $image,
                        'image_seed' => 'psm-boat-park-mooring',
                        'alt'        => __('Port St Mary lighthouse', 'cmd-theme'),
                        'modal_id'   => '' !== $video_id ? $modal_id : '',
                    )
                );
                ?>
            <?php endif; ?>

            <div class="psm-boat-park-mooring__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'       => $badge,
                            'title'       => $title,
                            'heading_id'  => 'psm-boat-park-mooring-heading',
                            'intro'       => '' !== $intro ? array($intro) : array(),
                            'align'       => 'left',
                            'class'       => 'psm-section-header--boat-park-mooring',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_steps) : ?>
                    <div class="psm-boat-park-mooring__steps">
                        <?php foreach ($steps as $step) : ?>
                            <?php get_template_part('template-parts/components/mooring-application-item', null, $step); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ('' !== $video_id) : ?>
        <?php
        get_template_part(
            'template-parts/components/video-modal',
            null,
            array(
                'id'       => $modal_id,
                'video_id' => $video_id,
                'title'    => __('Boat Park mooring applications video', 'cmd-theme'),
            )
        );
        ?>
    <?php endif; ?>
</section>
