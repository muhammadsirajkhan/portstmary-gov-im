<?php
/**
 * 2025 General Election Results — document grid section.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

$page_id = (int) get_queried_object_id();
$section = psm_get_election_results_section($page_id);

if (empty($section['title']) || empty($section['documents'])) {
    return;
}

get_template_part('template-parts/sections/election-documents', null, $section);
