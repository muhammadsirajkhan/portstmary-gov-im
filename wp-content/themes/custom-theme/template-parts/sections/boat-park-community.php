<?php
/**
 * Supporting the local and boating community — asymmetric imagery.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$img_left  = psm_theme_image('boat-park-harbor.jpg') ?: psm_placeholder_image(560, 380, 'psm-boat-park-harbor');
$img_right = psm_theme_image('boat-park-lighthouse.jpg') ?: psm_placeholder_image(560, 380, 'psm-boat-park-lighthouse');
?>
<section class="psm-boat-park-community" id="supporting-boating-community" aria-labelledby="psm-boat-park-community-heading">
    <div class="container psm-container">
        <div class="psm-boat-park-community__grid">
            <div class="psm-boat-park-community__col psm-boat-park-community__col--left">
                <h2 class="psm-boat-park-community__title" id="psm-boat-park-community-heading">
                    <?php esc_html_e('Supporting the Local and Boating Community', 'cmd-theme'); ?><span class="psm-boat-park-community__title-dot" aria-hidden="true">.</span>
                </h2>
                <img
                    class="psm-boat-park-community__img psm-boat-park-community__img--left"
                    src="<?php echo esc_url($img_left); ?>"
                    alt="<?php esc_attr_e('Port St Mary harbor and boat park', 'cmd-theme'); ?>"
                    width="560"
                    height="380"
                    loading="lazy"
                    decoding="async"
                >
            </div>

            <div class="psm-boat-park-community__col psm-boat-park-community__col--right">
                <img
                    class="psm-boat-park-community__img psm-boat-park-community__img--right"
                    src="<?php echo esc_url($img_right); ?>"
                    alt="<?php esc_attr_e('Coastal lighthouse near Port St Mary', 'cmd-theme'); ?>"
                    width="560"
                    height="380"
                    loading="lazy"
                    decoding="async"
                >
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
