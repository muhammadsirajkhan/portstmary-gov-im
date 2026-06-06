<?php
/**
 * Community Gallery page template.
 *
 * Template Name: Gallery Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-gallery">
    <?php
    get_template_part('template-parts/sections/inner-banner');

    get_template_part('template-parts/sections/gallery-community-life');
    get_template_part('template-parts/sections/gallery-featured');
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
