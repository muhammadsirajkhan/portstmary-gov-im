<?php
/**
 * Reusable inner page banner (all non-home pages).
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $kicker     Small uppercase line above title.
 *     @type string $title      Main H1 (plain text, no period).
 *     @type string $ribbon     Red ribbon label.
 *     @type string $intro      Description paragraph.
 *     @type array  $breadcrumb Breadcrumb items {label, url}.
 *     @type string $image      Background image URL.
 *     @type string $image_seed Placeholder seed if no image.
 *     @type string $heading_id     Optional id on h1.
 *     @type string $variant        default|featured — featured shows image below copy on light hero.
 *     @type string $featured_image Optional foreground image URL (featured variant).
 *     @type string $featured_seed  Placeholder seed for featured image.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'kicker'          => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'           => '',
        'ribbon'          => '',
        'intro'           => '',
        'breadcrumb'      => array(),
        'image'           => '',
        'image_seed'      => 'psm-inner-banner',
        'heading_id'      => '',
        'variant'         => 'default',
        'featured_image'  => '',
        'featured_seed'   => 'psm-inner-banner-featured',
    )
);

$args = psm_merge_inner_banner_acf($args);

$is_featured = 'featured' === $args['variant'];
$bg_image      = $args['image'] ?: psm_placeholder_image(1920, 640, $args['image_seed']);
$featured_img  = $args['featured_image'] ?: ( $is_featured ? psm_placeholder_image(1200, 560, $args['featured_seed']) : '' );
$banner_class  = 'psm-inner-banner' . ( $is_featured ? ' psm-inner-banner--featured' : '' );
$wave_url = psm_theme_image('wave-hero.svg') ?: get_template_directory_uri() . '/assets/images/wave-hero.svg';

$heading_attrs = '';
if ($args['heading_id']) {
    $heading_attrs = ' id="' . esc_attr($args['heading_id']) . '"';
}
?>
<section class="<?php echo esc_attr($banner_class); ?>" aria-label="<?php echo esc_attr($args['title']); ?>">
    <img
        class="psm-inner-banner__bg"
        src="<?php echo esc_url($bg_image); ?>"
        alt=""
        width="1920"
        height="640"
        loading="eager"
        fetchpriority="high"
        decoding="async"
    >
    <!-- <span class="psm-inner-banner__overlay" aria-hidden="true"></span> -->

    <div class="container psm-container psm-inner-banner__content">
        <?php if ($args['kicker']) : ?>
            <p class="psm-inner-banner__kicker"><?php echo esc_html(strtoupper($args['kicker'])); ?></p>
        <?php endif; ?>
        <?php if ($args['title']) : ?>
            <h1 class="psm-inner-banner__title"<?php echo $heading_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
                <?php echo esc_html($args['title']); ?><span class="psm-inner-banner__title-dot" aria-hidden="true">.</span>
            </h1>
        <?php endif; ?>
        <?php if ($args['ribbon']) : ?>
            <p class="psm-inner-banner__ribbon">
                <span><?php echo esc_html(strtoupper($args['ribbon'])); ?></span>
            </p>
        <?php endif; ?>
        <?php if ($args['intro']) : ?>
            <p class="psm-inner-banner__intro"><?php echo esc_html($args['intro']); ?></p>
        <?php endif; ?>
        <?php if (!empty($args['breadcrumb'])) : ?>
            <nav class="psm-inner-banner__breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'cmd-theme'); ?>">
                <ol class="psm-inner-banner__breadcrumb-list">
                    <?php
                    $crumbs = array_values($args['breadcrumb']);
                    $last   = count($crumbs) - 1;
                    foreach ($crumbs as $index => $crumb) :
                        $label = isset($crumb['label']) ? $crumb['label'] : '';
                        $url   = isset($crumb['url']) ? $crumb['url'] : '';
                        if (!$label) {
                            continue;
                        }
                        ?>
                        <li class="psm-inner-banner__breadcrumb-item">
                            <?php if ($url && $index !== $last) : ?>
                                <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a>
                            <?php else : ?>
                                <span aria-current="page"><?php echo esc_html($label); ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </nav>
        <?php endif; ?>

        <?php if ($is_featured && $featured_img) : ?>
            <img
                class="psm-inner-banner__featured"
                src="<?php echo esc_url($featured_img); ?>"
                alt="<?php echo esc_attr($args['title']); ?>"
                width="1200"
                height="560"
                loading="eager"
                decoding="async"
            >
        <?php endif; ?>
    </div>

    <!-- <div class="psm-inner-banner__wave" aria-hidden="true">
        <img src="<?php echo esc_url($wave_url); ?>" alt="" width="1440" height="120" decoding="async">
    </div> -->
</section>
