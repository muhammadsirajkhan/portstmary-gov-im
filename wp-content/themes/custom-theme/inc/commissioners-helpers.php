<?php
/**
 * Commissioners page helpers.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Default inner banner values for the commissioners page.
 *
 * @return array{kicker: string, title: string, ribbon: string, intro: string}
 */
function psm_commissioners_inner_banner_defaults() {
    return array(
        'kicker' => __('Welcome to the Port St Mary Commissioners', 'cmd-theme'),
        'title'  => __('The Commissioners', 'cmd-theme'),
        'ribbon' => __('Proudly Serving Our Community Since 1890', 'cmd-theme'),
        'intro'  => __(
            'Meet the team behind Port St Mary Commissioners and discover how we serve residents through local services, facilities, and community support.',
            'cmd-theme'
        ),
    );
}

/**
 * Default Serving Port St Mary section values.
 *
 * @return array{badge: string, title: string, intro: string, responsible: string, image: string}
 */
function psm_commissioners_serving_defaults() {
    return array(
        'badge'       => __('Commissioners', 'cmd-theme'),
        'title'       => __('Serving Port St Mary Since 1890', 'cmd-theme'),
        'intro'       => __(
            'The Board of Port St Mary Commissioners has represented the Village District of Port St Mary since its formation 1890. The Board consists of seven members who are elected by public vote every four years, with the next election due in 2029.',
            'cmd-theme'
        ),
        'responsible' => __('Port St Mary Commissioners are responsible for:-', 'cmd-theme'),
        'image'       => psm_theme_image('commissioners-serving.jpg') ?: psm_theme_image('commissioners-main.jpg') ?: '',
    );
}

/**
 * Default Our Officers section header values.
 *
 * @return array{badge: string, title: string}
 */
function psm_commissioners_officers_header_defaults() {
    return array(
        'badge' => __('Officers', 'cmd-theme'),
        'title' => __('Our Officers', 'cmd-theme'),
    );
}

/**
 * Default Opening Hours section values.
 *
 * @return array{badge: string, title: string, note: string}
 */
function psm_commissioners_hours_defaults() {
    return array(
        'badge' => __('Working Hours', 'cmd-theme'),
        'title' => __('Opening Hours', 'cmd-theme'),
        'note'  => __('Closed for lunch between 13.00 – 14.00 daily', 'cmd-theme'),
    );
}

/**
 * Serving section data from ACF or defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, intro: string, responsible: string, image: string, services: string[]}
 */
function psm_get_commissioners_serving($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $defaults = psm_commissioners_serving_defaults();
    $data     = $defaults;
    $services = array();

    if ($page_id && function_exists('get_field')) {
        $badge = get_field('serving_badge', $page_id);
        $title = get_field('serving_title', $page_id);
        $intro = get_field('serving_intro', $page_id);
        $resp  = get_field('serving_responsible', $page_id);
        $image = get_field('serving_image', $page_id);
        $raw   = get_field('serving_services', $page_id);

        if (is_string($badge) && '' !== trim($badge)) {
            $data['badge'] = trim($badge);
        }
        if (is_string($title) && '' !== trim($title)) {
            $data['title'] = trim($title);
        }
        if (is_string($intro) && '' !== trim($intro)) {
            $data['intro'] = trim($intro);
        }
        if (is_string($resp) && '' !== trim($resp)) {
            $data['responsible'] = trim($resp);
        }

        $image_url = psm_normalize_acf_image_url($image);
        if ('' !== $image_url) {
            $data['image'] = $image_url;
        }

        $services = psm_split_acf_lines($raw);
    }

    if (empty($services)) {
        $services = psm_commissioners_services_static();
    }

    $data['services'] = $services;

    return $data;
}

/**
 * Officer profiles from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, string>>
 */
function psm_get_commissioners_officers($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('officers_rows', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $static = psm_commissioners_officers_static();
            $items  = array();
            foreach ($rows as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                $name = isset($row['officer_name']) ? trim((string) $row['officer_name']) : '';
                if ('' === $name) {
                    continue;
                }

                $fallback = isset($static[ $index ]) ? $static[ $index ] : array();

                $role = isset($row['officer_role']) ? trim((string) $row['officer_role']) : '';
                $tone = isset($row['officer_tone']) ? trim((string) $row['officer_tone']) : '';
                $link = isset($row['officer_linkedin']) ? trim((string) $row['officer_linkedin']) : '';

                if ('' === $role && isset($fallback['role'])) {
                    $role = $fallback['role'];
                }

                $image = '';
                if (isset($row['officer_image'])) {
                    $image = psm_normalize_acf_image_url($row['officer_image']);
                }
                if ('' === $image && isset($fallback['image'])) {
                    $image = $fallback['image'];
                }

                $tones = array('grey', 'teal', 'rose');
                if (!in_array($tone, $tones, true)) {
                    $tone = isset($fallback['tone']) && in_array($fallback['tone'], $tones, true)
                        ? $fallback['tone']
                        : 'grey';
                }

                if ('' === $link && isset($fallback['linkedin'])) {
                    $link = $fallback['linkedin'];
                }

                $image_seed = isset($fallback['image_seed']) ? $fallback['image_seed'] : 'psm-officer-' . (int) $index;

                $items[] = array(
                    'name'       => $name,
                    'role'       => $role,
                    'tag'        => __('Officer', 'cmd-theme'),
                    'image'      => $image,
                    'image_seed' => $image_seed,
                    'tone'       => $tone,
                    'linkedin'   => $link,
                );
            }

            if (!empty($items)) {
                return $items;
            }
        }
    }

    return psm_commissioners_officers_static();
}

/**
 * Our Officers section header from ACF or defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string}
 */
function psm_get_commissioners_officers_header($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $defaults = psm_commissioners_officers_header_defaults();
    $data     = $defaults;

    if ($page_id && function_exists('get_field')) {
        $badge = get_field('officers_badge', $page_id);
        $title = get_field('officers_title', $page_id);

        if (is_string($badge) && '' !== trim($badge)) {
            $data['badge'] = trim($badge);
        }
        if (is_string($title) && '' !== trim($title)) {
            $data['title'] = trim($title);
        }
    }

    return $data;
}

/**
 * Opening hours rows from ACF or static defaults.
 *
 * @param int $page_id Page ID.
 * @return array<int, array<string, mixed>>
 */
function psm_get_commissioners_opening_hours($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $today = strtolower(wp_date('l'));

    if ($page_id && function_exists('get_field')) {
        $rows = get_field('hours_rows', $page_id);
        if (is_array($rows) && !empty($rows)) {
            $items = array();
            foreach ($rows as $row) {
                if (!is_array($row)) {
                    continue;
                }

                $label = isset($row['hours_day']) ? trim((string) $row['hours_day']) : '';
                $hours = isset($row['hours_time']) ? trim((string) $row['hours_time']) : '';
                if ('' === $label || '' === $hours) {
                    continue;
                }

                $slug = sanitize_title($label);
                if ('' === $slug) {
                    $slug = strtolower($label);
                }

                $items[] = array(
                    'slug'     => $slug,
                    'label'    => $label,
                    'hours'    => $hours,
                    'is_today' => ($today === $slug),
                );
            }

            if (!empty($items)) {
                return $items;
            }
        }
    }

    return psm_commissioners_opening_hours_static();
}

/**
 * Opening Hours section header and note from ACF or defaults.
 *
 * @param int $page_id Page ID.
 * @return array{badge: string, title: string, note: string}
 */
function psm_get_commissioners_hours_section($page_id = 0) {
    if (!$page_id) {
        $page_id = (int) get_queried_object_id();
    }

    $defaults = psm_commissioners_hours_defaults();
    $data     = $defaults;

    if ($page_id && function_exists('get_field')) {
        $badge = get_field('hours_badge', $page_id);
        $title = get_field('hours_title', $page_id);
        $note  = get_field('hours_note', $page_id);

        if (is_string($badge) && '' !== trim($badge)) {
            $data['badge'] = trim($badge);
        }
        if (is_string($title) && '' !== trim($title)) {
            $data['title'] = trim($title);
        }
        if (is_string($note) && '' !== trim($note)) {
            $data['note'] = trim($note);
        }
    }

    return $data;
}

/**
 * Services list for Serving Port St Mary section.
 *
 * @param int $page_id Page ID.
 * @return string[]
 */
function psm_get_commissioners_services($page_id = 0) {
    $serving = psm_get_commissioners_serving($page_id);
    return isset($serving['services']) ? (array) $serving['services'] : psm_commissioners_services_static();
}
