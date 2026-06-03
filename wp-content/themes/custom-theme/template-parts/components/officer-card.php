<?php
/**
 * Officer profile card.
 *
 * @package CMD_Theme
 *
 * @var array $args {
 *     @type string $name       Officer name.
 *     @type string $role       Role / title line.
 *     @type string $tag        Badge on photo (e.g. Officer).
 *     @type string $image      Portrait URL.
 *     @type string $image_seed Placeholder seed.
 *     @type string $tone       grey|teal|rose — photo block background.
 *     @type string $linkedin   LinkedIn URL.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'name'       => '',
        'role'       => '',
        'tag'        => __('Officer', 'cmd-theme'),
        'image'      => '',
        'image_seed' => 'psm-officer',
        'tone'       => 'grey',
        'linkedin'   => '#',
    )
);

if (!$args['name']) {
    return;
}

$tones = array('grey', 'teal', 'rose');
$tone  = in_array($args['tone'], $tones, true) ? $args['tone'] : 'grey';
$image = $args['image'] ?: psm_placeholder_image(480, 520, $args['image_seed']);
?>
<article class="psm-officer-card psm-officer-card--<?php echo esc_attr($tone); ?>">
    <div class="psm-officer-card__media">
        <img
            class="psm-officer-card__photo"
            src="<?php echo esc_url($image); ?>"
            alt="<?php echo esc_attr($args['name']); ?>"
            width="480"
            height="520"
            loading="lazy"
            decoding="async"
        >
        <span class="psm-officer-card__tag"><?php echo esc_html($args['tag']); ?></span>
        <?php if ($args['linkedin']) : ?>
            <a
                class="psm-officer-card__linkedin"
                href="<?php echo esc_url($args['linkedin']); ?>"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="<?php echo esc_attr(sprintf(/* translators: %s: officer name */ __('LinkedIn profile for %s', 'cmd-theme'), $args['name'])); ?>"
            >
                <span class="psm-officer-card__linkedin-icon" aria-hidden="true">in</span>
            </a>
        <?php endif; ?>
    </div>
    <div class="psm-officer-card__body">
        <h3 class="psm-officer-card__name"><?php echo esc_html($args['name']); ?></h3>
        <?php if ($args['role']) : ?>
            <p class="psm-officer-card__role"><?php echo esc_html($args['role']); ?></p>
        <?php endif; ?>
    </div>
</article>
