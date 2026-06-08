<?php
/**
 * Climate Change page template.
 *
 * Template Name: Climate Change Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-climate-change">
    <?php
    get_template_part('template-parts/sections/inner-banner');

    get_template_part('template-parts/sections/climate-change-commitment');
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
