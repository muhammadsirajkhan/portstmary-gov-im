<?php
/**
 * Policy page layout (based on single news article).
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$post_id = (int) get_the_ID();
if ($post_id <= 0) {
    return;
}

$data = psm_get_policy_single_data($post_id);
if ('' === ($data['title'] ?? '')) {
    return;
}

$title    = $data['title'];
$updated  = $data['updated'];
$has_meta = '' !== $updated;
?>
<article <?php post_class('psm-policy-single'); ?> id="post-<?php echo esc_attr((string) $post_id); ?>">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/breadcrumbs',
            null,
            array('items' => $data['breadcrumb'])
        );
        ?>

        <header class="psm-policy-single__header">
            <?php if ($has_meta) : ?>
                <div class="psm-news-card__meta psm-policy-single__meta">
                    <span class="psm-news-card__time">
                        <span class="psm-news-card__clock" aria-hidden="true"></span>
                        <?php
                        echo esc_html(
                            sprintf(
                                /* translators: %s: last updated date */
                                __('LAST UPDATED %s', 'cmd-theme'),
                                strtoupper($updated)
                            )
                        );
                        ?>
                    </span>
                </div>
            <?php endif; ?>

            <h1 class="psm-policy-single__title"><?php echo esc_html($title); ?></h1>
        </header>

        <?php if (get_the_content()) : ?>
            <div class="psm-policy-single__content entry-content">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    </div>
</article>
