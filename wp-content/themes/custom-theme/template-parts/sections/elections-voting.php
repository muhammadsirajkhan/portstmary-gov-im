<?php
/**
 * Voting — centered image and resource link.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$content = psm_get_election_voting_content($page_id);

$badge    = trim((string) $content['badge']);
$title    = trim((string) $content['title']);
$intro    = trim((string) $content['intro']);
$link     = trim((string) $content['link_url']);
$image    = trim((string) $content['image']);

$has_header = '' !== $badge || '' !== $title || '' !== $intro;
$has_image  = '' !== $image;
$has_link   = '' !== $link;

if (!$has_header && !$has_image && !$has_link) {
    return;
}

if (!$has_image) {
    $image = psm_placeholder_image(1000, 520, 'psm-election-voting');
}
?>
<section class="psm-elections-voting" id="election-voting" <?php echo $title ? ' aria-labelledby="psm-elections-voting-heading"' : ''; ?>>
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
                    'heading_id'  => $title ? 'psm-elections-voting-heading' : '',
                    'intro'       => '' !== $intro ? array($intro) : array(),
                    'class'       => 'psm-section-header--elections-voting',
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_image) : ?>
            <img
                class="psm-elections-voting__image"
                src="<?php echo esc_url($image); ?>"
                alt="<?php echo esc_attr($title ?: __('Voter with I Voted sticker', 'cmd-theme')); ?>"
                width="1000"
                height="520"
                loading="lazy"
                decoding="async"
            >
        <?php endif; ?>

        <?php if ($has_link) : ?>
            <p class="psm-elections-voting__link-wrap">
                <a class="psm-elections-voting__link" href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer">
                    <?php echo esc_html($link); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</section>
