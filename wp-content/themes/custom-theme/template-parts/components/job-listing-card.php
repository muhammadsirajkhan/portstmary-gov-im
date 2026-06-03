<?php
/**
 * Job vacancy listing card.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $title    Job title.
 *     @type string $location Location label value.
 *     @type string $category Category label value.
 *     @type string $url      View job link URL.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'title'    => '',
        'location' => '',
        'category' => '',
        'url'      => '#',
    )
);

if (!$args['title']) {
    return;
}
?>
<article class="psm-job-card">
    <h3 class="psm-job-card__title"><?php echo esc_html($args['title']); ?></h3>

    <?php if ($args['location']) : ?>
        <div class="psm-job-card__field">
            <span class="psm-job-card__label"><?php esc_html_e('Location', 'cmd-theme'); ?></span>
            <span class="psm-job-card__value"><?php echo esc_html($args['location']); ?></span>
        </div>
    <?php endif; ?>

    <?php if ($args['category']) : ?>
        <div class="psm-job-card__field">
            <span class="psm-job-card__label"><?php esc_html_e('Category', 'cmd-theme'); ?></span>
            <span class="psm-job-card__value"><?php echo esc_html($args['category']); ?></span>
        </div>
    <?php endif; ?>

    <a class="psm-btn-pill psm-btn-pill--primary psm-job-card__btn" href="<?php echo esc_url($args['url']); ?>">
        <span class="psm-btn-pill__text"><?php esc_html_e('View Job', 'cmd-theme'); ?></span>
        <span class="psm-btn-pill__icon" aria-hidden="true">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/btn-arrow.png'); ?>" alt="" role="presentation">
        </span>
    </a>
</article>
