<?php
/**
 * Rates & Finances page content.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Village rates body paragraphs.
 *
 * @return string[]
 */
function psm_get_rates_village_rates_paragraphs() {
    return array(
        __(
            'Port St Mary Commissioners set and collect village rates to fund local services, maintain public amenities, and support community facilities for residents.',
            'cmd-theme'
        ),
        __(
            'Rates are calculated annually and reflect the cost of delivering services such as refuse collection, public spaces, harbourside upkeep, and other statutory responsibilities.',
            'cmd-theme'
        ),
        __(
            'If you have questions about your rate notice, payment options, or how funds are allocated, our office team can provide guidance and copies of relevant information.',
            'cmd-theme'
        ),
    );
}

/**
 * Financial statement PDF labels (two columns).
 *
 * @return array<int, string[]>
 */
function psm_get_rates_financial_statement_columns() {
    return array(
        array(
            __('Financial Statement for the Year Ended 31st March 2024', 'cmd-theme'),
            __('Financial Statement for the Year Ended 31st March 2023', 'cmd-theme'),
            __('Financial Statement for the Year Ended 31st March 2022', 'cmd-theme'),
            __('Financial Statement for the Year Ended 31st March 2021', 'cmd-theme'),
            __('Financial Statement for the Year Ended 31st March 2020', 'cmd-theme'),
            __('Financial Statement for the Year Ended 31st March 2019', 'cmd-theme'),
            __('Financial Statement for the Year Ended 31st March 2018', 'cmd-theme'),
        ),
        array(
            __('Audited Accounts for the Year Ended 31st March 2024', 'cmd-theme'),
            __('Audited Accounts for the Year Ended 31st March 2023', 'cmd-theme'),
            __('Audited Accounts for the Year Ended 31st March 2022', 'cmd-theme'),
            __('Audited Accounts for the Year Ended 31st March 2021', 'cmd-theme'),
            __('Audited Accounts for the Year Ended 31st March 2020', 'cmd-theme'),
            __('Audited Accounts for the Year Ended 31st March 2019', 'cmd-theme'),
            __('Audited Accounts for the Year Ended 31st March 2018', 'cmd-theme'),
        ),
    );
}

/**
 * Financial statements section intro lines.
 *
 * @return string[]
 */
function psm_get_rates_financial_statements_intro() {
    return array(
        __(
            'Download audited accounts and annual financial statements published by Port St Mary Commissioners.',
            'cmd-theme'
        ),
        __(
            'These documents provide transparency on income, expenditure, and how public funds are managed on behalf of the community.',
            'cmd-theme'
        ),
    );
}
