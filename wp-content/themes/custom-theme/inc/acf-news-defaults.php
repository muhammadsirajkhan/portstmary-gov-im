<?php
/**
 * Default values for Home — News link field (not supported in field group JSON).
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Pre-fill footer button when empty on the home page.
 *
 * @param mixed  $value   Field value.
 * @param int    $post_id Post ID.
 * @param array  $field   ACF field array.
 * @return mixed
 */
function psm_acf_default_news_button($value, $post_id, $field) {
    if (!empty($value) || !function_exists('psm_is_home_news_page') || !psm_is_home_news_page($post_id)) {
        return $value;
    }

    return psm_news_default_button();
}
add_filter('acf/load_value/name=news_button', 'psm_acf_default_news_button', 10, 3);
