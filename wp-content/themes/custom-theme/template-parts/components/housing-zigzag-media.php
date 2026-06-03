<?php
/**
 * Housing zigzag media — collage, stack, dual-stack, or single image.
 *
 * @package CMD_Theme
 *
 * @var array $args Media configuration (variant, images, seeds, accent).
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'variant'     => 'single',
        'accent'      => 'tl',
        'image'       => '',
        'image_seed'  => 'psm-housing',
        'image_main'  => '',
        'image_sub'   => '',
        'image_sub_1' => '',
        'image_sub_2' => '',
        'seed_main'   => 'psm-hs-main',
        'seed_sub'    => 'psm-hs-sub',
        'seed_sub_1'  => 'psm-hs-sub-1',
        'seed_sub_2'  => 'psm-hs-sub-2',
        'image_seeds' => array(),
        'images'      => array(),
        'alt'         => '',
        'show_badge'  => false,
    )
);

$accents = array('tl', 'tr', 'bl', 'br');
$accent = in_array($args['accent'], $accents, true) ? $args['accent'] : 'tl';
$variant = $args['variant'];

$wrap_class = 'psm-housing-zigzag-media psm-housing-zigzag-media--' . esc_attr($variant);
$wrap_class .= ' psm-housing-zigzag-media--accent-' . esc_attr($accent);

if ('collage3' === $variant) {
    ?>
    <div class="<?php echo esc_attr($wrap_class); ?>">
        <?php
        get_template_part(
            'template-parts/components/refuse-collage-media',
            null,
            array(
                'images'      => $args['images'],
                'image_seeds' => $args['image_seeds'],
            )
        );
        ?>
    </div>
    <?php
    return;
}

if ('collage4' === $variant) {
    ?>
    <div class="<?php echo esc_attr($wrap_class); ?>">
        <span class="psm-housing-zigzag-media__corner" aria-hidden="true"></span>
        <?php
        get_template_part(
            'template-parts/components/housing-collage-media',
            null,
            array(
                'images'      => $args['images'],
                'image_seeds' => $args['image_seeds'],
            )
        );
        ?>
    </div>
    <?php
    return;
}

if ('stack' === $variant) {
    ?>
    <div class="<?php echo esc_attr($wrap_class); ?>">
        <span class="psm-housing-zigzag-media__corner" aria-hidden="true"></span>
        <?php
        get_template_part(
            'template-parts/components/about-media',
            null,
            array(
                'image_main'         => $args['image_main'],
                'image_sub'          => $args['image_sub'],
                'image_main_alt'     => $args['alt'],
                'image_sub_alt'      => $args['alt'],
                'show_experience'    => false,
                'show_welcome_badge' => false,
            )
        );
        ?>
    </div>
    <?php
    return;
}

if ('dual-stack' === $variant) {
    $main = $args['image_main'] ?: psm_placeholder_image(600, 680, $args['seed_main']);
    $sub1 = $args['image_sub_1'] ?: psm_placeholder_image(280, 200, $args['seed_sub_1']);
    $sub2 = $args['image_sub_2'] ?: psm_placeholder_image(280, 200, $args['seed_sub_2']);
    $alt  = $args['alt'] ?: __('Sheltered housing in Port St Mary', 'cmd-theme');
    ?>
    <div class="<?php echo esc_attr($wrap_class); ?>">
        <span class="psm-housing-zigzag-media__corner" aria-hidden="true"></span>
        <img
            class="psm-housing-zigzag-media__main"
            src="<?php echo esc_url($main); ?>"
            alt="<?php echo esc_attr($alt); ?>"
            width="600"
            height="680"
            loading="lazy"
            decoding="async"
        >
        <img
            class="psm-housing-zigzag-media__sub psm-housing-zigzag-media__sub--1"
            src="<?php echo esc_url($sub1); ?>"
            alt=""
            width="280"
            height="200"
            loading="lazy"
            decoding="async"
        >
        <img
            class="psm-housing-zigzag-media__sub psm-housing-zigzag-media__sub--2"
            src="<?php echo esc_url($sub2); ?>"
            alt=""
            width="280"
            height="200"
            loading="lazy"
            decoding="async"
        >
    </div>
    <?php
    return;
}

if ('single-badge' === $variant) {
    $image = $args['image'] ?: psm_placeholder_image(800, 560, $args['image_seed']);
    $alt   = $args['alt'] ?: __('Port St Mary refuse services', 'cmd-theme');
    ?>
    <div class="<?php echo esc_attr($wrap_class); ?> psm-housing-zigzag-media--single-badge">
        <span class="psm-housing-zigzag-media__corner" aria-hidden="true"></span>
        <div class="psm-housing-zigzag-media__single-wrap">
            <img
                class="psm-housing-zigzag-media__single"
                src="<?php echo esc_url($image); ?>"
                alt="<?php echo esc_attr($alt); ?>"
                width="800"
                height="560"
                loading="lazy"
                decoding="async"
            >
            <?php if (!empty($args['show_badge'])) : ?>
                <?php get_template_part('template-parts/components/welcome-badge'); ?>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return;
}

$image = $args['image'] ?: psm_placeholder_image(800, 560, $args['image_seed']);
$alt   = $args['alt'] ?: __('Port St Mary housing', 'cmd-theme');
?>
<div class="<?php echo esc_attr($wrap_class); ?>">
    <span class="psm-housing-zigzag-media__corner" aria-hidden="true"></span>
    <img
        class="psm-housing-zigzag-media__single"
        src="<?php echo esc_url($image); ?>"
        alt="<?php echo esc_attr($alt); ?>"
        width="800"
        height="560"
        loading="lazy"
        decoding="async"
    >
</div>
