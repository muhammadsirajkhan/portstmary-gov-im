<?php
/**
 * Gallery page — layout helpers.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Featured gallery image slot order (maps repeater index to layout key).
 *
 * @return string[]
 */
function psm_gallery_featured_image_slot_keys() {
    return array('a', 'b', 'e', 'c', 'f', 'd', 'g', 'h');
}

/**
 * Featured gallery slot size map.
 *
 * @return array<string, string>
 */
function psm_gallery_featured_item_sizes() {
    return array(
        'a' => 'portrait',
        'b' => 'landscape',
        'c' => 'landscape-lg',
        'd' => 'landscape-lg',
        'e' => 'landscape',
        'f' => 'landscape',
        'g' => 'portrait',
        'h' => 'portrait',
    );
}

/**
 * Empty featured gallery items keyed by layout slot.
 *
 * @return array<string, array{image: string, image_seed: string, alt: string, size: string}>
 */
function psm_gallery_featured_items_empty() {
    $items = array();

    foreach (psm_gallery_featured_item_sizes() as $key => $size) {
        $items[ $key ] = array(
            'image'      => '',
            'image_seed' => '',
            'alt'        => '',
            'size'       => $size,
        );
    }

    return $items;
}

/**
 * Build featured gallery columns from keyed items.
 *
 * @param array<string, array{image: string, image_seed: string, alt: string, size: string}> $items Keyed gallery items.
 * @return array<int, array{items: array<int, array<string, mixed>>}>
 */
function psm_build_gallery_featured_columns(array $items) {
    return array(
        array(
            'items' => array(
                array(
                    'type'  => 'row',
                    'items' => array(
                        $items['a'],
                        $items['b'],
                    ),
                ),
                $items['e'],
            ),
        ),
        array(
            'items' => array(
                $items['c'],
                $items['f'],
            ),
        ),
        array(
            'items' => array(
                $items['d'],
                array(
                    'type'  => 'row',
                    'items' => array(
                        $items['g'],
                        $items['h'],
                    ),
                ),
            ),
        ),
    );
}

/**
 * Remove gallery column items that have no image.
 *
 * @param array<int, array{items: array<int, array<string, mixed>>}> $columns Gallery columns.
 * @return array<int, array{items: array<int, array<string, mixed>>}>
 */
function psm_filter_gallery_featured_columns(array $columns) {
    $filtered_columns = array();

    foreach ($columns as $column) {
        $column_items = isset($column['items']) && is_array($column['items']) ? $column['items'] : array();
        $items        = array();

        foreach ($column_items as $item) {
            if (!empty($item['type']) && 'row' === $item['type']) {
                $row_items = array();

                foreach ((array) ( $item['items'] ?? array() ) as $sub_item) {
                    if (!empty($sub_item['image'])) {
                        $row_items[] = $sub_item;
                    }
                }

                if (!empty($row_items)) {
                    $items[] = array(
                        'type'  => 'row',
                        'items' => $row_items,
                    );
                }

                continue;
            }

            if (!empty($item['image'])) {
                $items[] = $item;
            }
        }

        if (!empty($items)) {
            $filtered_columns[] = array('items' => $items);
        }
    }

    return $filtered_columns;
}
