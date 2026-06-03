<?php
/**
 * Serving Port St Mary — image + services list.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$data    = psm_get_commissioners_serving($page_id);

$image = $data['image'] ?: psm_placeholder_image(600, 720, 'psm-commissioners-serving');

$badge = trim((string) $data['badge']);
$title = trim((string) $data['title']);
$intro = trim((string) $data['intro']);
$resp  = trim((string) $data['responsible']);
$items = !empty($data['services']) ? (array) $data['services'] : array();

$has_title = '' !== $title;
$has_intro = '' !== $intro;
$has_resp  = '' !== $resp;
$has_items = !empty($items);
$has_badge = '' !== $badge;

if (!$has_badge && !$has_title && !$has_intro && !$has_resp && !$has_items) {
    return;
}

$heading_id = $has_title ? 'psm-commissioners-serving-heading' : '';
?>
<section class="psm-commissioners-serving" id="serving-port-st-mary"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-commissioners-serving__grid psm-about__grid">
            <div class="psm-commissioners-serving__media psm-about__media psm-about__media--plain">
                <img
                    class="psm-about__img-main"
                    src="<?php echo esc_url($image); ?>"
                    alt="<?php echo esc_attr($title ?: __('Commissioners serving the Port St Mary community', 'cmd-theme')); ?>"
                    width="600"
                    height="720"
                    loading="lazy"
                    decoding="async"
                >
            </div>

            <div class="psm-commissioners-serving__content psm-about__content">
                <?php if ($has_badge || $has_title) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'      => $badge,
                            'title'      => $title,
                            'heading_id' => $heading_id,
                            'align'      => 'left',
                            'class'      => 'psm-section-header--commissioners-serving',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_intro) : ?>
                    <p class="psm-about__lead psm-commissioners-serving__lead"><?php echo esc_html($intro); ?></p>
                <?php endif; ?>

                <?php if ($has_resp) : ?>
                    <p class="psm-commissioners-serving__responsible"><?php echo esc_html($resp); ?></p>
                <?php endif; ?>

                <?php if ($has_items) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/commissioners-services-list',
                        null,
                        array(
                            'items' => $items,
                        )
                    );
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
