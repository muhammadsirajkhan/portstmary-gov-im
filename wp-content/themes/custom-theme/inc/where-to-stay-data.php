<?php
/**
 * Where to Stay page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Featured Places to Stay section header copy.
 *
 * @return array{badge: string, title: string, intro: string, category: string}
 */
function psm_get_where_to_stay_featured_header() {
    return array(
        'badge'    => __('Port St Mary Commissioners', 'cmd-theme'),
        'title'    => __('Featured Places to Stay', 'cmd-theme'),
        'intro'       => __(
            'Port St Mary benefits from a wide variety of quality accommodation and food establishments including those listed below. This list is not exhaustive, also please see visitisleofman.com',
            'cmd-theme'
        ),
        'category'    => __('Accommodation', 'cmd-theme'),
    );
}

/**
 * Build a website or email link href.
 *
 * @param string $value Display URL or email.
 * @return string
 */
function psm_accommodation_contact_href($value) {
    $value = trim((string) $value);
    if ('' === $value) {
        return '';
    }

    if (false !== strpos($value, '@')) {
        return 'mailto:' . $value;
    }

    if (preg_match('/^https?:\/\//i', $value)) {
        return $value;
    }

    return 'https://' . ltrim($value, '/');
}

/**
 * Accommodation listings.
 *
 * @return array<int, array<string, string>>
 */
function psm_get_where_to_stay_accommodations() {
    $items = array(
        array(
            'title'    => __('Beachcroft', 'cmd-theme'),
            'location' => __('Beach Road, Port St Mary', 'cmd-theme'),
            'phone'    => __('(01624) 834521', 'cmd-theme'),
            'contact'  => 'beachcroft@manx.net',
        ),
        array(
            'title'    => __('Langton Cottage', 'cmd-theme'),
            'location' => __('19 Lime Street, Port St Mary IM9 5EF', 'cmd-theme'),
            'phone'    => __('(01624) 835679', 'cmd-theme'),
            'contact'  => 'www.harboursideholidaycottageisleofman.com',
        ),
        array(
            'title'    => __('Langton House', 'cmd-theme'),
            'location' => __('20 Lime Street, Port St Mary IM9 5EF', 'cmd-theme'),
            'phone'    => __('(01624) 834521', 'cmd-theme'),
            'contact'  => 'www.harboursideholidayhouseisleofman.com',
        ),
        array(
            'title'    => __('Holiday House', 'cmd-theme'),
            'location' => __('7 The Quay, Port St Mary', 'cmd-theme'),
            'phone'    => __('(01624) 834521', 'cmd-theme'),
            'contact'  => '',
        ),
    );

    foreach ($items as $index => $item) {
        $contact = isset($item['contact']) ? (string) $item['contact'] : '';

        $items[ $index ]['phone_href']    = psm_phone_href_from_display($item['phone']);
        $items[ $index ]['contact_href']  = psm_accommodation_contact_href($contact);
        $items[ $index ]['read_more_url'] = $items[ $index ]['contact_href'];
        $items[ $index ]['image']         = '';
        $items[ $index ]['image_seed']    = 'psm-where-to-stay-' . ( $index + 1 );
    }

    return $items;
}
