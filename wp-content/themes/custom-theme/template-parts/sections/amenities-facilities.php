<?php
/**
 * Community Spaces & Facilities — overlapping card rows.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$rows = psm_get_amenities_facility_rows();
?>
<section class="psm-amenities-facilities" id="community-spaces-facilities" aria-labelledby="psm-amenities-facilities-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'       => __('Port St Mary Commissioners', 'cmd-theme'),
                'badge_style' => 'pill',
                'title'       => __('Community Spaces & Facilities', 'cmd-theme'),
                'title_dot'   => 'period',
                'heading_id'  => 'psm-amenities-facilities-heading',
                'class'       => 'psm-section-header--amenities-facilities',
            )
        );
        ?>

        <div class="psm-amenities-facilities__rows">
            <?php foreach ($rows as $index => $row) : ?>
                <?php if ($index > 0) : ?>
                    <div class="psm-amenities-facilities__divider" aria-hidden="true">
                        <span class="psm-amenities-facilities__divider-mark"></span>
                        <?php get_template_part('template-parts/components/welcome-badge'); ?>
                        <span class="psm-amenities-facilities__divider-mark"></span>
                    </div>
                <?php endif; ?>
                <?php get_template_part('template-parts/components/amenities-facility-row', null, $row); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
