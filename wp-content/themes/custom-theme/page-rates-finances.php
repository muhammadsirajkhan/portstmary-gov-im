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
    get_template_part(
        'template-parts/sections/inner-banner',
        null,
        array(
            'kicker'     => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
            'title'      => __('Rates & Finances', 'cmd-theme'),
            'ribbon'     => __('Access Audited Accounts & Financial Reports', 'cmd-theme'),
            'intro'      => __(
                'View village rates information and download audited accounts and financial statements for Port St Mary Commissioners.',
                'cmd-theme'
            ),
            'image'      => psm_theme_image('rates-finances-banner.jpg'),
            'image_seed' => 'psm-rates-finances-banner',
            'heading_id' => 'psm-rates-finances-page-title',
            'breadcrumb' => array(
                array(
                    'label' => __('Home', 'cmd-theme'),
                    'url'   => home_url('/'),
                ),
                array(
                    'label' => __('Rates & Finances', 'cmd-theme'),
                    'url'   => '',
                ),
            ),
        )
    );

    get_template_part('template-parts/sections/rates-village-rates');
    get_template_part('template-parts/sections/rates-financial-statements');
    get_template_part(
        'template-parts/sections/news',
        null,
        array(
            'badge'       => __('Our Latest News', 'cmd-theme'),
            'badge_style' => 'pill',
        )
    );
    ?>
</main>

<?php
get_footer();
