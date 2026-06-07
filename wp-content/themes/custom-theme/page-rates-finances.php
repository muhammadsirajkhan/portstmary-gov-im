<?php
/**
 * Rates & Finances page template.
 *
 * Template Name: Rates & Finances Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-rates-finances">
    <?php
    get_template_part('template-parts/sections/inner-banner');

    get_template_part('template-parts/sections/rates-village-rates');
    get_template_part('template-parts/sections/rates-financial-statements');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'background' => 'white',
        )
    );
    ?>
</main>

<?php
get_footer(
    null,
    array(
        'variant' => 'white',
    )
);

