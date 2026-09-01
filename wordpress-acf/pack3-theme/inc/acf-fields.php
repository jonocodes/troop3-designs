<?php
/**
 * ACF Field Group Definitions
 *
 * Registers all field groups programmatically so they ship with the theme.
 * The editor sees these as labeled form fields when editing the Home / About pages.
 *
 * Every section of the home page is editable here: hero, quick links, welcome,
 * organization + dens, activities, why-scouting, FAQs. SVG icons, colors, and
 * layout stay in the templates (design, not content).
 *
 * Requires: Advanced Custom Fields (free) plugin.
 */

defined('ABSPATH') || exit;

add_action('acf/include_fields', function() {

    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // --- tiny builders to keep this readable -------------------------------
    $T = function($name, $label, $default = '', $width = 100, $instr = '') {
        return array(
            'key' => 'field_' . $name, 'label' => $label, 'name' => $name,
            'type' => 'text', 'default_value' => $default,
            'wrapper' => array('width' => $width), 'instructions' => $instr,
        );
    };
    $TA = function($name, $label, $default = '', $rows = 3) {
        return array(
            'key' => 'field_' . $name, 'label' => $label, 'name' => $name,
            'type' => 'textarea', 'default_value' => $default, 'rows' => $rows,
        );
    };
    $IMG = function($name, $label, $instr = 'Leave blank to use the default photo.') {
        return array(
            'key' => 'field_' . $name, 'label' => $label, 'name' => $name,
            'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium',
            'instructions' => $instr,
        );
    };
    $MSG = function($id, $label, $message) {
        return array(
            'key' => 'field_msg_' . $id, 'label' => $label, 'name' => '',
            'type' => 'message', 'message' => $message,
        );
    };
    // Location: pages using the Home template.
    $loc_home = array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'page-home.php')));
    // Show ACF fields ABOVE the (unused) content box, positioned high.
    $pos = 'acf_after_title';

    // =========================================================================
    // 0. HERO
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_home_hero',
        'title' => '1. Hero',
        'fields' => array(
            $T('hero_badge_text', 'Badge Text', 'Registration Always Open', 100, 'The small orange pill at the top of the hero.'),
            $T('hero_title', 'Title', 'Albany Cub Scouts Pack 3'),
            $T('hero_subtitle', 'Subtitle', "Are you ready for more s'mores, skits, badges, and outdoor fun?"),
            $TA('hero_description', 'Description', "Albany Pack 3 is back in action for 2025-2026! We're an inclusive pack welcoming all kids in Kindergarten through Fifth Grade.", 3),
            $T('hero_btn1_label', 'Primary Button', 'Join Pack 3', 50),
            $T('hero_btn2_label', 'Secondary Button', 'About Cub Scouts', 50),
        ),
        'location' => $loc_home, 'position' => $pos, 'menu_order' => 0,
    ));

    // =========================================================================
    // 2. QUICK LINKS (4 cards)
    // =========================================================================
    $ql_defaults = array(
        1 => array('Our Team', 'Meet the Pack 3 leadership team and volunteers.'),
        2 => array('Registration', 'Learn about membership fees and how to join.'),
        3 => array('Activities', 'Explore our events, campouts, and adventures.'),
        4 => array('Scouting FAQs', 'Common questions about Cub Scouts answered.'),
    );
    $ql_fields = array();
    foreach ($ql_defaults as $i => $d) {
        $ql_fields[] = $MSG('ql_' . $i, 'Card ' . $i, '<strong>Quick Link Card ' . $i . '</strong>');
        $ql_fields[] = $T('ql_' . $i . '_title', 'Title', $d[0], 40);
        $ql_fields[] = $T('ql_' . $i . '_desc', 'Description', $d[1], 60);
        $ql_fields[] = $IMG('ql_' . $i . '_image', 'Background Photo');
    }
    acf_add_local_field_group(array(
        'key' => 'group_quick_links', 'title' => '2. Quick Links',
        'fields' => $ql_fields, 'location' => $loc_home, 'position' => $pos, 'menu_order' => 2,
    ));

    // =========================================================================
    // 3. WELCOME / ABOUT
    // =========================================================================
    $welcome_body = "<p>Albany Cub Scouts are kids in kindergarten through fifth grade who join a pack to go hiking, play games, learn skills, make friends, and much, much more.</p>\n"
        . "<p><strong>Cub Scouting means \"doing\".</strong> You have lots to do as a Cub Scout—hiking, camping, crafts, games, sports, songs, stories, and puzzles, to name just a few things. Much of the fun happens right in the den and pack.</p>\n"
        . "<p>Scouts also participate in events like the annual Blue and Gold banquet, the Pinewood Derby, an Egg Drop, and our Pancake Breakfast. Whatever it is that you enjoy, you'll have a chance to do it in Cub Scouting!</p>";
    $val_defaults = array(
        1 => array('Character', 'Building strong moral values'),
        2 => array('Citizenship', 'Community responsibility'),
        3 => array('Fitness', 'Healthy active lifestyles'),
        4 => array('Leadership', 'Developing future leaders'),
    );
    $welcome_fields = array(
        $T('welcome_label', 'Eyebrow Label', 'Welcome to Albany Cub Scouts Pack 3'),
        $T('welcome_heading_lead', 'Heading (start)', 'Are you ready for more', 50),
        $T('welcome_heading_accent', 'Heading (green part)', "s'mores, skits, badges, and outdoor fun?", 50),
        array(
            'key' => 'field_welcome_body', 'label' => 'Body Text', 'name' => 'welcome_body',
            'type' => 'wysiwyg', 'default_value' => $welcome_body, 'toolbar' => 'basic',
            'media_upload' => 0, 'tabs' => 'visual',
        ),
        $T('welcome_quote', 'Highlight Quote', "Albany Pack 3 has a long and proud history of service to Albany's youth and to the community as a whole."),
        $IMG('welcome_image', 'Photo'),
    );
    foreach ($val_defaults as $i => $d) {
        $welcome_fields[] = $T('value_' . $i . '_title', 'Value ' . $i . ' Title', $d[0], 50);
        $welcome_fields[] = $T('value_' . $i . '_desc', 'Value ' . $i . ' Text', $d[1], 50);
    }
    acf_add_local_field_group(array(
        'key' => 'group_welcome', 'title' => '3. Welcome / About',
        'fields' => $welcome_fields, 'location' => $loc_home, 'position' => $pos, 'menu_order' => 3,
    ));

    // =========================================================================
    // 5. MEETING INFO (used in Organization + footer)
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_meeting_info', 'title' => '5. Meeting Info',
        'fields' => array(
            $T('meeting_day', 'Meeting Day', 'First Thursday of each month', 50),
            $T('meeting_time', 'Meeting Time', '6:30 PM - 8:00 PM', 50),
            $T('meeting_location', 'Venue Name', 'Veterans Memorial Hall', 50),
            $T('meeting_address', 'Venue Address', '1325 Portland Avenue', 50),
        ),
        'location' => $loc_home, 'position' => $pos, 'menu_order' => 5,
    ));

    // =========================================================================
    // 6. ORGANIZATION + DENS
    // =========================================================================
    $den_defaults = array(
        1 => array('Lion', 'Kindergarten', 'Our youngest scouts start their adventure with fun activities and family involvement!'),
        2 => array('Tiger', '1st Grade', 'Building confidence and new skills while exploring the world around them.'),
        3 => array('Wolf', '2nd Grade', 'Exploring the outdoors and learning about our community together.'),
        4 => array('Bear', '3rd Grade', 'Taking on bigger challenges and developing teamwork skills.'),
        5 => array('Webelos', '4th Grade', 'We Be Loyal Scouts - preparing for the next step in their journey.'),
        6 => array('Arrow of Light', '5th Grade', 'The highest rank in Cub Scouting before bridging to Scouts BSA.'),
    );
    $org_fields = array(
        $T('org_label', 'Eyebrow Label', "How We're Organized"),
        $T('org_title_lead', 'Title (start)', 'Pack', 50),
        $T('org_title_accent', 'Title (green part)', 'Organization', 50),
        $TA('org_subtitle', 'Subtitle', 'Albany Cub Scouts Pack 3 is made up of dens organized by age group. Different grade levels work toward achieving the rank for that year.', 2),
    );
    foreach ($den_defaults as $i => $d) {
        $org_fields[] = $MSG('den_' . $i, 'Den ' . $i, '<strong>Den ' . $i . '</strong>');
        $org_fields[] = $T('den_' . $i . '_name', 'Name', $d[0], 40);
        $org_fields[] = $T('den_' . $i . '_grade', 'Grade', $d[1], 60);
        $org_fields[] = $TA('den_' . $i . '_desc', 'Description', $d[2], 2);
    }
    $org_fields[] = $TA('den_meetings_text', 'Den Meetings Text', 'Each den establishes its own meeting schedule, usually 1-2 times per month. At den meetings, Scouts work on advancements, learn skills, and always have a great time.', 2);
    $org_fields[] = $T('den_meetings_note', 'Den Meetings Note', 'For Lion and Tiger Scouts, a parent is expected to join their Scout at meetings.');
    $org_fields[] = $T('org_charter', 'Charter Line', 'Pack 3 is in the Herms District of the Golden Gate Council and is chartered by the American Legion Post 292 of Albany');
    acf_add_local_field_group(array(
        'key' => 'group_organization', 'title' => '6. Organization & Dens',
        'fields' => $org_fields, 'location' => $loc_home, 'position' => $pos, 'menu_order' => 6,
    ));

    // =========================================================================
    // 7. ACTIVITIES — section header + tags + community service
    //    (the activity CARDS are group_activities, menu_order 8)
    // =========================================================================
    $tag_defaults = array(
        'Hiking (local park trails)', 'Community Service', "Flag Placement on Veterans' Graves",
        'Ice Skating', 'Bike Rides', 'Water Park', 'Blue and Gold Banquet', '',
    );
    $act_fields = array(
        $T('act_label', 'Eyebrow Label', 'Pack 3 Activities'),
        $T('act_title_lead', 'Title (start)', "What's it like to be in", 50),
        $T('act_title_accent', 'Title (green part)', 'Pack 3?', 50),
        $TA('act_subtitle', 'Subtitle', "Check out some of our annual activities. From outdoor adventures to community service, there's always something exciting happening!", 2),
        $MSG('act_tags', 'More Pack Activities (chips)', '<strong>More Pack Activities</strong> — short chips shown below the cards. Leave blank to hide a chip.'),
        $T('act_more_heading', 'Chips Heading', 'More Pack Activities'),
    );
    foreach ($tag_defaults as $k => $v) {
        $n = $k + 1;
        $act_fields[] = $T('act_tag_' . $n, 'Chip ' . $n, $v, 25);
    }
    $act_fields[] = $T('cs_heading', 'Community Service Heading', 'Community Service');
    $act_fields[] = $TA('cs_text', 'Community Service Text', "Our scouts participate in various community service activities including: Scouting for Food, Earth Day cleanup, Storm drain stewardship, Beach Cleanup, and Flag Placement on holidays at Veterans' cemetery. Pack activities are communicated via email.", 3);
    acf_add_local_field_group(array(
        'key' => 'group_activities_header', 'title' => '7. Activities (header & chips)',
        'fields' => $act_fields, 'location' => $loc_home, 'position' => $pos, 'menu_order' => 7,
    ));

    // =========================================================================
    // 8. ACTIVITY CARDS (fixed slots, 1-6)
    // =========================================================================
    $activity_fields = array();
    for ($i = 1; $i <= 6; $i++) {
        $activity_fields[] = $MSG('activity_' . $i, 'Activity ' . $i, '<strong>Activity Card ' . $i . '</strong> — Leave the title blank to skip this slot.');
        $activity_fields[] = $T('activity_' . $i . '_title', 'Title', '', 50);
        $activity_fields[] = $T('activity_' . $i . '_when', 'When', '', 25, 'e.g. "January (Sunday)"');
        $activity_fields[] = $T('activity_' . $i . '_where', 'Where', '', 25, 'e.g. "Veterans Memorial Building"');
        $activity_fields[] = $TA('activity_' . $i . '_description', 'Description', '', 2);
        $activity_fields[] = $IMG('activity_' . $i . '_image', 'Photo', 'Recommended: landscape orientation, at least 800px wide.');
    }
    acf_add_local_field_group(array(
        'key' => 'group_activities', 'title' => '8. Activity Cards',
        'fields' => $activity_fields, 'location' => $loc_home, 'position' => $pos, 'menu_order' => 8,
    ));

    // =========================================================================
    // 9. WHY SCOUTING — header + benefits + stats
    // =========================================================================
    $ben_defaults = array(
        1 => array('Leadership Development', 'Scouts share in adventure and take turns leading other scouts, building confidence and communication skills.'),
        2 => array('Outdoor Skills', 'Scouts learn how to safely enjoy and care for the outdoors through camping, hiking, and nature activities.'),
        3 => array('Participatory Citizenship', 'Civic awareness and patriotism with an emphasis on service to the community through volunteer projects.'),
        4 => array('Personal Fitness', 'Healthy eating and an active lifestyle are encouraged through physical activities and sports.'),
        5 => array('Character Building', 'We seek to develop good character, guided by the Scout Oath, Scout Law, and Scout Mission.'),
        6 => array('Lifelong Friendship', 'Make lifelong friends and create memories that will last a lifetime through shared experiences.'),
    );
    $stat_defaults = array(
        1 => array('100+', 'Years of Scouting'),
        2 => array('2M+', 'Scouts Nationwide'),
        3 => array('130+', 'Merit Badges'),
        4 => array('Since 1935', 'Pack 3 Albany'),
    );
    $why_fields = array(
        $T('why_label', 'Eyebrow Label', 'Building Skills for Life'),
        $T('why_title_lead', 'Title (start)', 'Why Scouting', 50),
        $T('why_title_accent', 'Title (green part)', 'Matters', 50),
        $TA('why_subtitle', 'Subtitle', 'Cub Scouting is focused on fun and friendship, and along the way we nurture personal growth and social skills.', 2),
    );
    foreach ($ben_defaults as $i => $d) {
        $why_fields[] = $MSG('ben_' . $i, 'Benefit ' . $i, '<strong>Benefit ' . $i . '</strong>');
        $why_fields[] = $T('benefit_' . $i . '_title', 'Title', $d[0], 40);
        $why_fields[] = $TA('benefit_' . $i . '_desc', 'Text', $d[1], 2);
    }
    foreach ($stat_defaults as $i => $d) {
        $why_fields[] = $T('stat_' . $i . '_value', 'Stat ' . $i . ' Number', $d[0], 50);
        $why_fields[] = $T('stat_' . $i . '_label', 'Stat ' . $i . ' Label', $d[1], 50);
    }
    acf_add_local_field_group(array(
        'key' => 'group_why', 'title' => '9. Why Scouting',
        'fields' => $why_fields, 'location' => $loc_home, 'position' => $pos, 'menu_order' => 9,
    ));

    // =========================================================================
    // 10. FAQs — header + fixed slots (1-8) + contact
    // =========================================================================
    $faq_icons = array(
        'people' => 'People', 'question' => 'Question Mark', 'dollar' => 'Dollar Sign',
        'clock' => 'Clock', 'star' => 'Star', 'shield' => 'Shield', 'heart' => 'Heart', 'info' => 'Info',
    );
    $faq_fields = array(
        $T('faq_label', 'Eyebrow Label', 'Got Questions?'),
        $T('faq_title_lead', 'Title (start)', 'Frequently Asked', 50),
        $T('faq_title_accent', 'Title (green part)', 'Questions', 50),
        $TA('faq_subtitle', 'Subtitle', 'Everything you need to know about joining and participating in Albany Pack 3.', 2),
    );
    for ($i = 1; $i <= 8; $i++) {
        $faq_fields[] = $MSG('faq_' . $i, 'FAQ ' . $i, '<strong>FAQ Item ' . $i . '</strong> — Leave the question blank to skip this slot.');
        $faq_fields[] = $T('faq_' . $i . '_question', 'Question', '', 70);
        $faq_fields[] = array(
            'key' => 'field_faq_' . $i . '_icon', 'label' => 'Icon', 'name' => 'faq_' . $i . '_icon',
            'type' => 'select', 'choices' => $faq_icons, 'default_value' => 'question',
            'wrapper' => array('width' => '30'),
        );
        $faq_fields[] = array(
            'key' => 'field_faq_' . $i . '_answer', 'label' => 'Answer', 'name' => 'faq_' . $i . '_answer',
            'type' => 'wysiwyg', 'media_upload' => 0, 'toolbar' => 'basic', 'tabs' => 'visual',
        );
    }
    $faq_fields[] = $T('faq_contact_text', 'Contact Prompt', 'Still have questions? Contact our Cubmaster!');
    $faq_fields[] = $T('faq_contact_email', 'Contact Email', 'cubmaster@albanycubscouts.org');
    acf_add_local_field_group(array(
        'key' => 'group_faqs', 'title' => '10. FAQs',
        'fields' => $faq_fields, 'location' => $loc_home, 'position' => $pos, 'menu_order' => 10,
    ));

    // =========================================================================
    // ABOUT PAGE — Our Story
    // =========================================================================
    acf_add_local_field_group(array(
        'key' => 'group_about_story', 'title' => 'Our Story',
        'fields' => array(
            $T('about_heading', 'Heading', "Albany Pack 3 has a long and proud history of service to Albany's youth"),
            array(
                'key' => 'field_about_content', 'label' => 'Story Content', 'name' => 'about_content',
                'type' => 'wysiwyg', 'toolbar' => 'full', 'media_upload' => 1,
                'default_value' => '<p>Pack 3 is chartered by the American Legion Post 292 of Albany and is part of the Herms District of the Golden Gate Council, Boy Scouts of America.</p><p>We are an inclusive pack that represents the diversity of our community. We are strongly committed to creating a welcoming environment for all children who wish to join our Pack.</p><p>We are proud to be designated as an <strong>Inclusive Unit by Scouts for Equality</strong> and our leaders wear the "Scouts for Equality" badge on their uniforms.</p>',
            ),
            $T('about_quote', 'Highlight Quote', "Serving Albany's youth and community since 1935."),
            $IMG('about_image', 'Photo'),
        ),
        'location' => array(array(array('param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php'))),
        'position' => $pos, 'menu_order' => 0,
    ));

});
