<?php
/**
 * Upcoming Events — list cards.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
if (!$page_id && is_front_page()) {
    $page_id = (int) get_option('page_on_front');
}

$badge  = '';
$title  = '';
$intro  = array();
$events = array();
$button = array(
    'url'    => '',
    'title'  => '',
    'target' => '',
);

if ($page_id && function_exists('get_field')) {
    $badge = get_field('events_badge', $page_id);
    $title = get_field('events_title', $page_id);

    $intro_raw = get_field('events_intro', $page_id);
    if (is_string($intro_raw) && '' !== trim($intro_raw)) {
        $intro = array_values(
            array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n\s*\r?\n/', $intro_raw))
            )
        );
    }

    $acf_button = get_field('events_button', $page_id);
    if (is_array($acf_button)) {
        $button = array(
            'url'    => isset($acf_button['url']) ? trim((string) $acf_button['url']) : '',
            'title'  => isset($acf_button['title']) ? trim((string) $acf_button['title']) : '',
            'target' => isset($acf_button['target']) ? trim((string) $acf_button['target']) : '',
        );
    }
}

$event_ids = psm_get_home_event_post_ids($page_id);
foreach ($event_ids as $event_id) {
    $card = psm_get_event_card_args($event_id);
    if (psm_event_card_has_content($card)) {
        $events[] = $card;
    }
}

$badge = trim((string) $badge);
$title = trim((string) $title);

$has_header = '' !== $badge || '' !== $title || !empty($intro);
$has_events = !empty($events);
$has_button = '' !== $button['url'];

$phone_display = '+ (01624) 832101';
$phone_href    = 'tel:+441624832101';

if (!$has_header && !$has_events && !$has_button) {
    return;
}

$section_attrs = 'class="psm-events" id="events"';
if ($title) {
    $section_attrs .= ' aria-labelledby="psm-events-heading"';
}
?>
<section <?php echo $section_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/events-bg.webp'); ?>');">
    <div class="container psm-container" >
        <?php if ($has_header) : ?>
            <?php
            get_template_part(
                'template-parts/components/section-header',
                null,
                array(
                    'badge'      => $badge,
                    'title'      => $title,
                    'heading_id' => $title ? 'psm-events-heading' : '',
                    'intro'      => $intro,
                )
            );
            ?>
        <?php endif; ?>

        <?php if ($has_events) : ?>
            <div class="psm-events__list">
                <?php foreach ($events as $event) : ?>
                    <?php
                    get_template_part(
                        'template-parts/components/event-card',
                        null,
                        $event
                    );
                    ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php
        get_template_part(
            'template-parts/components/section-cta',
            null,
            array(
                'button_text'   => $button['title'],
                'button_url'    => $button['url'],
                'button_target' => $button['target'],
                'phone_display' => $phone_display,
                'phone_href'    => $phone_href,
            )
        );
        ?>
    </div>

    <img
        class="psm-events__birds"
        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/events-birds.svg'); ?>"
        alt=""
        width="120"
        height="48"
        decoding="async"
        aria-hidden="true"
    >
</section>
