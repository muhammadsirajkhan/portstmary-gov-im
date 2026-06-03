<?php
/**
 * Gallery page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Capturing Community Life intro paragraphs.
 *
 * @return string[]
 */
function psm_get_gallery_community_life_paragraphs() {
    return array(
        __(
            'Our community gallery celebrates life in Port St Mary — from harbour scenes and local events to the people and places that make our town special.',
            'cmd-theme'
        ),
        __(
            'These images capture the spirit of our coastal community and the work of Port St Mary Commissioners in supporting residents and visitors alike.',
            'cmd-theme'
        ),
        __(
            'Browse the featured gallery below for highlights from recent events, projects, and everyday moments across the town.',
            'cmd-theme'
        ),
    );
}

/**
 * Featured gallery masonry items.
 *
 * @return array<int, array{image: string, image_seed: string, alt: string, span: string}>
 */
function psm_get_gallery_featured_items() {
    $items = array(
        array('span' => 'a', 'seed' => 'psm-gallery-1', 'alt' => __('Port St Mary harbor view', 'cmd-theme')),
        array('span' => 'b', 'seed' => 'psm-gallery-2', 'alt' => __('Community event in Port St Mary', 'cmd-theme')),
        array('span' => 'c', 'seed' => 'psm-gallery-3', 'alt' => __('Coastal landscape near Port St Mary', 'cmd-theme')),
        array('span' => 'd', 'seed' => 'psm-gallery-4', 'alt' => __('Town centre and shops', 'cmd-theme')),
        array('span' => 'e', 'seed' => 'psm-gallery-5', 'alt' => __('Harbor boats at Port St Mary', 'cmd-theme')),
        array('span' => 'f', 'seed' => 'psm-gallery-6', 'alt' => __('Community gathering outdoors', 'cmd-theme')),
        array('span' => 'g', 'seed' => 'psm-gallery-7', 'alt' => __('Sunset over Port St Mary bay', 'cmd-theme')),
    );

    foreach ($items as $index => $item) {
        $file = 'gallery-featured-' . ( $index + 1 ) . '.jpg';
        $items[ $index ]['image'] = psm_theme_image($file) ?: '';
        $items[ $index ]['image_seed'] = $item['seed'];
    }

    return $items;
}
