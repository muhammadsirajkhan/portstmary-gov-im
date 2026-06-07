<?php
/**
 * Board Mission Statement page template.
 *
 * Template Name: Board Mission Statement Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-mission-statement">
    <?php
    get_template_part('template-parts/sections/inner-banner');

    get_template_part('template-parts/sections/mission-statement-commitment');
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
