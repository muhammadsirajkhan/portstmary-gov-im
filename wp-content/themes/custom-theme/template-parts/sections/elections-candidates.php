<?php
/**
 * Candidates — copy + action links + image collage.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$content = psm_get_election_candidates_content();
?>
<section class="psm-elections-candidates" id="election-candidates" aria-labelledby="psm-elections-candidates-heading">
    <div class="container psm-container">
        <div class="psm-elections-candidates__grid psm-about__grid">
            <div class="psm-elections-candidates__content psm-about__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => __('Elections', 'cmd-theme'),
                        'badge_style' => 'red',
                        'title'       => __('Candidates', 'cmd-theme'),
                        'heading_id'  => 'psm-elections-candidates-heading',
                        'align'       => 'left',
                        'class'       => 'psm-section-header--elections-candidates',
                    )
                );
                ?>

                <p class="psm-about__lead"><?php echo esc_html($content['lead']); ?></p>

                <?php
                get_template_part(
                    'template-parts/components/election-action-links',
                    null,
                    array(
                        'links' => $content['links'],
                    )
                );
                ?>
            </div>

            <?php
            get_template_part(
                'template-parts/components/about-media',
                null,
                array(
                    'image_main'         => psm_theme_image('election-candidate-main.jpg') ?: '',
                    'image_sub'          => psm_theme_image('election-candidate-sub.jpg') ?: '',
                    'image_main_alt'     => __('Candidate at a voting booth', 'cmd-theme'),
                    'image_sub_alt'      => __('Election candidate portrait', 'cmd-theme'),
                    'show_experience'    => false,
                    'show_welcome_badge' => false,
                    'show_accent'        => false,
                    'sub_position'       => 'left',
                )
            );
            ?>
        </div>
    </div>
</section>
