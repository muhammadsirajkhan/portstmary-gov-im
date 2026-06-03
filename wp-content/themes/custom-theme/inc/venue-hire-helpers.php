<?php
/**
 * Venue hire page helpers.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Split textarea into line items.
 *
 * @param mixed $raw Raw field value.
 * @return string[]
 */
function psm_split_acf_lines($raw) {
    if (!is_string($raw) || '' === trim($raw)) {
        return array();
    }

    return array_values(
        array_filter(
            array_map('trim', preg_split('/\r\n|\r|\n/', $raw))
        )
    );
}

/**
 * Default inner banner values for the venue hire page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_venue_hire_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('Our Venue Hire', 'cmd-theme'),
        'ribbon' => __('Host Your Next Gathering', 'cmd-theme'),
        'intro'  => __(
            'Hire the Town Hall or Board Room for meetings, events, and community gatherings in the heart of Port St Mary.',
            'cmd-theme'
        ),
    );
}

/**
 * Default venue hire zigzag rows.
 *
 * @return array<int, array{layout: string, title: string, heading_id: string, image: string, image_seed: string, paragraphs: string[], features: string[]}>
 */
function psm_venue_hire_rows_static() {
    return array(
        array(
            'layout'     => 'image-left',
            'title'      => __('Town Hall Hire', 'cmd-theme'),
            'heading_id' => 'psm-venue-town-hall-heading',
            'image'      => psm_theme_image('venue-town-hall.jpg') ?: '',
            'image_seed' => 'psm-venue-town-hall',
            'paragraphs' => array(
                __(
                    'The Town Hall is a distinctive circular venue in the heart of Port St Mary, ideal for community events, celebrations, and larger gatherings.',
                    'cmd-theme'
                ),
                __(
                    'With flexible layouts and a central location, it provides a welcoming space for residents, groups, and organisations hosting memorable occasions.',
                    'cmd-theme'
                ),
                __(
                    'Contact the Commissioners\' office to discuss availability, setup options, and hire arrangements for your event.',
                    'cmd-theme'
                ),
            ),
            'features'   => array(
                __('Spacious Event Area', 'cmd-theme'),
                __('Flexible Seating Layouts', 'cmd-theme'),
                __('Accessible Facilities', 'cmd-theme'),
                __('Community Event Space', 'cmd-theme'),
                __('Suitable for Large Gatherings', 'cmd-theme'),
            ),
        ),
        array(
            'layout'     => 'image-right',
            'title'      => __('Board Room Hire', 'cmd-theme'),
            'heading_id' => 'psm-venue-board-room-heading',
            'image'      => psm_theme_image('venue-board-room.jpg') ?: '',
            'image_seed' => 'psm-venue-board-room',
            'paragraphs' => array(
                __(
                    'The Board Room offers a professional setting for meetings, training sessions, and smaller private events within the Commissioners\' offices.',
                    'cmd-theme'
                ),
                __(
                    'Equipped for presentations and discussion, it is well suited to committees, local groups, and businesses needing a quiet, accessible meeting space.',
                    'cmd-theme'
                ),
                __(
                    'Enquire about half-day or full-day hire, seating layouts, and any support you may need for your meeting or seminar.',
                    'cmd-theme'
                ),
            ),
            'features'   => array(
                __('Professional Meeting Space', 'cmd-theme'),
                __('Comfortable Seating', 'cmd-theme'),
                __('Presentation-Friendly Environment', 'cmd-theme'),
                __('Suitable for Small Groups', 'cmd-theme'),
                __('Quiet & Private Setting', 'cmd-theme'),
            ),
        ),
    );
}

/**
 * Venue hire rows from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array{layout: string, title: string, heading_id: string, image: string, image_seed: string, paragraphs: string[], features: string[]}>
 */
function psm_get_venue_hire_rows($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('venue_rows', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $items = array();
            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $title = isset($row['venue_row_title']) ? trim((string) $row['venue_row_title']) : '';
                if ('' === $title) {
                    continue;
                }

                $image = '';
                if (isset($row['venue_row_image'])) {
                    $image = psm_normalize_acf_image_url($row['venue_row_image']);
                }

                $paragraphs = array();
                if (isset($row['venue_row_intro'])) {
                    $paragraphs = psm_split_acf_paragraphs($row['venue_row_intro']);
                }

                $features = array();
                if (isset($row['venue_row_features'])) {
                    $features = psm_split_acf_lines($row['venue_row_features']);
                }

                $slug = sanitize_title($title);
                if ('' === $slug) {
                    $slug = 'row-' . (int) $index;
                }

                $items[] = array(
                    'layout'     => 0 === (int) $index % 2 ? 'image-left' : 'image-right',
                    'title'      => $title,
                    'heading_id' => 'psm-venue-' . $slug . '-heading',
                    'image'      => $image,
                    'image_seed' => 'psm-venue-row-' . (int) $index,
                    'paragraphs' => $paragraphs,
                    'features'   => $features,
                );
            }

            if (!empty($items)) {
                return $items;
            }
        }
    }

    return psm_venue_hire_rows_static();
}
