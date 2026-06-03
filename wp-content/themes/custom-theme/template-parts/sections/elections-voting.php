<?php
/**
 * Voting — centered image and resource link.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$image = psm_theme_image('election-voting.jpg') ?: psm_placeholder_image(1000, 520, 'psm-election-voting');
?>
<section class="psm-elections-voting" id="election-voting" aria-labelledby="psm-elections-voting-heading">
    <div class="container psm-container">
        <?php
        get_template_part(
            'template-parts/components/section-header',
            null,
            array(
                'badge'       => __('Elections', 'cmd-theme'),
                'badge_style' => 'red',
                'title'       => __('Voting', 'cmd-theme'),
                'heading_id'  => 'psm-elections-voting-heading',
                'intro'       => array(
                    __(
                        'Find out how to cast your vote, polling station information, and what to expect on election day in Port St Mary.',
                        'cmd-theme'
                    ),
                ),
                'class'       => 'psm-section-header--elections-voting',
            )
        );
        ?>

        <img
            class="psm-elections-voting__image"
            src="<?php echo esc_url($image); ?>"
            alt="<?php esc_attr_e('Voter with I Voted sticker', 'cmd-theme'); ?>"
            width="1000"
            height="520"
            loading="lazy"
            decoding="async"
        >

        <p class="psm-elections-voting__link-wrap">
            <a class="psm-elections-voting__link" href="#"><?php esc_html_e('View voting information', 'cmd-theme'); ?></a>
        </p>
    </div>
</section>
