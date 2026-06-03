<?php
/**
 * Southern Sheltered page template.
 *
 * Template Name: Southern Sheltered Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner psm-page-southern-sheltered">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('southern-sheltered-banner.jpg'),
            'image_seed' => 'psm-southern-sheltered-banner',
        )
    );

    get_template_part('template-parts/sections/southern-sheltered-tenders');
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
get_footer();
?>
