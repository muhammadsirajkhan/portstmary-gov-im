<?php
/**
 * Supporting the local and boating community — asymmetric imagery.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_boat_park_community_section($page_id);

$badge = trim((string) $section['badge']);
$title = trim((string) $section['title']);
$paragraphs = array_values(array_filter((array) $section['paragraphs']));
$img_harbor = trim((string) $section['image_harbor']);
$img_lighthouse = trim((string) $section['image_lighthouse']);

$has_header = '' !== $badge || '' !== $title;
$has_prose = !empty($paragraphs);
$has_harbor = '' !== $img_harbor;
$has_light = '' !== $img_lighthouse;

if (!$has_header && !$has_prose && !$has_harbor && !$has_light) {
    return;
}

if (!$has_harbor) {
    $img_harbor = psm_placeholder_image(560, 380, 'psm-boat-park-harbor');
}

if (!$has_light) {
    $img_lighthouse = psm_placeholder_image(560, 380, 'psm-boat-park-lighthouse');
}
?>
<section class="psm-boat-park-community" id="supporting-boating-community" <?php echo $title ? ' aria-labelledby="psm-boat-park-community-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-boat-park-community__grid">
            <div class="psm-boat-park-community__col psm-boat-park-community__col--left">
                <?php if ($has_header): ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge' => $badge,
                       
                            'title' => $title,
                            'heading_id' => 'psm-boat-park-community-heading',
                            'align' => 'left',
                            'class' => 'psm-section-header--boat-park-community',
                        )
                    );
                    ?>
                <?php endif; ?>

                <div class="psm-boat-park-community__media psm-boat-park-community__media--bottom">
                    <!-- <span class="psm-boat-park-community__accent psm-boat-park-community__accent--left" aria-hidden="true"></span> -->
                    <img class="psm-boat-park-community__img psm-boat-park-community__img--left"
                        src="<?php echo esc_url($img_harbor); ?>"
                        alt="<?php esc_attr_e('Port St Mary harbor and boat park', 'cmd-theme'); ?>" width="560"
                        height="380" loading="lazy" decoding="async">
                </div>
            </div>

            <div class="psm-boat-park-community__col psm-boat-park-community__col--right">
                <div class="psm-boat-park-community__media psm-boat-park-community__media--top">
                    <!-- <span class="psm-boat-park-community__accent psm-boat-park-community__accent--right" aria-hidden="true"></span> -->
                    <img class="psm-boat-park-community__img psm-boat-park-community__img--right"
                        src="<?php echo esc_url($img_lighthouse); ?>"
                        alt="<?php esc_attr_e('Coastal lighthouse near Port St Mary', 'cmd-theme'); ?>" width="560"
                        height="380" loading="lazy" decoding="async">
                </div>

                <?php if ($has_prose): ?>
                    <div class="psm-boat-park-community__prose">
                        <?php foreach ($paragraphs as $paragraph): ?>
                            <p><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="psm-boat-park-community__badge">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/badge.webp"
                    alt="Port St Mary Commissioners">
            </div>
        </div>
    </div>
</section>