<?php
/**
 * About section image collage — accent, badge, experience counter.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $image_main     Main image URL.
 *     @type string $image_sub      Secondary image URL.
 *     @type string $image_main_alt Main image alt.
 *     @type string $image_sub_alt  Secondary image alt.
 *     @type string $years          Experience number label.
 *     @type string $years_label       Experience caption.
 *     @type bool   $show_experience    Show experience counter block.
 *     @type bool   $show_welcome_badge Show circular crest badge.
 *     @type bool   $show_accent        Show red accent block behind images.
 *     @type string $sub_position     right|left — secondary image corner.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'image_main'         => '',
        'image_sub'          => '',
        'image_main_alt'     => __('Community gathering in Port St Mary', 'cmd-theme'),
        'image_sub_alt'      => __('Port St Mary harbour', 'cmd-theme'),
        'years'              => '25+',
        'years_label'        => __('Year Of Experiences', 'cmd-theme'),
        'show_experience'    => true,
        'show_welcome_badge' => true,
        'show_accent'        => true,
        'sub_position'       => 'right',
    )
);

$img_main = $args['image_main'] ?: psm_placeholder_image(600, 720, 'psm-about-main');
$img_sub  = $args['image_sub'] ?: psm_placeholder_image(420, 300, 'psm-about-sub');
$media_class = 'psm-about__media';
if (!$args['show_accent']) {
    $media_class .= ' psm-about__media--plain';
}
if ('left' === $args['sub_position']) {
    $media_class .= ' psm-about__media--sub-left';
}
?>
<div class="<?php echo esc_attr($media_class); ?>">
    <?php if ($args['show_accent']) : ?>
        <span class="psm-about__accent" aria-hidden="true"></span>
    <?php endif; ?>
    <img
        class="psm-about__img-main"
        src="<?php echo esc_url($img_main); ?>"
        alt="<?php echo esc_attr($args['image_main_alt']); ?>"
        width="600"
        height="720"
        loading="lazy"
        decoding="async"
    >
    <img
        class="psm-about__img-sub"
        src="<?php echo esc_url($img_sub); ?>"
        alt="<?php echo esc_attr($args['image_sub_alt']); ?>"
        width="420"
        height="300"
        loading="lazy"
        decoding="async"
    >
    <?php if ($args['show_welcome_badge']) : ?>
        <?php get_template_part('template-parts/components/welcome-badge'); ?>
    <?php endif; ?>
    <?php if ($args['show_experience']) : ?>
        <div class="psm-about__experience">
            <div class="psm-about__experience-copy">
                <span class="psm-about__experience-number"><?php echo esc_html($args['years']); ?></span>
                <span class="psm-about__experience-label"><?php echo esc_html($args['years_label']); ?></span>
            </div>
            <span class="psm-about__experience-icon" aria-hidden="true"></span>
        </div>
    <?php endif; ?>
</div>
