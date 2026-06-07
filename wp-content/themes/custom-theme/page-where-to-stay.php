<?php
/**
 * Where to Stay page template.
 *
 * Template Name: Where to Stay Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-where-to-stay">
    <?php
    get_template_part('template-parts/sections/inner-banner');

    get_template_part('template-parts/sections/where-to-stay-featured');
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
