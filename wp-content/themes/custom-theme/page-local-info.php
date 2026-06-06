<?php
/**
 * Local Info page template.
 *
 * Template Name: Local Info Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-local-info">
    <?php
    get_template_part('template-parts/sections/inner-banner');

    get_template_part('template-parts/sections/local-info-about');
    get_template_part('template-parts/sections/local-info-timeline');
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
