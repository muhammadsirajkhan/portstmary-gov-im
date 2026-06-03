<?php
/**
 * News archive grid with pagination.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header  = psm_get_news_page_archive_header($page_id);
$paged   = psm_get_news_page_current();
$query   = psm_get_news_page_query($page_id, $paged);

$badge       = trim((string) $header['badge']);
$title       = trim((string) $header['title']);
$intro       = array_values(array_filter((array) $header['intro']));
$image_badge = psm_get_news_page_image_badge($page_id);

$has_header = '' !== $badge || '' !== $title || !empty($intro);
$has_posts  = $query->have_posts();

if (!$has_header && !$has_posts) {
    wp_reset_postdata();
    return;
}
?>
<section class="psm-news-archive" id="news-archive"<?php echo $title ? ' aria-labelledby="psm-news-archive-heading"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'       => $badge,
                    'badge_style' => 'pill',
                    'title'       => $title,
                    'title_dot'   => 'period',
                    'heading_id'  => $title ? 'psm-news-archive-heading' : '',
                    'intro'       => $intro,
                    'class'       => 'psm-section-header--news-archive',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_posts) : ?>
            <div class="psm-news-archive__grid">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    $card = psm_get_news_card_args(get_the_ID(), array('context' => 'archive'));
                    if (!psm_news_card_has_content($card)) {
                        continue;
                    }
                    get_template_part(
                        'template-parts/components/news-card',
                        null,
                        array_merge(
                            $card,
                            array(
                                'image_badge' => $image_badge,
                            )
                        )
                    );
                endwhile;
                ?>
            </div>

            <?php
            get_template_part(
                'template-parts/components/pagination',
                null,
                array(
                    'current'    => $paged,
                    'total'      => (int) $query->max_num_pages,
                    'post_id'    => $page_id,
                    'aria_label' => __('News pagination', 'cmd-theme'),
                )
            );
            ?>
        <?php endif; ?>
    </div>
</section>
<?php
wp_reset_postdata();
