<?php
/**
 * Notice of Election — document swiper section.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_election_notice_section($page_id);

if (empty($section['title']) || empty($section['documents'])) {
    return;
}

get_template_part('template-parts/sections/election-documents', null, $section);
