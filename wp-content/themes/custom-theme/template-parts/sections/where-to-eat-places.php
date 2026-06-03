<?php
/**
 * Places to Eat — dining venue card grid.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$places = psm_get_where_to_eat_places();
?>
<section class="psm-where-to-eat-places" id="places-to-eat" aria-labelledby="psm-where-to-eat-places-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'       => __('Local Dining', 'cmd-theme'),
                'badge_style' => 'line',
                'title'       => __('Places to Eat', 'cmd-theme'),
                'heading_id'  => 'psm-where-to-eat-places-heading',
                'intro'       => array(
                    __(
                        'Discover cafes, restaurants, and takeaways in and around Port St Mary — perfect for a quick coffee, a relaxed meal, or a convenient takeaway.',
                        'cmd-theme'
                    ),
                ),
                'class'       => 'psm-section-header--where-to-eat-places',
            )
        );
        ?>

        <div class="psm-where-to-eat-places__grid">
            <?php foreach ($places as $index => $place) : ?>
                <?php
                if (empty($place['image'])) {
                    $place['image'] = psm_theme_image('where-to-eat-' . ( $index + 1 ) . '.jpg') ?: '';
                }
                get_template_part('template-parts/components/dining-place-card', null, $place);
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
