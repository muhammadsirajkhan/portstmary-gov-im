<?php
/**
 * Venue Hire — zigzag Town Hall / Board Room rows.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$rows    = psm_get_venue_hire_rows($page_id);

if (empty($rows)) {
    return;
}
?>
<section class="psm-venue-hire" id="venue-hire" aria-label="<?php esc_attr_e('Venue hire', 'cmd-theme'); ?>">
    <div class="container psm-container">
        <div class="psm-venue-hire__rows">
            <?php foreach ($rows as $row) : ?>
                <?php get_template_part('template-parts/components/venue-zigzag-row', null, $row); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
