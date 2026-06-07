<?php
/**
 * Default ACF repeater values for the Who We Are page.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default role rows when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @return mixed
 */
function psm_acf_who_we_are_role_rows_default($value, $post_id) {
    if (!psm_is_who_we_are_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return array(
        array(
            'who_we_are_role_row_layout'    => 'image-left',
            'who_we_are_role_row_accent'      => 'tl',
            'who_we_are_role_row_body'        => "Port St Mary Commissioners provide a range of local services that support everyday life in the village. From maintaining public spaces and local facilities to delivering housing services, our work helps ensure Port St Mary remains a welcoming place to live and visit.\r\nWe work on behalf of residents to manage local services, facilities, and community initiatives across the village.",
            'who_we_are_role_row_highlight'   => 'Our goal is to ensure local decision-making remains open, transparent, and connected to the people who live and work within Port St Mary.',
        ),
        array(
            'who_we_are_role_row_layout'    => 'image-right',
            'who_we_are_role_row_accent'      => 'br',
            'who_we_are_role_row_body'        => "Through local decision-making and community engagement, we aim to maintain a safe, attractive, and well-managed environment for everyone who lives in or visits Port St Mary.\r\nWe are committed to serving residents transparently and working collaboratively with the local community to deliver services that meet local needs.",
            'who_we_are_role_row_highlight'   => '',
        ),
    );
}

/**
 * Default officers when empty.
 *
 * @param mixed $value   Field value.
 * @param int   $post_id Post ID.
 * @return mixed
 */
function psm_acf_who_we_are_officers_rows_default($value, $post_id) {
    if (!psm_is_who_we_are_page($post_id)) {
        return $value;
    }

    if (is_array($value) && !empty($value)) {
        return $value;
    }

    return array(
        array(
            'who_we_are_officer_name'  => 'Hayley Kinvig',
            'who_we_are_officer_role'  => 'Clerk & Responsible Finance Officer',
            'who_we_are_officer_tone'  => 'grey',
            'who_we_are_officer_linkedin' => '#',
        ),
        array(
            'who_we_are_officer_name'  => 'Darleen Greenwood',
            'who_we_are_officer_role'  => 'Assistant Clerk',
            'who_we_are_officer_tone'  => 'teal',
            'who_we_are_officer_linkedin' => '#',
        ),
        array(
            'who_we_are_officer_name'  => 'Sally-Ann Maiden',
            'who_we_are_officer_role'  => 'Administrative Officer',
            'who_we_are_officer_tone'  => 'rose',
            'who_we_are_officer_linkedin' => '#',
        ),
    );
}

add_filter('acf/load_value/name=who_we_are_role_rows', 'psm_acf_who_we_are_role_rows_default', 10, 2);
add_filter('acf/load_value/name=who_we_are_officers_rows', 'psm_acf_who_we_are_officers_rows_default', 10, 2);
