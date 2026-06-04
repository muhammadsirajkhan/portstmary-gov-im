<?php
/**
 * Supporting Community Spaces — media + intro copy.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$img_main = psm_theme_image('amenities-community-main.jpg') ?: '';
$img_sub  = psm_theme_image('amenities-community-sub.jpg') ?: '';
?>
<section class="psm-amenities-intro" id="supporting-community-spaces" aria-labelledby="psm-amenities-intro-heading">
    <div class="container psm-container">
        <div class="psm-amenities-intro__grid psm-about__grid">
            <?php
            get_template_part(
                'template-parts/components/about-media',
                null,
                array(
                    'image_main'         => $img_main,
                    'image_sub'          => $img_sub,
                    'image_main_alt'     => __('Community spaces in Port St Mary', 'cmd-theme'),
                    'image_sub_alt'      => __('Harbour and public amenities', 'cmd-theme'),
                    'show_experience'    => false,
                    'show_welcome_badge' => false,
                    'show_accent'        => false,
                )
            );
            ?>

            <div class="psm-amenities-intro__content psm-about__content">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => __('Public Amenities', 'cmd-theme'),
                        'badge_style' => 'red',
                        'title'       => __('Supporting Community Spaces', 'cmd-theme'),
                        'heading_id'  => 'psm-amenities-intro-heading',
                        'align'       => 'left',
                        'class'       => 'psm-section-header--amenities-intro',
                    )
                );
                ?>

                <div class="psm-amenities-intro__prose">
                    <?php foreach (psm_get_amenities_community_spaces_paragraphs() as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
