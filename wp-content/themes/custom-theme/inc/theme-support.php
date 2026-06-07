<?php
/**
 * Theme supports, menus, widgets.
 *
 * @package CMD_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

function psm_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('post-thumbnails');

    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style(
        array(
            'assets/fonts/stylesheet.css',
            'https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap',
            'assets/css/variables.css',
            'assets/css/editor-style.css',
        )
    );

    add_theme_support(
        'custom-logo',
        array(
            'height'      => 120,
            'width'       => 120,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );

    register_nav_menus(
        array(
            'primary_left'  => __('Primary Left', 'cmd-theme'),
            'primary_right' => __('Primary Right', 'cmd-theme'),
            'footer'        => __('Footer Links', 'cmd-theme'),
        )
    );
}
add_action('after_setup_theme', 'psm_theme_setup');

function psm_widgets_init() {
    register_sidebar(
        array(
            'name'          => __('Footer Column 1', 'cmd-theme'),
            'id'            => 'footer-col-1',
            'before_widget' => '<div id="%1$s" class="psm-footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="psm-footer-widget__title">',
            'after_title'   => '</h4>',
        )
    );
    register_sidebar(
        array(
            'name'          => __('Footer Column 2', 'cmd-theme'),
            'id'            => 'footer-col-2',
            'before_widget' => '<div id="%1$s" class="psm-footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="psm-footer-widget__title">',
            'after_title'   => '</h4>',
        )
    );
    register_sidebar(
        array(
            'name'          => __('Footer Column 3', 'cmd-theme'),
            'id'            => 'footer-col-3',
            'before_widget' => '<div id="%1$s" class="psm-footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="psm-footer-widget__title">',
            'after_title'   => '</h4>',
        )
    );
}
add_action('widgets_init', 'psm_widgets_init');

/**
 * Placeholder image URL.
 */
function psm_placeholder_image($width, $height, $seed) {
    $seed = preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $seed);
    return sprintf('https://picsum.photos/seed/%s/%d/%d', $seed, (int) $width, (int) $height);
}

/**
 * Theme image from assets/images if present.
 */
function psm_theme_image($filename) {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    $rel = '/assets/images/' . ltrim($filename, '/');
    if (is_readable($dir . $rel)) {
        return $uri . $rel;
    }
    return '';
}

function psm_body_class_home($classes) {
    if (is_front_page()) {
        $classes[] = 'psm-home';
    }

    if (is_page() && !is_front_page()) {
        $classes[] = 'psm-inner-page';
    }

    if (is_singular('psm_news')) {
        $classes[] = 'psm-inner-page';
        $classes[] = 'psm-page-news-single';
    }

    if (is_singular('psm_event')) {
        $classes[] = 'psm-inner-page';
        $classes[] = 'psm-page-event-single';
    }

    if (is_page_template('page-contact.php')) {
        $classes[] = 'psm-page-contact';
    }

    if (is_page_template('page-foi.php')) {
        $classes[] = 'psm-page-foi';
    }

    if (is_page_template('page-minutes.php')) {
        $classes[] = 'psm-page-minutes';
    }

    return $classes;
}
add_filter('body_class', 'psm_body_class_home');

/**
 * Whether a menu item should show the home icon.
 *
 * @param WP_Post $item Menu item.
 * @return bool
 */
function psm_is_nav_home_item($item) {
    if (!$item instanceof WP_Post || empty($item->url)) {
        return false;
    }

    if (in_array('psm-nav-home', (array) $item->classes, true)) {
        return true;
    }

    $item_url = untrailingslashit((string) $item->url);
    $home_url = untrailingslashit(home_url('/'));

    return $item_url === $home_url;
}

/**
 * Add psm-nav-home to the front-page link in primary menus.
 *
 * @param string[] $classes Menu item classes.
 * @param WP_Post  $item    Menu item.
 * @param stdClass $args    Menu args.
 * @param int      $depth   Depth.
 * @return string[]
 */
function psm_nav_menu_item_classes($classes, $item, $args, $depth) {
    if (0 !== (int) $depth) {
        return $classes;
    }

    $location = isset($args->theme_location) ? $args->theme_location : '';
    if (!in_array($location, array('primary_left', 'primary_right'), true)) {
        return $classes;
    }

    if (psm_is_nav_home_item($item) && !in_array('psm-nav-home', $classes, true)) {
        $classes[] = 'psm-nav-home';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'psm_nav_menu_item_classes', 10, 4);

function psm_fallback_nav_list(array $items, $menu_class, $home_icon = false) {
    $class = trim('psm-nav-list ' . $menu_class);
    echo '<ul class="' . esc_attr($class) . '">';
    foreach ($items as $pair) {
        $children     = (isset($pair[2]) && is_array($pair[2])) ? $pair[2] : array();
        $has_children = !empty($children);
        $is_home      = $home_icon && __('Home', 'cmd-theme') === $pair[0];

        $li_class = $has_children ? 'menu-item-has-children' : '';
        if ($is_home) {
            $li_class = trim($li_class . ' psm-nav-home');
        }
        echo '<li' . ($li_class ? ' class="' . esc_attr($li_class) . '"' : '') . '>';
        echo '<a href="' . esc_url($pair[1]) . '">';
        echo esc_html($pair[0]);
        echo '</a>';

        if ($has_children) {
            echo '<ul class="sub-menu">';
            foreach ($children as $child) {
                echo '<li><a href="' . esc_url($child[1]) . '">' . esc_html($child[0]) . '</a></li>';
            }
            echo '</ul>';
        }

        echo '</li>';
    }
    echo '</ul>';
}

function psm_fallback_nav_list_mobile(array $items, $menu_class, $home_icon = false) {
    $class = trim('psm-mobile-menu ' . $menu_class);
    echo '<ul class="' . esc_attr($class) . '">';
    foreach ($items as $pair) {
        $children     = (isset($pair[2]) && is_array($pair[2])) ? $pair[2] : array();
        $has_children = !empty($children);
        $is_home      = $home_icon && __('Home', 'cmd-theme') === $pair[0];

        echo '<li' . ($has_children ? ' class="menu-item-has-children"' : '') . '>';

        if ($has_children) {
            echo '<div class="psm-mobile-menu__row">';
            echo '<a href="' . esc_url($pair[1]) . '">';
            if ($is_home) {
                echo esc_html($pair[0]);
            } else {
                echo esc_html($pair[0]);
            }
            echo '</a>';
            echo '<button type="button" class="psm-mobile-submenu-toggle" aria-expanded="false" aria-label="' . esc_attr(sprintf(/* translators: %s: menu item */ __('Toggle %s submenu', 'cmd-theme'), $pair[0])) . '">';
            echo '<span class="psm-mobile-submenu-toggle__icon" aria-hidden="true"></span>';
            echo '</button>';
            echo '</div>';
            echo '<ul class="sub-menu">';
            foreach ($children as $child) {
                echo '<li><a href="' . esc_url($child[1]) . '">' . esc_html($child[0]) . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<a href="' . esc_url($pair[1]) . '">' . esc_html($pair[0]) . '</a>';
        }

        echo '</li>';
    }
    echo '</ul>';
}

function psm_fallback_nav_items_left() {
    return array(
        array(__('Home', 'cmd-theme'), home_url('/')),
        array(
            __('Services', 'cmd-theme'),
            home_url('/#services'),
            array(
                array(__('Boat Park', 'cmd-theme'), home_url('/boat-park/')),
                array(__('Consultations', 'cmd-theme'), home_url('/consultations/')),
            ),
        ),
        array(
            __('Community', 'cmd-theme'),
            home_url('/#about'),
            array(
                array(__('Local Info', 'cmd-theme'), home_url('/local-info/')),
                array(__('Where to Eat', 'cmd-theme'), home_url('/where-to-eat/')),
                array(__('Where to Stay', 'cmd-theme'), home_url('/where-to-stay/')),
            ),
        ),
        array(__('Council', 'cmd-theme'), home_url('/#about')),
    );
}

function psm_fallback_nav_items_right() {
    $foi_url     = function_exists('psm_foi_page_url') ? psm_foi_page_url() : home_url('/foi/');
    $minutes_url = function_exists('psm_minutes_page_url') ? psm_minutes_page_url() : home_url('/meeting-minutes/');

    return array(
        array(
            __('Documents', 'cmd-theme'),
            '#',
            array(
                array(__('FOI', 'cmd-theme'), $foi_url),
                array(__('Meeting Minutes', 'cmd-theme'), $minutes_url),
            ),
        ),
        array(
            __('News', 'cmd-theme'),
            home_url('/#news'),
            array(
                array(__('Latest News', 'cmd-theme'), home_url('/#news')),
                array(__('Events', 'cmd-theme'), home_url('/#events')),
            ),
        ),
    );
}

function psm_fallback_nav_left($args) {
    psm_fallback_nav_list(
        psm_fallback_nav_items_left(),
        isset($args['menu_class']) ? (string) $args['menu_class'] : '',
        true
    );
}

function psm_fallback_nav_left_mobile($args) {
    psm_fallback_nav_list_mobile(
        psm_fallback_nav_items_left(),
        isset($args['menu_class']) ? (string) $args['menu_class'] : '',
        true
    );
}

function psm_fallback_nav_right($args) {
    psm_fallback_nav_list(
        psm_fallback_nav_items_right(),
        isset($args['menu_class']) ? (string) $args['menu_class'] : ''
    );
}

function psm_fallback_nav_right_mobile($args) {
    psm_fallback_nav_list_mobile(
        psm_fallback_nav_items_right(),
        isset($args['menu_class']) ? (string) $args['menu_class'] : ''
    );
}

function psm_fallback_nav_footer($args) {
    $items = array(
        array(__('Home', 'cmd-theme'), home_url('/')),
        array(__('About', 'cmd-theme'), home_url('/#about')),
        array(__('Services', 'cmd-theme'), home_url('/#services')),
        array(__('Events', 'cmd-theme'), home_url('/#events')),
        array(__('News', 'cmd-theme'), home_url('/#news')),
        array(__('Contact', 'cmd-theme'), psm_contact_page_url()),
    );
    psm_fallback_nav_list($items, isset($args['menu_class']) ? (string) $args['menu_class'] : 'psm-footer-links');
}
