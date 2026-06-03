<?php

/**

 * Work With Us — single image + copy + benefits.

 *

 * @package CMD_Theme

 */



defined('ABSPATH') || exit;



$page_id = (int) get_queried_object_id();

$section = psm_get_jobs_work_with_us_section($page_id);



$image          = trim((string) $section['image']);

$badge          = trim((string) $section['badge']);

$title          = trim((string) $section['title']);

$lead           = trim((string) $section['lead']);

$body           = trim((string) $section['body']);

$benefits_intro = trim((string) $section['benefits_intro']);

$benefits       = array_values(array_filter((array) $section['benefits']));



$has_image  = '' !== $image;

$has_header = '' !== $badge || '' !== $title;

$has_lead   = '' !== $lead;

$has_body   = '' !== $body;

$has_intro  = '' !== $benefits_intro;

$has_list   = !empty($benefits);



if (!$has_image && !$has_header && !$has_lead && !$has_body && !$has_intro && !$has_list) {

    return;

}



$image_alt = $title ?: __('Work with Port St Mary Commissioners', 'cmd-theme');

?>

<section class="psm-jobs-work" id="work-with-us"<?php echo $title ? ' aria-labelledby="psm-jobs-work-heading"' : ''; ?>>

    <div class="container psm-container">

        <div class="psm-jobs-work__grid psm-about__grid">

            <?php if ($has_image) : ?>

                <?php

                get_template_part(

                    'template-parts/components/housing-zigzag-media',

                    null,

                    array(

                        'variant'    => 'single-badge',

                        'show_badge' => false,

                        'image'      => $image,

                        'image_seed' => 'psm-jobs-work',

                        'accent'     => 'tl',

                        'alt'        => $image_alt,

                    )

                );

                ?>

            <?php endif; ?>



            <div class="psm-jobs-work__content psm-about__content">

                <?php if ($has_header) : ?>

                    <?php

                    get_template_part(

                        'template-parts/components/section-header',

                        null,

                        array(

                            'badge'      => $badge,

                            'title'      => $title,

                            'heading_id' => $title ? 'psm-jobs-work-heading' : '',

                            'align'      => 'left',

                            'class'      => 'psm-section-header--southern-sheltered',

                        )

                    );

                    ?>

                <?php endif; ?>



                <?php if ($has_lead) : ?>

                    <p class="psm-about__lead"><?php echo esc_html($lead); ?></p>

                <?php endif; ?>



                <?php if ($has_body) : ?>

                    <div class="psm-jobs-work__prose psm-venue-zigzag__prose">

                        <p><?php echo esc_html($body); ?></p>

                    </div>

                <?php endif; ?>



                <?php if ($has_intro) : ?>

                    <p class="psm-jobs-work__benefits-intro"><?php echo esc_html($benefits_intro); ?></p>

                <?php endif; ?>



                <?php if ($has_list) : ?>

                    <?php

                    get_template_part(

                        'template-parts/components/housing-check-list',

                        null,

                        array(

                            'items' => $benefits,

                        )

                    );

                    ?>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>

