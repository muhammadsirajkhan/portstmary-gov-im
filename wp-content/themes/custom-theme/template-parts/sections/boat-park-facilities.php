<?php
/**
 * Boat Park Facilities — icon cards + feature image.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$facilities   = psm_get_boat_park_facilities();
$feature_image = psm_theme_image('boat-park-pier.jpg') ?: psm_placeholder_image(1200, 520, 'psm-boat-park-pier');
?>
<section class="psm-boat-park-facilities" id="boat-park-facilities" aria-labelledby="psm-boat-park-facilities-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'       => __('Harbour Facilities', 'cmd-theme'),
                'badge_style' => 'red',
                'title'       => __('Boat Park Facilities', 'cmd-theme'),
                'heading_id'  => 'psm-boat-park-facilities-heading',
                'intro'       => array(
                    __(
                        'Our boat park provides essential facilities for mooring, access, and harbour use in Port St Mary.',
                        'cmd-theme'
                    ),
                ),
                'class'       => 'psm-section-header--boat-park-facilities',
            )
        );
        ?>

        <div class="psm-boat-park-facilities__grid">
            <?php foreach ($facilities as $facility) : ?>
                <?php get_template_part('template-parts/components/facility-icon-card', null, $facility); ?>
            <?php endforeach; ?>
        </div>

        <img
            class="psm-boat-park-facilities__feature"
            src="<?php echo esc_url($feature_image); ?>"
            alt="<?php esc_attr_e('Stone pier and lighthouse at Port St Mary boat park', 'cmd-theme'); ?>"
            width="1200"
            height="520"
            loading="lazy"
            decoding="async"
        >
    </div>
</section>
