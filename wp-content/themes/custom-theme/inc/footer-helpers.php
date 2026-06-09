<?php
/**
 * Footer settings helpers (ACF options — defaults live in acf-json only).
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Footer social network CSS modifier class.
 *
 * @param string $network Network slug.
 * @return string
 */
function psm_footer_social_modifier($network) {
    return 'instagram' === sanitize_key($network) ? 'is-instagram' : '';
}

/**
 * Split textarea into non-empty paragraphs.
 *
 * @param string $text Multiline text.
 * @return string[]
 */
function psm_footer_split_paragraphs($text) {
    $text = trim((string) $text);
    if ('' === $text) {
        return array();
    }

    $parts = preg_split('/\r\n|\r|\n\s*\r?\n/', $text);
    if (!is_array($parts)) {
        return array($text);
    }

    return array_values(
        array_filter(
            array_map('trim', $parts),
            static function ($paragraph) {
                return '' !== $paragraph;
            }
        )
    );
}

/**
 * Build footer link list from ACF repeater rows.
 *
 * @param mixed $rows Repeater rows with `title` and `url` sub fields.
 * @return array<int, array{label: string, url: string, target: string}>
 */
function psm_footer_parse_link_rows($rows) {
    $links = array();

    if (!is_array($rows)) {
        return $links;
    }

    foreach ($rows as $row) {
        if (!is_array($row)) {
            continue;
        }

        $title = isset($row['title']) ? trim((string) $row['title']) : '';
        $url   = isset($row['url']) ? trim((string) $row['url']) : '';

        if ('' === $url || '' === $title) {
            continue;
        }

        $links[] = array(
            'label'  => $title,
            'url'    => $url,
            'target' => '',
        );
    }

    return $links;
}

/**
 * Footer settings from ACF options.
 *
 * @return array<string, mixed>
 */
function psm_get_footer_settings() {
    $settings = array(
        'logo_url'       => '',
        'show_social'    => false,
        'social_links'   => array(),
        'show_about'     => false,
        'about_heading'  => '',
        'about_paragraphs' => array(),
        'show_links'     => false,
        'link_columns'   => array(),
        'show_phone'     => false,
        'phone_label'    => '',
        'phone_display'  => '',
        'phone_href'     => '',
        'show_email'     => false,
        'email_label'    => '',
        'email_display'  => '',
        'email_href'     => '',
        'show_subscribe' => false,
        'subscribe_label'    => '',
        'subscribe_shortcode' => '',
        'copyright'      => '',
        'show_legal'     => false,
        'legal_links'  => array(),
    );

    if (!function_exists('get_field')) {
        return $settings;
    }

    $logo = get_field('footer_logo', 'option');
    if (is_array($logo) && !empty($logo['url'])) {
        $settings['logo_url'] = trim((string) $logo['url']);
    } elseif (is_numeric($logo)) {
        $url = wp_get_attachment_image_url((int) $logo, 'full');
        if ($url) {
            $settings['logo_url'] = $url;
        }
    }

    $settings['show_social'] = (bool) get_field('footer_show_social', 'option');
    if ($settings['show_social']) {
        $social_rows = get_field('footer_social_links', 'option');
        if (is_array($social_rows)) {
            foreach ($social_rows as $row) {
                if (!is_array($row)) {
                    continue;
                }

                $network = isset($row['network']) ? sanitize_key((string) $row['network']) : '';
                $url     = isset($row['url']) ? trim((string) $row['url']) : '';

                if ('' === $network || '' === $url) {
                    continue;
                }

                $settings['social_links'][] = array(
                    'id'       => $network,
                    'label'    => isset($row['label']) && '' !== trim((string) $row['label'])
                        ? trim((string) $row['label'])
                        : ucfirst($network),
                    'url'      => $url,
                    'modifier' => psm_footer_social_modifier($network),
                );
            }
        }
    }

    $settings['show_about'] = (bool) get_field('footer_show_about', 'option');
    if ($settings['show_about']) {
        $settings['about_heading']    = trim((string) get_field('footer_about_heading', 'option'));
        $settings['about_paragraphs'] = psm_footer_split_paragraphs(get_field('footer_about_text', 'option'));
    }

    $settings['show_links'] = (bool) get_field('footer_show_link_columns', 'option');
    if ($settings['show_links']) {
        for ($i = 1; $i <= 3; $i++) {
            $heading = trim((string) get_field('footer_col_' . $i . '_heading', 'option'));
            $links   = psm_footer_parse_link_rows(get_field('footer_col_' . $i . '_links', 'option'));

            if ('' === $heading && empty($links)) {
                continue;
            }

            $settings['link_columns'][] = array(
                'heading' => $heading,
                'links'   => $links,
            );
        }
    }

    $settings['show_phone']    = (bool) get_field('footer_show_phone', 'option');
    $settings['phone_label']  = trim((string) get_field('footer_phone_label', 'option'));
    $settings['phone_display'] = trim((string) get_field('footer_phone_number', 'option'));
    if ('' !== $settings['phone_display'] && function_exists('psm_phone_href_from_display')) {
        $settings['phone_href'] = psm_phone_href_from_display($settings['phone_display']);
    }

    $settings['show_email']    = (bool) get_field('footer_show_email', 'option');
    $settings['email_label']   = trim((string) get_field('footer_email_label', 'option'));
    $settings['email_display'] = trim((string) get_field('footer_email_address', 'option'));
    if ('' !== $settings['email_display']) {
        $settings['email_href'] = 'mailto:' . sanitize_email($settings['email_display']);
    }

    $settings['show_subscribe']      = (bool) get_field('footer_show_subscribe', 'option');
    $settings['subscribe_label']     = trim((string) get_field('footer_subscribe_label', 'option'));
    $settings['subscribe_shortcode'] = trim((string) get_field('footer_subscribe_form_shortcode', 'option'));

    $settings['copyright'] = trim((string) get_field('footer_copyright', 'option'));
    $settings['show_legal'] = (bool) get_field('footer_show_legal_links', 'option');
    if ($settings['show_legal']) {
        $settings['legal_links'] = psm_footer_parse_link_rows(get_field('footer_legal_links', 'option'));
    }

    return $settings;
}

/**
 * Site-wide phone number from Footer Settings.
 *
 * @return string
 */
function psm_get_site_phone_display() {
    if (!function_exists('get_field')) {
        return '';
    }

    return trim((string) get_field('footer_phone_number', 'option'));
}

/**
 * tel: link for the site-wide footer phone number.
 *
 * @return string
 */
function psm_get_site_phone_href() {
    $phone = psm_get_site_phone_display();

    if ('' !== $phone && function_exists('psm_phone_href_from_display')) {
        return psm_phone_href_from_display($phone);
    }

    return '';
}

/**
 * Site-wide phone display + tel link.
 *
 * @return array{display: string, href: string}
 */
function psm_get_site_phone() {
    return array(
        'display' => psm_get_site_phone_display(),
        'href'    => psm_get_site_phone_href(),
    );
}

/**
 * Seed footer link column repeaters from default data.
 *
 * @return array{success: bool, message: string, counts: array<string, int>}
 */
function psm_seed_footer_link_columns() {
    if (!function_exists('update_field')) {
        return array(
            'success' => false,
            'message' => 'ACF is not available.',
            'counts'  => array(),
        );
    }

    $data   = require get_template_directory() . '/inc/footer-links-data.php';
    $counts = array();

    if (!is_array($data)) {
        return array(
            'success' => false,
            'message' => 'Footer links data not found.',
            'counts'  => array(),
        );
    }

    foreach ($data as $field_name => $rows) {
        if (!is_array($rows)) {
            continue;
        }

        delete_field($field_name, 'option');
        update_field($field_name, $rows, 'option');

        $saved = get_field($field_name, 'option');
        if (!is_array($saved) || count($saved) !== count($rows)) {
            return array(
                'success' => false,
                'message' => 'Failed to update ' . $field_name . '.',
                'counts'  => $counts,
            );
        }

        $counts[ $field_name ] = count($saved);
    }

    return array(
        'success' => true,
        'message' => 'Footer links seeded successfully.',
        'counts'  => $counts,
    );
}

/**
 * Whether footer brand row has visible content.
 *
 * @param array $settings Footer settings.
 * @return bool
 */
function psm_footer_has_brand_row($settings) {
    return '' !== ($settings['logo_url'] ?? '') || !empty($settings['social_links']);
}
