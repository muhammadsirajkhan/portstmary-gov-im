<?php
/**
 * Single event layout.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$post_id = (int) get_the_ID();
if ($post_id <= 0) {
    return;
}

$data = psm_get_event_single_data($post_id);
if (empty($data['title'])) {
    return;
}

$date  = $data['date'];
$title = $data['title'];
$image = $data['image'];
$alt   = $data['image_alt'];
$has_date  = '' !== $date;
$has_image = '' !== $image;
?>
<article <?php post_class('psm-event-single'); ?> id="post-<?php echo esc_attr((string) $post_id); ?>">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/breadcrumbs',
            null,
            array('items' => $data['breadcrumb'])
        );
        ?>

        <?php if ($has_image) : ?>
            <div class="psm-event-single__media">
                <img
                    src="<?php echo esc_url($image); ?>"
                    alt="<?php echo esc_attr($alt); ?>"
                    width="1200"
                    height="675"
                    loading="eager"
                    fetchpriority="high"
                    decoding="async"
                >
            </div>
        <?php endif; ?>

        <header class="psm-event-single__header">
            <?php if ($has_date) : ?>
                <div class="psm-news-card__meta psm-event-single__meta">
                    <span class="psm-event-single__date">
                        <span class="psm-news-card__clock" aria-hidden="true"></span>
                        <?php echo esc_html(strtoupper($date)); ?>
                    </span>
                </div>
            <?php endif; ?>

            <h1 class="psm-event-single__title"><?php echo esc_html($title); ?></h1>
        </header>

        <?php if (get_the_content()) : ?>
            <div class="psm-event-single__content entry-content">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    </div>
</article>
