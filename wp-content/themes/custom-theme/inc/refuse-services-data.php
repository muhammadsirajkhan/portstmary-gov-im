<?php
/**
 * Refuse Services page — static zigzag row fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default zigzag rows for the Refuse Services page.
 *
 * @return array<int, array<string, mixed>>
 */
function psm_refuse_services_rows_static() {
    return array(
        array(
            'layout'        => 'image-left',
            'background'    => 'white',
            'title'         => __('Keeping Port St Mary Clean & Sustainable', 'cmd-theme'),
            'heading_id'    => 'psm-refuse-clean-sustainable',
            'media'         => array(
                'image'      => psm_theme_image('refuse-clean-sustainable.jpg') ?: '',
                'image_seed' => 'psm-refuse-clean-sustainable',
                'accent'     => 'tl',
            ),
            'intro_html'    => psm_housing_paragraphs_to_intro_html(
                array(
                    __(
                        'The Southern Civic Amenity Site, South Quay, Port St Mary, is provided in conjunction with the Department of Infrastructure.',
                        'cmd-theme'
                    ),
                )
            ) . '<p>' . sprintf(
                /* translators: %s: SCAS website link */
                __(
                    'Service charges are payable for some waste streams and can be found on the SCAS website: %s',
                    'cmd-theme'
                ),
                '<a href="https://scas.im" target="_blank" rel="noopener noreferrer">scas.im</a>'
            ) . '</p>',
            'opening_times' => array(
                'title'       => __('Opening Times', 'cmd-theme'),
                'rows'        => array(
                    array(
                        'label' => __('(as at 12th August 2021)', 'cmd-theme'),
                        'value' => __('Daily: 10.00 to 4.00', 'cmd-theme'),
                    ),
                ),
                'note'        => __('Gate shuts 10 minutes before closure time', 'cmd-theme'),
                'closed_note' => __(
                    'Closed: Public Holidays — Christmas Day, New Year\'s Day, Easter Sunday, T.T. Bank Holiday — and any other unscheduled closures at Port Staff\'s discretion.',
                    'cmd-theme'
                ),
            ),
        ),
        array(
            'layout'     => 'image-right',
            'background' => 'grey',
            'title'      => __('Helping Keep Port St Mary Clean', 'cmd-theme'),
            'heading_id' => 'psm-refuse-helping-clean',
            'media'      => array(
                'image'      => psm_theme_image('refuse-harbor.jpg') ?: '',
                'image_seed' => 'psm-refuse-harbor',
                'accent'     => 'tr',
            ),
            'intro_html' => psm_housing_paragraphs_to_intro_html(
                array(
                    __(
                        'There is no local recycling service for fridges and freezer units, large electricals, or batteries. Such items should be taken to the Southern Civic Amenity Site as detailed in the section above.',
                        'cmd-theme'
                    ),
                    __(
                        'We cannot accept any cooking oil for recycling. It should be disposed of in the standard household waste bin, but not poured down the sink.',
                        'cmd-theme'
                    ),
                    __(
                        'Small electrical items and batteries can also be taken to the Southern Civic Amenity Site for safe disposal.',
                        'cmd-theme'
                    ),
                )
            ),
            'subheading' => __('Beach Clean Waste', 'cmd-theme'),
            'extra_html' => psm_housing_paragraphs_to_intro_html(
                array(
                    __(
                        'Where organised beach cleans take place, additional waste facilities may be available. Please contact the Commissioners\' office for details of upcoming events and temporary collection points.',
                        'cmd-theme'
                    ),
                )
            ),
        ),
    );
}
