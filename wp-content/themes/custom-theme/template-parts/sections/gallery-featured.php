<?php
/**
 * Featured Gallery — three-column image layout.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header  = psm_get_gallery_featured_header($page_id);
$columns = psm_get_gallery_featured_columns($page_id);

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);
$intro = trim((string) $header['intro']);

$has_images = !empty($columns);
$has_header = '' !== $badge || '' !== $title || '' !== $intro;

if (!$has_header && !$has_images) {
    return;
}
?>
<section class="psm-gallery-featured" id="featured-gallery" <?php echo $title ? ' aria-labelledby="psm-gallery-featured-heading"' : ''; ?>>
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
                    'heading_id'  => $title ? 'psm-gallery-featured-heading' : '',
                    'intro'       => '' !== $intro ? array($intro) : array(),
                    'class'       => 'psm-section-header--gallery-featured',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_images) : ?>
            <div class="psm-gallery-columns">
                <?php foreach ($columns as $column) : ?>
                    <div class="psm-gallery-columns__col">
                        <?php foreach ($column['items'] as $item) : ?>
                            <?php if (!empty($item['type']) && 'row' === $item['type']) : ?>
                                <div class="psm-gallery-columns__row">
                                    <?php foreach ((array) $item['items'] as $sub_item) : ?>
                                        <?php
                                        get_template_part(
                                            'template-parts/components/gallery-column-figure',
                                            null,
                                            $sub_item
                                        );
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <?php
                                get_template_part(
                                    'template-parts/components/gallery-column-figure',
                                    null,
                                    $item
                                );
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
