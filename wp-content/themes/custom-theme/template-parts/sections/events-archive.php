<?php
/**
 * Events archive list with pagination.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
if (!$page_id) {
    $match   = psm_match_static_page_pagination_from_uri();
    $page_id = (int) $match['page_id'];
}
$header  = psm_get_events_page_archive_header($page_id);
$paged   = psm_get_events_page_current($page_id);
$query   = psm_get_events_page_query($page_id, $paged);

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);
$intro = array_values(array_filter((array) $header['intro']));

$has_header = '' !== $badge || '' !== $title || !empty($intro);
$has_posts  = $query->have_posts();

if (!$has_header && !$has_posts) {
    wp_reset_postdata();
    return;
}
?>
<section class="psm-events-archive" id="events-archive"<?php echo $title ? ' aria-labelledby="psm-events-archive-heading"' : ''; ?>>
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
                    'heading_id'  => $title ? 'psm-events-archive-heading' : '',
                    'intro'       => $intro,
                    'class'       => 'psm-section-header--events-archive',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_posts) : ?>
            <div class="psm-events-archive__list psm-events__list">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    $card = psm_get_event_card_args(get_the_ID());
                    if (!psm_event_card_has_content($card)) {
                        continue;
                    }
                    get_template_part(
                        'template-parts/components/event-card',
                        null,
                        $card
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
                    'aria_label' => __('Events pagination', 'cmd-theme'),
                )
            );
            ?>
        <?php endif; ?>
    </div>
</section>
<?php
wp_reset_postdata();
