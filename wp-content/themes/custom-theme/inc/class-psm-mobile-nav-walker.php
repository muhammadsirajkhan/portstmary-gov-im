<?php
/**
 * Mobile navigation walker with expandable sub-menus.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

class PSM_Mobile_Nav_Walker extends Walker_Nav_Menu {

    /**
     * @param string $output Nav output.
     * @param int    $depth  Depth.
     * @param mixed  $args   Menu args.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n{$indent}<ul class=\"sub-menu\">\n";
    }

    /**
     * @param string   $output Nav output.
     * @param WP_Post  $item   Menu item.
     * @param int      $depth  Depth.
     * @param stdClass $args   Menu args.
     * @param int      $id     Item id.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = $depth ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $has_children = in_array('menu-item-has-children', $classes, true);

        $class_names = implode(' ', array_map('sanitize_html_class', array_filter($classes)));
        $output     .= $indent . '<li class="' . esc_attr($class_names) . '">';

        $atts           = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if ('' === $value) {
                continue;
            }
            $value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
            $attributes .= ' ' . $attr . '="' . $value . '"';
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        if (0 === $depth && $has_children) {
            $output .= '<div class="psm-mobile-menu__row">';
            $output .= '<a' . $attributes . '>' . esc_html($title) . '</a>';
            $output .= '<button type="button" class="psm-mobile-submenu-toggle" aria-expanded="false" aria-label="' . esc_attr(sprintf(/* translators: %s: menu item */ __('Toggle %s submenu', 'cmd-theme'), $title)) . '">';
            $output .= '<span class="psm-mobile-submenu-toggle__icon" aria-hidden="true"></span>';
            $output .= '</button>';
            $output .= '</div>';
            return;
        }

        $output .= '<a' . $attributes . '>' . esc_html($title) . '</a>';
    }

    /**
     * @param string   $output Nav output.
     * @param WP_Post  $item   Menu item.
     * @param int      $depth  Depth.
     * @param stdClass $args   Menu args.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}
