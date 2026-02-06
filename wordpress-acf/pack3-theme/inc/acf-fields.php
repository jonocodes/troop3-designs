<?php
/**
 * ACF Field Group Definitions
 *
 * Registers all field groups programmatically so they ship with the theme.
 * The editor sees these as labeled form fields when editing pages.
 *
 * Requires: Advanced Custom Fields (free) plugin.
 */

defined('ABSPATH') || exit;

add_action('acf/include_fields', function() {

    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // =========================================================================
    // HOME PAGE FIELDS
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_home_hero',
        'title' => 'Hero Section',
        'fields' => array(
            array(
                'key' => 'field_hero_badge_text',
                'label' => 'Badge Text',
                'name' => 'hero_badge_text',
                'type' => 'text',
                'default_value' => 'Registration Always Open',
                'instructions' => 'The small orange pill at the top of the hero.',
            ),
            array(
                'key' => 'field_hero_title',
                'label' => 'Title',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Albany Cub Scouts Pack 3',
                'instructions' => 'Main headline.',
            ),
            array(
                'key' => 'field_hero_subtitle',
                'label' => 'Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'text',
                'default_value' => 'Are you ready for more s\'mores, skits, badges, and outdoor fun?',
                'instructions' => 'Gold text below the title.',
            ),
            array(
                'key' => 'field_hero_description',
                'label' => 'Description',
                'name' => 'hero_description',
                'type' => 'textarea',
                'default_value' => 'Albany Pack 3 is back in action for 2025-2026! We\'re an inclusive pack welcoming all kids in Kindergarten through Fifth Grade.',
                'rows' => 3,
                'instructions' => 'Short paragraph below the subtitle.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-home.php',
                ),
            ),
        ),
        'menu_order' => 0,
    ));

    // =========================================================================
    // MEETING INFO
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_meeting_info',
        'title' => 'Meeting Info',
        'fields' => array(
            array(
                'key' => 'field_meeting_day',
                'label' => 'Meeting Day',
                'name' => 'meeting_day',
                'type' => 'text',
                'default_value' => 'First Thursday of each month',
            ),
            array(
                'key' => 'field_meeting_time',
                'label' => 'Meeting Time',
                'name' => 'meeting_time',
                'type' => 'text',
                'default_value' => '6:30 PM - 8:00 PM',
            ),
            array(
                'key' => 'field_meeting_location',
                'label' => 'Venue Name',
                'name' => 'meeting_location',
                'type' => 'text',
                'default_value' => 'Veterans Memorial Hall',
            ),
            array(
                'key' => 'field_meeting_address',
                'label' => 'Venue Address',
                'name' => 'meeting_address',
                'type' => 'text',
                'default_value' => '1325 Portland Avenue',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-home.php',
                ),
            ),
        ),
        'menu_order' => 5,
    ));

    // =========================================================================
    // FAQ FIELDS (fixed slots, 1-8)
    // =========================================================================
    $faq_fields = array();
    $faq_icons = array(
        'people' => 'People',
        'question' => 'Question Mark',
        'dollar' => 'Dollar Sign',
        'clock' => 'Clock',
        'star' => 'Star',
        'shield' => 'Shield',
        'heart' => 'Heart',
        'info' => 'Info',
    );

    for ($i = 1; $i <= 8; $i++) {
        $faq_fields[] = array(
            'key' => 'field_faq_' . $i . '_heading',
            'label' => 'FAQ ' . $i,
            'name' => '',
            'type' => 'message',
            'message' => '<strong>FAQ Item ' . $i . '</strong> — Leave the question blank to skip this slot.',
        );
        $faq_fields[] = array(
            'key' => 'field_faq_' . $i . '_question',
            'label' => 'Question',
            'name' => 'faq_' . $i . '_question',
            'type' => 'text',
            'wrapper' => array('width' => '70'),
        );
        $faq_fields[] = array(
            'key' => 'field_faq_' . $i . '_icon',
            'label' => 'Icon',
            'name' => 'faq_' . $i . '_icon',
            'type' => 'select',
            'choices' => $faq_icons,
            'default_value' => 'question',
            'wrapper' => array('width' => '30'),
        );
        $faq_fields[] = array(
            'key' => 'field_faq_' . $i . '_answer',
            'label' => 'Answer',
            'name' => 'faq_' . $i . '_answer',
            'type' => 'wysiwyg',
            'media_upload' => 0,
            'toolbar' => 'basic',
            'tabs' => 'visual',
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_faqs',
        'title' => 'FAQs',
        'fields' => $faq_fields,
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-home.php',
                ),
            ),
        ),
        'menu_order' => 10,
    ));

    // =========================================================================
    // ACTIVITY CARDS (fixed slots, 1-6)
    // =========================================================================
    $activity_fields = array();

    for ($i = 1; $i <= 6; $i++) {
        $activity_fields[] = array(
            'key' => 'field_activity_' . $i . '_heading',
            'label' => 'Activity ' . $i,
            'name' => '',
            'type' => 'message',
            'message' => '<strong>Activity Card ' . $i . '</strong> — Leave the title blank to skip this slot.',
        );
        $activity_fields[] = array(
            'key' => 'field_activity_' . $i . '_title',
            'label' => 'Title',
            'name' => 'activity_' . $i . '_title',
            'type' => 'text',
            'wrapper' => array('width' => '50'),
        );
        $activity_fields[] = array(
            'key' => 'field_activity_' . $i . '_when',
            'label' => 'When',
            'name' => 'activity_' . $i . '_when',
            'type' => 'text',
            'wrapper' => array('width' => '25'),
            'instructions' => 'e.g. "January (Sunday)"',
        );
        $activity_fields[] = array(
            'key' => 'field_activity_' . $i . '_where',
            'label' => 'Where',
            'name' => 'activity_' . $i . '_where',
            'type' => 'text',
            'wrapper' => array('width' => '25'),
            'instructions' => 'e.g. "Veterans Memorial Building"',
        );
        $activity_fields[] = array(
            'key' => 'field_activity_' . $i . '_description',
            'label' => 'Description',
            'name' => 'activity_' . $i . '_description',
            'type' => 'textarea',
            'rows' => 2,
        );
        $activity_fields[] = array(
            'key' => 'field_activity_' . $i . '_image',
            'label' => 'Photo',
            'name' => 'activity_' . $i . '_image',
            'type' => 'image',
            'return_format' => 'url',
            'preview_size' => 'medium',
            'instructions' => 'Recommended: landscape orientation, at least 800px wide.',
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_activities',
        'title' => 'Activity Cards',
        'fields' => $activity_fields,
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-home.php',
                ),
            ),
        ),
        'menu_order' => 8,
    ));

    // =========================================================================
    // ABOUT PAGE FIELDS
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_about_story',
        'title' => 'Our Story',
        'fields' => array(
            array(
                'key' => 'field_about_heading',
                'label' => 'Heading',
                'name' => 'about_heading',
                'type' => 'text',
                'default_value' => 'Albany Pack 3 has a long and proud history of service to Albany\'s youth',
            ),
            array(
                'key' => 'field_about_content',
                'label' => 'Story Content',
                'name' => 'about_content',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 1,
                'default_value' => '<p>Pack 3 is chartered by the American Legion Post 292 of Albany and is part of the Herms District of the Golden Gate Council, Boy Scouts of America.</p><p>We are an inclusive pack that represents the diversity of our community. We are strongly committed to creating a welcoming environment for all children who wish to join our Pack.</p><p>We are proud to be designated as an <strong>Inclusive Unit by Scouts for Equality</strong> and our leaders wear the "Scouts for Equality" badge on their uniforms.</p>',
            ),
            array(
                'key' => 'field_about_quote',
                'label' => 'Highlight Quote',
                'name' => 'about_quote',
                'type' => 'text',
                'default_value' => 'Serving Albany\'s youth and community since 1935.',
            ),
            array(
                'key' => 'field_about_image',
                'label' => 'Photo',
                'name' => 'about_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-about.php',
                ),
            ),
        ),
        'menu_order' => 0,
    ));

});
