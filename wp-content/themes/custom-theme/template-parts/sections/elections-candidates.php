<?php
/**
 * Candidates — copy, link, contact + video image.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id    = (int) get_queried_object_id();
$content    = psm_get_election_candidates_content($page_id);
$modal_id   = 'psm-elections-candidates-video';
$badge      = trim((string) $content['badge']);
$title      = trim((string) $content['title']);
$lead       = trim((string) $content['lead']);
$image      = trim((string) $content['image']);
$video_id   = trim((string) $content['video_id']);
$link_url   = trim((string) $content['link_url']);
$phone      = trim((string) $content['phone']);
$email      = trim((string) $content['email']);
$phone_href = psm_phone_href_from_display($phone);

$has_header = '' !== $badge || '' !== $title;
$has_lead   = '' !== $lead;
$has_media  = '' !== $image || '' !== $video_id;
$has_link   = '' !== $link_url;
$has_phone  = '' !== $phone;
$has_email  = '' !== $email;

if (!$has_header && !$has_lead && !$has_link && !$has_phone && !$has_email && !$has_media) {
    return;
}
?>
<section class="psm-elections-candidates" id="election-candidates" <?php echo $title ? ' aria-labelledby="psm-elections-candidates-heading"' : ''; ?>>
    <div class="container psm-container">
        <div class="psm-elections-candidates__grid psm-about__grid">
            <div class="psm-elections-candidates__content psm-about__content">
                <?php if ($has_header) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/section-header',
                        null,
                        array(
                            'badge'       => $badge,
                            'badge_style' => 'pill',
                            'title'       => $title,
                            'heading_id'  => $title ? 'psm-elections-candidates-heading' : '',
                            'align'       => 'left',
                            'class'       => 'psm-section-header--elections-candidates',
                        )
                    );
                    ?>
                <?php endif; ?>

                <?php if ($has_lead) : ?>
                    <p class="psm-about__lead"><?php echo esc_html($lead); ?></p>
                <?php endif; ?>

                <?php if ($has_link) : ?>
                    <p class="psm-elections-candidates__link-wrap">
                        <a class="psm-elections-candidates__link" href="<?php echo esc_url($link_url); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html($link_url); ?>
                        </a>
                    </p>
                <?php endif; ?>

                <?php if ($has_phone || $has_email) : ?>
                    <ul class="psm-elections-candidates__contact">
                        <?php if ($has_phone) : ?>
                            <li class="psm-elections-candidates__contact-item">
                                <span class="psm-elections-candidates__contact-icon psm-elections-candidates__contact-icon--phone" aria-hidden="true"></span>
                                <span class="psm-elections-candidates__contact-text">
                                    <?php esc_html_e('Tel:', 'cmd-theme'); ?>
                                    <?php if ($phone_href) : ?>
                                        <a href="<?php echo esc_url($phone_href); ?>"><?php echo esc_html($phone); ?></a>
                                    <?php else : ?>
                                        <?php echo esc_html($phone); ?>
                                    <?php endif; ?>
                                </span>
                            </li>
                        <?php endif; ?>
                        <?php if ($has_email) : ?>
                            <li class="psm-elections-candidates__contact-item">
                                <span class="psm-elections-candidates__contact-icon psm-elections-candidates__contact-icon--email" aria-hidden="true"></span>
                                <span class="psm-elections-candidates__contact-text">
                                    <?php esc_html_e('Email:', 'cmd-theme'); ?>
                                    <strong><a href="<?php echo esc_url('mailto:' . sanitize_email($email)); ?>"><?php echo esc_html($email); ?></a></strong>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <?php if ($has_media) : ?>
                <?php
                get_template_part(
                    'template-parts/components/video-play-media',
                    null,
                    array(
                        'image'      => $image,
                        'image_seed' => 'psm-election-candidate',
                        'alt'        => $title ?: __('Candidate at a voting booth', 'cmd-theme'),
                        'modal_id'   => '' !== $video_id ? $modal_id : '',
                        'play_label' => __('Play Video', 'cmd-theme'),
                    )
                );
                ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if ('' !== $video_id) : ?>
        <?php
        get_template_part(
            'template-parts/components/video-modal',
            null,
            array(
                'id'       => $modal_id,
                'video_id' => $video_id,
                'title'    => __('Election candidates video', 'cmd-theme'),
            )
        );
        ?>
    <?php endif; ?>
</section>
