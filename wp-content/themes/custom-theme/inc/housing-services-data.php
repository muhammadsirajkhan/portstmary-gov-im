<?php
/**
 * Housing Services page — static zigzag row fallbacks.
 *
 * @package CMD_Theme
 */

defined('ABSPATH') || exit;

/**
 * Default zigzag rows for the Housing Services page.
 *
 * @return array<int, array<string, mixed>>
 */
function psm_housing_services_rows_static() {
    return array(
        array(
            'layout'        => 'image-left',
            'title'         => __('General Public Housing', 'cmd-theme'),
            'heading_id'    => 'psm-housing-general-public',
            'image'         => psm_theme_image('housing-general-public.jpg') ?: '',
            'image_seed'    => 'psm-hs-gp',
            'intro_html'    => psm_housing_paragraphs_to_intro_html(
                array(
                    __(
                        'Port St Mary Commissioners provide general public housing for residents who need affordable, well-maintained homes within the town.',
                        'cmd-theme'
                    ),
                    __(
                        'Our housing team manages allocations, tenancy support, and ongoing maintenance to ensure properties meet the needs of the community.',
                        'cmd-theme'
                    ),
                )
            ),
            'extra_content' => '',
            'features'      => array(),
        ),
        array(
            'layout'        => 'image-right',
            'title'         => __('Applying For a Port St Mary Commissioners Property', 'cmd-theme'),
            'heading_id'    => 'psm-housing-applying-property',
            'image'         => psm_theme_image('housing-apply.jpg') ?: '',
            'image_seed'    => 'psm-hs-apply',
            'intro_html'    => psm_housing_paragraphs_to_intro_html(
                array(
                    __(
                        'To apply for a Commissioners property you must complete an application form and provide supporting documentation for your household.',
                        'cmd-theme'
                    ),
                )
            ),
            'extra_content' => '',
            'features'      => array(
                __('Complete the housing application form in full', 'cmd-theme'),
                __('Provide proof of identity and income', 'cmd-theme'),
                __('Attend an assessment interview if required', 'cmd-theme'),
                __('Receive an offer based on need and availability', 'cmd-theme'),
            ),
        ),
        array(
            'layout'        => 'image-left',
            'title'         => __('Applying For Sheltered Housing', 'cmd-theme'),
            'heading_id'    => 'psm-housing-sheltered',
            'image'         => psm_theme_image('housing-sheltered.jpg') ?: '',
            'image_seed'    => 'psm-hs-sheltered',
            'intro_html'    => psm_housing_paragraphs_to_intro_html(
                array(
                    __(
                        'Sheltered housing provides supported accommodation for older residents and those who need additional assistance to live independently.',
                        'cmd-theme'
                    ),
                    __(
                        'Applications are assessed based on need, eligibility, and the availability of suitable sheltered units in Port St Mary.',
                        'cmd-theme'
                    ),
                    __(
                        'Our team will discuss your circumstances and explain the support available before an allocation is made.',
                        'cmd-theme'
                    ),
                )
            ),
            'extra_content' => '',
            'features'      => array(),
        ),
        array(
            'layout'        => 'image-right',
            'title'         => __('Getting Help in Resolving a Domestic Noise Problem', 'cmd-theme'),
            'heading_id'    => 'psm-housing-noise',
            'image'         => psm_theme_image('housing-noise.jpg') ?: '',
            'image_seed'    => 'psm-hs-noise',
            'intro_html'    => psm_housing_paragraphs_to_intro_html(
                array(
                    __(
                        'If you are affected by domestic noise from a neighbouring property, the Commissioners can help you understand the steps to resolve the issue.',
                        'cmd-theme'
                    ),
                )
            ),
            'extra_content' => '',
            'features'      => array(
                __('Speak to your neighbour and try to resolve the matter informally', 'cmd-theme'),
                __('Contact the Commissioners\' office to report ongoing noise', 'cmd-theme'),
                __('We will advise on mediation or further action where appropriate', 'cmd-theme'),
            ),
        ),
        array(
            'layout'        => 'image-left',
            'title'         => __('Mutual Exchanges', 'cmd-theme'),
            'heading_id'    => 'psm-housing-mutual',
            'image'         => psm_theme_image('housing-mutual.jpg') ?: '',
            'image_seed'    => 'psm-hs-mutual',
            'intro_html'    => psm_housing_paragraphs_to_intro_html(
                array(
                    __(
                        'A mutual exchange allows existing tenants to swap homes with another tenant, subject to approval from the Commissioners.',
                        'cmd-theme'
                    ),
                    __(
                        'Both parties must agree to the exchange and meet the eligibility requirements for the properties involved.',
                        'cmd-theme'
                    ),
                )
            ),
            'extra_content' => '',
            'features'      => array(),
        ),
    );
}
