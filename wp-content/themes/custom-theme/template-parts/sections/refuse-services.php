<?php
/**
 * Refuse Services — alternating zigzag content blocks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$rows    = psm_get_refuse_services_rows($page_id);

if (empty($rows)) {
    return;
}
?>
<section class="psm-refuse-services" id="refuse-services-content" aria-label="<?php esc_attr_e('Refuse services', 'cmd-theme'); ?>">
    <?php foreach ($rows as $row) : ?>
        <?php get_template_part('template-parts/components/refuse-zigzag-row', null, $row); ?>
    <?php endforeach; ?>
</section>
