<?php
/**
 * Alternating facility row — overlapping card and landscape image.
 *
 * @package CMD_Theme
 *
 * @var array $args Row data from psm_get_amenities_facility_rows().
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
    isset($args) ? $args : array(),
    array(
        'layout'     => 'card-left',
        'title'      => '',
        'text'       => '',
        'list_items' => array(),
        'read_more'  => array(),
        'image'      => '',
        'image_seed' => 'psm-amenities',
    )
);

if (!$args['title']) {
    return;
}

$layout = 'card-right' === $args['layout'] ? 'card-right' : 'card-left';
$image  = $args['image'] ?: psm_placeholder_image(900, 520, $args['image_seed']);
$alt    = $args['title'];
?>
<div class="psm-amenities-facility psm-amenities-facility--<?php echo esc_attr($layout); ?>">
    <div class="psm-amenities-facility__inner">
        <?php
        get_template_part(
            'template-parts/components/amenities-facility-card',
            null,
            array(
                'title'      => $args['title'],
                'text'       => $args['text'],
                'list_items' => $args['list_items'],
                'read_more'  => $args['read_more'],
            )
        );
        ?>
        <div class="psm-amenities-facility__media">
            <img
                class="psm-amenities-facility__image"
                src="<?php echo esc_url($image); ?>"
                alt="<?php echo esc_attr($alt); ?>"
                width="900"
                height="520"
                loading="lazy"
                decoding="async"
            >
        </div>
    </div>
</div>
