<?php
/**
 * Contact page template.
 *
 * Template Name: Contact Page
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main psm-main psm-main--inner">
    <?php
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'image'      => psm_theme_image('contact.webp'),
            'image_seed' => 'psm-contact-banner',
        )
    );

    get_template_part('template-parts/sections/contact');
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
