<?php
/**
 * Supporting the local and boating community — asymmetric imagery.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$img_harbor     = psm_theme_image('boat-park-harbor.jpg') ?: psm_placeholder_image(560, 380, 'psm-boat-park-harbor');
$img_lighthouse = psm_theme_image('boat-park-lighthouse.jpg') ?: psm_placeholder_image(560, 380, 'psm-boat-park-lighthouse');
?>
<section class="psm-boat-park-community" id="supporting-boating-community" aria-labelledby="psm-boat-park-community-heading">
    <div class="container psm-container">
        <div class="psm-boat-park-community__grid">
            <div class="psm-boat-park-community__col psm-boat-park-community__col--left">
                <?php
                get_template_part(
                    'template-parts/components/section-header',
                    null,
                    array(
                        'badge'       => __('Port St Mary Commissioners', 'cmd-theme'),
                        'title'       => __('Supporting the Local and Boating Community', 'cmd-theme'),
                        'heading_id'  => 'psm-boat-park-community-heading',
                        'align'       => 'left',
                        'class'       => 'psm-section-header--boat-park-community',
                    )
                );
                ?>

                <div class="psm-boat-park-community__media psm-boat-park-community__media--bottom">
                    <span class="psm-boat-park-community__accent psm-boat-park-community__accent--left" aria-hidden="true"></span>
                    <img
                        class="psm-boat-park-community__img psm-boat-park-community__img--left"
                        src="<?php echo esc_url($img_harbor); ?>"
                        alt="<?php esc_attr_e('Port St Mary harbor and boat park', 'cmd-theme'); ?>"
                        width="560"
                        height="380"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>

            <div class="psm-boat-park-community__col psm-boat-park-community__col--right">
                <div class="psm-boat-park-community__media psm-boat-park-community__media--top">
                    <span class="psm-boat-park-community__accent psm-boat-park-community__accent--right" aria-hidden="true"></span>
                    <img
                        class="psm-boat-park-community__img psm-boat-park-community__img--right"
                        src="<?php echo esc_url($img_lighthouse); ?>"
                        alt="<?php esc_attr_e('Coastal lighthouse near Port St Mary', 'cmd-theme'); ?>"
                        width="560"
                        height="380"
                        loading="lazy"
                        decoding="async"
                    >
                </div>

                <div class="psm-boat-park-community__prose">
                    <?php foreach (psm_get_boat_park_community_paragraphs() as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="psm-boat-park-community__badge">
                <?php get_template_part('template-parts/components/welcome-badge'); ?>
            </div>
        </div>
    </div>
</section>
