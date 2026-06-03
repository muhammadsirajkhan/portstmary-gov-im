<?php
/**
 * Hero slider section.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$hero        = psm_get_hero_section();
$hero_slides = $hero['slides'];
$slide_count = count($hero_slides);
$primary     = $hero['primary_button'];
$secondary   = $hero['secondary_button'];
?>
<section class="psm-hero" id="hero" aria-label="<?php esc_attr_e('Hero banner', 'cmd-theme'); ?>">
    <img
        class="psm-hero__bg"
        src="<?php echo esc_url($hero['background']); ?>"
        alt="<?php echo esc_attr($hero['background_alt']); ?>"
        width="1920"
        height="1080"
        loading="eager"
        fetchpriority="high"
        decoding="async"
    >

    <div class="swiper psm-hero-swiper">
        <div class="swiper-wrapper">
            <?php foreach ($hero_slides as $index => $slide) : ?>
                <?php $is_first = 0 === $index; ?>
                <div class="swiper-slide psm-hero__slide">
                    <div class="container psm-container psm-hero__content"<?php echo $is_first ? '' : ' aria-hidden="true"'; ?>>
                        <?php if ('' !== $slide['kicker']) : ?>
                            <p class="psm-hero__kicker"><?php echo esc_html($slide['kicker']); ?></p>
                        <?php endif; ?>
                        <?php if ($is_first) : ?>
                            <h1 class="psm-hero__title" id="psm-hero-title">
                                <span class="psm-hero__title-line"><?php echo esc_html($slide['title_1']); ?></span>
                                <?php if ('' !== $slide['title_2']) : ?>
                                    <span class="psm-hero__title-line psm-hero__title-line--lg"><?php echo esc_html($slide['title_2']); ?></span>
                                <?php endif; ?>
                            </h1>
                        <?php else : ?>
                            <div class="psm-hero__title" role="group" aria-label="<?php echo esc_attr(trim($slide['title_1'] . ' ' . $slide['title_2'])); ?>">
                                <span class="psm-hero__title-line"><?php echo esc_html($slide['title_1']); ?></span>
                                <?php if ('' !== $slide['title_2']) : ?>
                                    <span class="psm-hero__title-line psm-hero__title-line--lg"><?php echo esc_html($slide['title_2']); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ('' !== $slide['ribbon']) : ?>
                            <p class="psm-hero__ribbon">
                                <span><?php echo esc_html($slide['ribbon']); ?></span>
                            </p>
                        <?php endif; ?>
                        <?php if ('' !== $slide['intro']) : ?>
                            <p class="psm-hero__intro"><?php echo esc_html($slide['intro']); ?></p>
                        <?php endif; ?>
                        <?php if ('' !== $primary['url'] || '' !== $secondary['url']) : ?>
                            <div class="psm-hero__actions">
                                <?php if ('' !== $primary['url']) : ?>
                                    <?php
                                    get_template_part(
                                        'template-parts/components/button-pill',
                                        null,
                                        array(
                                            'text'    => $primary['title'] ?: __('Report an Issue', 'cmd-theme'),
                                            'url'     => $primary['url'],
                                            'variant' => 'primary',
                                        )
                                    );
                                    ?>
                                <?php endif; ?>
                                <?php if ('' !== $secondary['url']) : ?>
                                    <?php
                                    get_template_part(
                                        'template-parts/components/button-pill',
                                        null,
                                        array(
                                            'text'    => $secondary['title'] ?: __('View Services', 'cmd-theme'),
                                            'url'     => $secondary['url'],
                                            'variant' => 'secondary',
                                        )
                                    );
                                    ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- <span class="psm-hero__bird psm-hero__bird--1" aria-hidden="true"></span>
    <span class="psm-hero__bird psm-hero__bird--2" aria-hidden="true"></span> -->

    <?php if ($slide_count > 1) : ?>
        <ul class="psm-hero__pager d-none d-xl-flex" aria-label="<?php esc_attr_e('Hero slides', 'cmd-theme'); ?>">
            <?php for ($i = 1; $i <= $slide_count; $i++) : ?>
                <li class="<?php echo 1 === $i ? 'is-active' : ''; ?>">
                    <span class="psm-hero__pager-line" aria-hidden="true"></span>
                    <button type="button" class="psm-hero__pager-btn" data-slide="<?php echo esc_attr((string) ($i - 1)); ?>" aria-label="<?php echo esc_attr(sprintf(__('Go to slide %d', 'cmd-theme'), $i)); ?>">
                        <?php echo esc_html(str_pad((string) $i, 2, '0', STR_PAD_LEFT)); ?>
                    </button>
                </li>
            <?php endfor; ?>
        </ul>
    <?php endif; ?>

    <?php if ('' !== $hero['side_label']) : ?>
        <p class="psm-hero__side-label d-none d-xl-block" aria-hidden="true"><?php echo esc_html($hero['side_label']); ?></p>
    <?php endif; ?>
</section>
