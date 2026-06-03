<?php
/**
 * Reusable numbered pagination bar.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type int    $current  Current page number.
 *     @type int    $total    Total pages.
 *     @type int    $post_id  Page ID for link base.
 *     @type string $aria_label Accessible nav label.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'current'    => 1,
        'total'      => 1,
        'post_id'    => 0,
        'aria_label' => __('Pagination', 'cmd-theme'),
    )
);

$current = max(1, (int) $args['current']);
$total   = max(1, (int) $args['total']);
$post_id = (int) $args['post_id'];

if ($total <= 1) {
    return;
}

$pages = psm_build_pagination_pages($current, $total);
$prev_url = $current > 1 ? psm_get_paged_page_link($current - 1, $post_id) : '';
$next_url = $current < $total ? psm_get_paged_page_link($current + 1, $post_id) : '';
?>
<nav class="psm-pagination" aria-label="<?php echo esc_attr($args['aria_label']); ?>">
    <div class="psm-pagination__inner">
        <?php if ($prev_url) : ?>
            <a class="psm-pagination__btn psm-pagination__btn--prev" href="<?php echo esc_url($prev_url); ?>">
                <?php esc_html_e('Previous', 'cmd-theme'); ?>
            </a>
        <?php else : ?>
            <span class="psm-pagination__btn psm-pagination__btn--prev is-disabled" aria-disabled="true">
                <?php esc_html_e('Previous', 'cmd-theme'); ?>
            </span>
        <?php endif; ?>

        <div class="psm-pagination__pages">
            <?php foreach ($pages as $page_item) : ?>
                <?php if ('ellipsis' === $page_item) : ?>
                    <span class="psm-pagination__ellipsis" aria-hidden="true">&hellip;</span>
                <?php else : ?>
                    <?php
                    $page_num = (int) $page_item;
                    $is_current = $page_num === $current;
                    $page_url = psm_get_paged_page_link($page_num, $post_id);
                    ?>
                    <?php if ($is_current) : ?>
                        <span class="psm-pagination__page is-current" aria-current="page"><?php echo (int) $page_num; ?></span>
                    <?php else : ?>
                        <a class="psm-pagination__page" href="<?php echo esc_url($page_url); ?>"><?php echo (int) $page_num; ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <?php if ($next_url) : ?>
            <a class="psm-pagination__btn psm-pagination__btn--next" href="<?php echo esc_url($next_url); ?>">
                <?php esc_html_e('Next', 'cmd-theme'); ?>
            </a>
        <?php else : ?>
            <span class="psm-pagination__btn psm-pagination__btn--next is-disabled" aria-disabled="true">
                <?php esc_html_e('Next', 'cmd-theme'); ?>
            </span>
        <?php endif; ?>
    </div>
</nav>
