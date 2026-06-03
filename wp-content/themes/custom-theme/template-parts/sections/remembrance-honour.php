<?php
/**
 * Honouring Service & Sacrifice — three-column remembrance cards.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id  = (int) get_queried_object_id();
$defaults = psm_remembrance_honour_header_defaults();

$badge = '';
$title = '';

if ($page_id && function_exists('get_field')) {
    $badge = get_field('honour_badge', $page_id);
    $title = get_field('honour_title', $page_id);
}

$badge = trim((string) $badge);
$title = trim((string) $title);

if ('' === $badge) {
    $badge = $defaults['badge'];
}
if ('' === $title) {
    $title = $defaults['title'];
}

$cards = psm_get_remembrance_honour_cards($page_id);

$has_badge = '' !== $badge;
$has_title = '' !== $title;
$has_cards = !empty($cards);
$has_header = $has_badge || $has_title;

if (!$has_header && !$has_cards) {
    return;
}

$heading_id = $has_title ? 'psm-remembrance-honour-heading' : '';
?>
<section class="psm-remembrance-honour" id="honouring-service"<?php echo $heading_id ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ''; ?>>
    <div class="container psm-container">
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $heading_id,
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_cards) : ?>
        <div class="psm-remembrance-honour__grid">
            <?php foreach ($cards as $card) : ?>
                <?php
                get_template_part(
                    'template-parts/components/remembrance-card',
                    null,
                    array(
                        'title'      => $card['title'],
                        'paragraphs' => $card['paragraphs'],
                        'image'      => $card['image'],
                        'image_seed' => $card['image_seed'],
                        'image_alt'  => $card['title'],
                    )
                );
                ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
