<?php
/**
 * Remembering with Respect — standard header + two-column layout.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id  = (int) get_queried_object_id();
$defaults = psm_remembrance_respect_defaults();

$badge     = '';
$title     = '';
$intro     = array();
$signature = '';
$prose     = array();
$img_main  = '';
$img_sub   = '';

if ($page_id && function_exists('get_field')) {
    $badge     = get_field('respect_badge', $page_id);
    $title     = get_field('respect_title', $page_id);
    $signature = get_field('respect_signature', $page_id);
    $intro     = psm_split_acf_paragraphs(get_field('respect_intro', $page_id));
    $prose     = psm_split_acf_paragraphs(get_field('respect_prose', $page_id));

    $acf_main = get_field('respect_image_main', $page_id);
    $acf_sub  = get_field('respect_image_sub', $page_id);
    $img_main = psm_normalize_acf_image_url($acf_main);
    $img_sub  = psm_normalize_acf_image_url($acf_sub);
}

$badge     = trim((string) $badge);
$title     = trim((string) $title);
$signature = trim((string) $signature);

if ('' === $badge) {
    $badge = $defaults['badge'];
}
if ('' === $title) {
    $title = $defaults['title'];
}
if (empty($intro)) {
    $intro = $defaults['intro'];
}
if ('' === $signature) {
    $signature = $defaults['signature'];
}
if (empty($prose)) {
    $prose = $defaults['prose'];
}
if ('' === $img_main) {
    $img_main = $defaults['image_main'];
}
if ('' === $img_sub) {
    $img_sub = $defaults['image_sub'];
}

$has_badge     = '' !== $badge;
$has_title     = '' !== $title;
$has_intro     = !empty($intro);
$has_signature = '' !== $signature;
$has_prose     = !empty($prose);
$has_img_main  = '' !== $img_main;
$has_img_sub   = '' !== $img_sub;
$has_header    = $has_badge || $has_title;
$has_content   = $has_intro || $has_signature || $has_prose || $has_img_main || $has_img_sub;

if (!$has_header && !$has_content) {
    return;
}

$heading_id = $has_title ? 'psm-remembrance-respect-heading' : '';
$image_alt  = $title ?: __('Community remembrance', 'cmd-theme');
?>
<section class="psm-remembrance-respect" id="remembering-with-respect"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $heading_id,
                    'align'      => 'left',
                    'class'      => 'psm-section-header--remembrance-respect',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_content) : ?>
        <div class="psm-remembrance-respect__grid">
            <?php if ($has_img_main) : ?>
            <div class="psm-remembrance-respect__col psm-remembrance-respect__col--media">
                <?php
                get_template_part(
                    'template-parts/components/remembrance-media',
                    null,
                    array(
                        'image'      => $img_main,
                        'image_seed' => 'psm-remembrance-ceremony',
                        'alt'        => $image_alt,
                        'bar'        => 'left',
                        'width'      => 600,
                        'height'     => 720,
                        'class'      => 'psm-remembrance-media--main',
                    )
                );
                ?>
            </div>
            <?php endif; ?>

            <?php if ($has_intro || $has_signature || $has_img_sub || $has_prose) : ?>
            <div class="psm-remembrance-respect__col psm-remembrance-respect__col--content">
                <?php if ($has_intro) : ?>
                <div class="psm-remembrance-respect__intro">
                    <?php foreach ($intro as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ($has_signature) : ?>
                <p class="psm-remembrance-respect__signature"><?php echo esc_html($signature); ?></p>
                <?php endif; ?>

                <?php if ($has_img_sub) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/remembrance-media',
                        null,
                        array(
                            'image'      => $img_sub,
                            'image_seed' => 'psm-remembrance-memorial',
                            'alt'        => $image_alt,
                            'bar'        => 'right',
                            'width'      => 560,
                            'height'     => 360,
                            'class'      => 'psm-remembrance-media--sub',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_prose) : ?>
                <div class="psm-remembrance-respect__prose">
                    <?php foreach ($prose as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
