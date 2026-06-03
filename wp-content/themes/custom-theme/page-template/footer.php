<?php
/**
 * Site footer markup.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

get_template_part(
    'template-parts/global/footer-widgets',
    null,
    isset($args) && is_array($args) ? $args : array()
);
wp_footer();
?>
</body>
</html>
