<?php
/**
 * One-time CLI script to seed FOI page ACF document repeater rows.
 *
 * Usage (from WordPress root):
 *   php wp-content/themes/custom-theme/bin/seed-foi-documents.php
 *
 * @package CMD_Theme
 */

$wp_load = dirname(__DIR__, 4) . '/wp-load.php';

if (!is_readable($wp_load)) {
    fwrite(STDERR, "WordPress bootstrap not found at: {$wp_load}\n");
    exit(1);
}

require $wp_load;

if (!function_exists('psm_seed_foi_documents')) {
    fwrite(STDERR, "psm_seed_foi_documents() is not available.\n");
    exit(1);
}

$result = psm_seed_foi_documents();

if ($result['success']) {
    echo $result['message'] . PHP_EOL;
    echo 'Page ID: ' . $result['page_id'] . PHP_EOL;
    echo 'Rows seeded: ' . $result['row_count'] . PHP_EOL;
    exit(0);
}

fwrite(STDERR, $result['message'] . PHP_EOL);
if (!empty($result['page_id'])) {
    fwrite(STDERR, 'Page ID: ' . $result['page_id'] . PHP_EOL);
}
exit(1);
