<?php
/**
 * Header settings helpers (ACF options — defaults live in acf-json only).
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Social network slug to topbar icon asset key.
 *
 * @param string $network Network slug.
 * @return string
 */
function psm_header_social_icon_key($network) {
    $map = array(
        'facebook'  => 'h2',
        'twitter'   => 'h3',
        'x'         => 'h3',
        'youtube'   => 'h4',
        'linkedin'  => 'h5',
        'instagram' => 'h6',
        'tiktok'    => 'h7',
    );

    $network = sanitize_key($network);

    return isset($map[ $network ]) ? $map[ $network ] : '';
}

/**
 * Normalise ACF link field for header CTA.
 *
 * @param mixed $link ACF link value.
 * @return array{url: string, title: string, target: string}
 */
function psm_header_normalise_link($link) {
    if (!is_array($link)) {
        return array(
            'url'    => '',
            'title'  => '',
            'target' => '',
        );
    }

    return array(
        'url'    => isset($link['url']) ? trim((string) $link['url']) : '',
        'title'  => isset($link['title']) ? trim((string) $link['title']) : '',
        'target' => isset($link['target']) ? trim((string) $link['target']) : '',
    );
}

/**
 * Header settings from ACF options.
 *
 * @return array{
 *     show_topbar: bool,
 *     email_label: string,
 *     email: string,
 *     social_label: string,
 *     social_links: array<int, array{network: string, url: string, label: string, icon: string}>,
 *     logo_url: string,
 *     show_cta: bool,
 *     cta: array{url: string, title: string, target: string}
 * }
 */
function psm_get_header_settings() {
    $settings = array(
        'show_topbar'  => false,
        'email_label'  => '',
        'email'        => '',
        'social_label' => '',
        'social_links' => array(),
        'logo_url'     => '',
        'show_cta'     => false,
        'cta'          => array(
            'url'    => '',
            'title'  => '',
            'target' => '',
        ),
    );

    if (!function_exists('get_field')) {
        return $settings;
    }

    $settings['show_topbar']  = (bool) get_field('header_show_topbar', 'option');
    $settings['email_label']  = trim((string) get_field('header_email_label', 'option'));
    $settings['email']        = trim((string) get_field('header_email', 'option'));
    $settings['social_label'] = trim((string) get_field('header_social_label', 'option'));
    $settings['show_cta']     = (bool) get_field('header_show_cta', 'option');
    $settings['cta']          = psm_header_normalise_link(get_field('header_cta_link', 'option'));

    $logo = get_field('header_logo', 'option');
    if (is_array($logo) && !empty($logo['url'])) {
        $settings['logo_url'] = trim((string) $logo['url']);
    } elseif (is_numeric($logo)) {
        $url = wp_get_attachment_image_url((int) $logo, 'full');
        if ($url) {
            $settings['logo_url'] = $url;
        }
    } elseif (is_string($logo) && '' !== trim($logo)) {
        $settings['logo_url'] = trim($logo);
    }

    $rows = get_field('header_social_links', 'option');
    if (is_array($rows)) {
        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $network = isset($row['network']) ? sanitize_key((string) $row['network']) : '';
            $url     = isset($row['url']) ? trim((string) $row['url']) : '';
            $icon    = psm_header_social_icon_key($network);

            if ('' === $network || '' === $url || '' === $icon) {
                continue;
            }

            $settings['social_links'][] = array(
                'network' => $network,
                'url'     => $url,
                'label'   => isset($row['label']) ? trim((string) $row['label']) : ucfirst($network),
                'icon'    => $icon,
            );
        }
    }

    return $settings;
}

/**
 * Whether the top bar should render with any visible content.
 *
 * @param array $settings Header settings.
 * @return bool
 */
function psm_header_has_topbar($settings) {
    if (empty($settings['show_topbar'])) {
        return false;
    }

    return '' !== ($settings['email'] ?? '')
        || !empty($settings['social_links']);
}
