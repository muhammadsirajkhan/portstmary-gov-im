<?php
/**
 * Our Role in the Community — staggered image + copy rows.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$header = psm_get_who_we_are_role_header($page_id);
$rows = psm_get_who_we_are_role_rows($page_id);

$badge = trim((string) $header['badge']);
$title = trim((string) $header['title']);

$has_header = '' !== $badge || '' !== $title;
$has_rows = !empty($rows);

if (!$has_header && !$has_rows) {
    return;
}

$heading_id = '' !== $title ? 'psm-who-we-are-role-heading' : '';
?>
<section class="psm-who-we-are-role" id="our-role-in-the-community" <?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    

    <div class="container psm-container">
    <?php if ($has_header): ?>
        
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge' => $badge,
                    'title' => $title,
                    'heading_id' => $heading_id,
                    'class' => 'psm-section-header--who-we-are-role',
                )
            );
            ?>
        
    <?php endif; ?>
        <?php if ($has_rows): ?>
            <div class="psm-housing-zigzag__block psm-housing-zigzag__block--grey">
                <?php foreach ($rows as $row): ?>
                    <?php
                    $layout = $row['layout'];
                    $row_class = 'psm-housing-zigzag__row psm-housing-zigzag__row--' . esc_attr($layout);
                    $image_alt = !empty($row['paragraphs'][0]) ? wp_trim_words($row['paragraphs'][0], 8, '…') : __('Our role in the community', 'cmd-theme');
                    ?>
                    <article class="<?php echo esc_attr($row_class); ?>">
                        <?php
                        get_template_part(
                            'template-parts/components/housing-zigzag-media',
                            null,
                            array(
                                'variant' => 'single-badge',
                                'show_badge' => false,
                                'image' => $row['image'],
                                'image_seed' => $row['image_seed'],
                                'accent' => $row['accent'],
                                'alt' => $image_alt,
                            )
                        );
                        ?>
                        <div class="psm-housing-zigzag__content psm-who-we-are-role__content">
                            <?php if (!empty($row['paragraphs'])): ?>
                                <div class="psm-who-we-are-role__prose">
                                    <?php foreach ($row['paragraphs'] as $paragraph): ?>
                                        <p><?php echo esc_html($paragraph); ?></p>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($row['highlight'])): ?>
                                <div class="psm-who-we-are-role__highlight">
                                    <?php foreach (explode("\r\n", trim((string) $row['highlight'])) as $highlight): ?>
                                        <p><?php echo esc_html($highlight); ?></p>
                                    <?php endforeach; ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>