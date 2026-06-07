<?php
/**
 * Who We Are page template.
 *
 * Template Name: Who We Are Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-who-we-are">
    <?php
    get_template_part('template-parts/sections/inner-banner');

    get_template_part('template-parts/sections/who-we-are-about');
    get_template_part('template-parts/sections/who-we-are-role');
    get_template_part('template-parts/sections/who-we-are-officers');
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
