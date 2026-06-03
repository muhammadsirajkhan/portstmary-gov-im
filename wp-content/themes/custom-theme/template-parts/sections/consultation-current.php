<?php
/**
 * Current Consultations — horizontal card grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$consultations = psm_get_current_consultations();
?>
<section class="psm-consultation-current" id="current-consultations" aria-labelledby="psm-consultation-current-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'       => __('View Our Active Projects', 'cmd-theme'),
                'badge_style' => 'red',
                'title'       => __('Current Consultations', 'cmd-theme'),
                'heading_id'  => 'psm-consultation-current-heading',
                'intro'       => array(
                    __(
                        'Browse active consultations and share your views on projects and proposals currently open for comment.',
                        'cmd-theme'
                    ),
                ),
                'class'       => 'psm-section-header--consultation-current',
            )
        );
        ?>

        <div class="psm-consultation-current__grid">
            <?php foreach ($consultations as $item) : ?>
                <?php get_template_part('template-parts/components/consultation-card', null, $item); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
