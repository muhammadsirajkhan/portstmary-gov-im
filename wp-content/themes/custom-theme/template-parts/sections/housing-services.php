<?php
/**
 * Housing Services — zigzag rows (venue hire layout).
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$rows    = psm_get_housing_services_rows($page_id);

if (empty($rows)) {
    return;
}
?>
<section class="psm-venue-hire psm-housing-services" id="housing-services-content" aria-label="<?php esc_attr_e('Housing services', 'cmd-theme'); ?>">
    <div class="container psm-container">
        <div class="psm-venue-hire__rows">
            <?php foreach ($rows as $row) : ?>
                <?php get_template_part('template-parts/components/venue-zigzag-row', null, $row); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
