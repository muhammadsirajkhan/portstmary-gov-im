<?php

/**

 * Jobs / Careers page template.

 *

 * Template Name: Jobs Page

 *

 * @package CMD_Theme

 */



defined('ABSPATH') || exit;



get_header();

?>



<main id="primary" class="site-main psm-main psm-main--inner psm-page-jobs">

    <?php

    get_template_part(

        'template-parts/sections/inner-banner',

        null,

        array(

            'image'      => psm_theme_image('jobs-banner.jpg'),

            'image_seed' => 'psm-jobs-banner',


        )

    );



    get_template_part('template-parts/sections/jobs-work-with-us');

    get_template_part('template-parts/sections/jobs-how-to-apply');

    get_template_part('template-parts/sections/jobs-opportunities');

    get_template_part(

        'template-parts/sections/news',

        null,

        array(

            'badge' => __('Stay Informed', 'cmd-theme'),

        )

    );

    ?>

</main>



<?php

get_footer();

