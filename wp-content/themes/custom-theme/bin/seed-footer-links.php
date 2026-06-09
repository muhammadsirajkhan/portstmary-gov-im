<?php
/**
 * One-time CLI script to seed footer link column repeaters.
 *
 * Usage (from WordPress root):
 *   php wp-content/themes/custom-theme/bin/seed-footer-links.php
 *
 * @package CMD_Theme
 */

$wp_load = dirname(__DIR__, 4) . '/wp-load.php';

if (!is_readable($wp_load)) {
    fwrite(STDERR, "WordPress bootstrap not found at: {$wp_load}\n");
    exit(1);
}

require $wp_load;

if (!function_exists('psm_seed_footer_link_columns')) {
    fwrite(STDERR, "psm_seed_footer_link_columns() is not available.\n");
    exit(1);
}

$result = psm_seed_footer_link_columns();

if ($result['success']) {
    echo $result['message'] . PHP_EOL;
    foreach ($result['counts'] as $field => $count) {
        echo $field . ': ' . $count . ' rows' . PHP_EOL;
    }
    exit(0);
}

fwrite(STDERR, $result['message'] . PHP_EOL);
exit(1);
