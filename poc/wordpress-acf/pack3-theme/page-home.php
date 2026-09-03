<?php
/**
 * Template Name: Home
 *
 * Every text/image on this page is editable via ACF fields (see inc/acf-fields.php).
 * SVG icons, gradients, colors, and layout stay here because they are design, not content.
 */

get_header();

$upcoming_events = pack3_get_upcoming_events(2);
$theme_uri = get_template_directory_uri();

// Small helper: field value or the theme's default image URL.
$img_or = function($field, $fallback) use ($theme_uri) {
    $v = pack3_field($field);
    return $v ? $v : $theme_uri . '/images/' . $fallback;
};

$badge_text  = pack3_field('hero_badge_text', 'Registration Always Open');
$hero_title  = pack3_field('hero_title', 'Albany Cub Scouts Pack 3');
$hero_sub    = pack3_field('hero_subtitle', "Are you ready for more s'mores, skits, badges, and outdoor fun?");
$hero_desc   = pack3_field('hero_description', "Albany Pack 3 is back in action for 2025-2026! We're an inclusive pack welcoming all kids in Kindergarten through Fifth Grade.");

$meeting_day  = pack3_field('meeting_day', 'First Thursday of each month');
$meeting_time = pack3_field('meeting_time', '6:30 PM - 8:00 PM');
$meeting_loc  = pack3_field('meeting_location', 'Veterans Memorial Hall');
$meeting_addr = pack3_field('meeting_address', '1325 Portland Avenue');

// --- Design assets + default content kept in-template, mapped by index -----
// Each row: design (color/gradient/icon/image) + the default text ACF overrides.
// Fixed structural blocks (quick links, values, dens, benefits, stats) always
// render; the default text guarantees the design shows before anyone edits.
$ql_meta = array(
    1 => array('green',  '#about',       'card-team.jpg',         '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>', 'Our Team', 'Meet the Pack 3 leadership team and volunteers.'),
    2 => array('orange', '#faqs',        'card-registration.jpg', '<path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>', 'Registration', 'Learn about membership fees and how to join.'),
    3 => array('gold',   '#activities',  'card-activities.jpg',   '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>', 'Activities', 'Explore our events, campouts, and adventures.'),
    4 => array('bark',   '#faqs',        'card-faqs.jpg',         '<circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line>', 'Scouting FAQs', 'Common questions about Cub Scouts answered.'),
);
$value_icons = array(
    1 => array('<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>', 'Character', 'Building strong moral values'),
    2 => array('<circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle>', 'Citizenship', 'Community responsibility'),
    3 => array('<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>', 'Fitness', 'Healthy active lifestyles'),
    4 => array('<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>', 'Leadership', 'Developing future leaders'),
);
$den_icons = array(
    1 => array('linear-gradient(135deg, #facc15, #eab308)', '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>', 'Lion', 'Kindergarten', 'Our youngest scouts start their adventure with fun activities and family involvement!'),
    2 => array('linear-gradient(135deg, #fb923c, #ea580c)', '<path d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3.1-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z"></path>', 'Tiger', '1st Grade', 'Building confidence and new skills while exploring the world around them.'),
    3 => array('linear-gradient(135deg, #60a5fa, #3b82f6)', '<path d="M10 5.172C10 3.782 8.423 2.679 6.5 3c-2.823.47-4.113 6.006-4 7 .08.703 1.725 1.722 3.656 1 1.261-.472 1.855-1.24 2.344-2.5"></path><path d="M14.267 5.172c0-1.39 1.577-2.493 3.5-2.172 2.823.47 4.113 6.006 4 7-.08.703-1.725 1.722-3.656 1-1.261-.472-1.855-1.24-2.344-2.5"></path><path d="M8 14v.5"></path><path d="M16 14v.5"></path><path d="M11.25 16.25h1.5L12 17l-.75-.75Z"></path><path d="M4.42 11.247A13.152 13.152 0 0 0 4 14.556C4 18.728 7.582 21 12 21s8-2.272 8-6.444c0-1.061-.162-2.2-.493-3.309m-9.243-6.082A8.801 8.801 0 0 1 12 5c.78 0 1.5.108 2.161.306"></path>', 'Wolf', '2nd Grade', 'Exploring the outdoors and learning about our community together.'),
    4 => array('linear-gradient(135deg, #a78bfa, #8b5cf6)', '<circle cx="11" cy="4" r="2"></circle><path d="M7 21h8.8a2 2 0 0 0 1.8-2.3l-.8-4a2 2 0 0 0-1.8-1.7H13V9a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v7a3 3 0 0 0 3 3Z"></path>', 'Bear', '3rd Grade', 'Taking on bigger challenges and developing teamwork skills.'),
    5 => array('linear-gradient(135deg, #f87171, #ef4444)', '<path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path>', 'Webelos', '4th Grade', 'We Be Loyal Scouts - preparing for the next step in their journey.'),
    6 => array('linear-gradient(135deg, var(--forest), var(--forest-light))', '<circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>', 'Arrow of Light', '5th Grade', 'The highest rank in Cub Scouting before bridging to Scouts BSA.'),
);
$benefit_icons = array(
    1 => array('linear-gradient(135deg, var(--forest), var(--forest-light))', '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>', 'Leadership Development', 'Scouts share in adventure and take turns leading other scouts, building confidence and communication skills.'),
    2 => array('linear-gradient(135deg, #059669, #10b981)', '<path d="M12 2L2 22h20L12 2z"></path><path d="M12 22v-6"></path>', 'Outdoor Skills', 'Scouts learn how to safely enjoy and care for the outdoors through camping, hiking, and nature activities.'),
    3 => array('linear-gradient(135deg, #2563eb, #3b82f6)', '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>', 'Participatory Citizenship', 'Civic awareness and patriotism with an emphasis on service to the community through volunteer projects.'),
    4 => array('linear-gradient(135deg, var(--campfire), var(--campfire-dark))', '<path d="M6.5 6.5h11"></path><path d="M6.5 17.5h11"></path><path d="M6 20v-2a6 6 0 1 1 12 0v2"></path><path d="M12 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>', 'Personal Fitness', 'Healthy eating and an active lifestyle are encouraged through physical activities and sports.'),
    5 => array('linear-gradient(135deg, #7c3aed, #8b5cf6)', '<circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>', 'Character Building', 'We seek to develop good character, guided by the Scout Oath, Scout Law, and Scout Mission.'),
    6 => array('linear-gradient(135deg, #db2777, #ec4899)', '<circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line>', 'Lifelong Friendship', 'Make lifelong friends and create memories that will last a lifetime through shared experiences.'),
);
$stat_defaults = array(
    1 => array('100+', 'Years of Scouting'),
    2 => array('2M+', 'Scouts Nationwide'),
    3 => array('130+', 'Merit Badges'),
    4 => array('Since 1935', 'Pack 3 Albany'),
);
$svg = function($paths, $extra = '') {
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"' . $extra . '>' . $paths . '</svg>';
};
?>

    <!-- Hero -->
    <section id="home" class="hero">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-grid">
                    <div>
                        <span class="badge">
                            <?php echo $svg('<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>'); ?>
                            <?php echo esc_html($badge_text); ?>
                        </span>
                        <h1><?php echo esc_html($hero_title); ?></h1>
                        <p class="hero-subtitle"><?php echo esc_html($hero_sub); ?></p>
                        <p class="hero-text"><?php echo esc_html($hero_desc); ?></p>

                        <?php if (!empty($upcoming_events)) : ?>
                            <?php foreach ($upcoming_events as $event) : ?>
                                <?php echo pack3_render_hero_event($event); ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="no-events">Check our <a href="<?php echo esc_url(get_permalink(get_page_by_path('calendar'))); ?>" style="color: var(--gold); text-decoration: underline;">calendar</a> for upcoming events.</p>
                        <?php endif; ?>

                        <div class="hero-buttons">
                            <a href="#faqs" class="btn btn-primary btn-large"><?php echo esc_html(pack3_field('hero_btn1_label', 'Join Pack 3')); ?></a>
                            <a href="#about" class="btn btn-outline btn-large"><?php echo esc_html(pack3_field('hero_btn2_label', 'About Cub Scouts')); ?></a>
                        </div>
                    </div>
                    <div class="hero-logo">
                        <img src="<?php echo esc_url($theme_uri); ?>/images/pack3-logo.png" alt="Albany Cub Scouts Pack 3 Logo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    <section class="quick-links">
        <?php foreach ($ql_meta as $i => $m) :
            list($color, $href, $default_img, $icon, $def_title, $def_desc) = $m;
            $title = pack3_field('ql_' . $i . '_title', $def_title);
            if ($title === '') continue;
            $desc  = pack3_field('ql_' . $i . '_desc', $def_desc);
            $bg    = $img_or('ql_' . $i . '_image', $default_img);
        ?>
        <a href="<?php echo esc_attr($href); ?>" class="quick-link-card <?php echo esc_attr($color); ?>">
            <div class="quick-link-bg" style="background-image: url('<?php echo esc_url($bg); ?>');"></div>
            <div class="quick-link-overlay"></div>
            <div class="quick-link-content">
                <div class="quick-link-icon"><?php echo $svg($icon); ?></div>
                <h3><?php echo esc_html($title); ?></h3>
                <p><?php echo esc_html($desc); ?></p>
                <span class="quick-link-arrow">Learn More <?php echo $svg('<line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline>', ' width="16" height="16"'); ?></span>
            </div>
        </a>
        <?php endforeach; ?>
    </section>

    <!-- Welcome -->
    <section id="about" class="section">
        <div class="container">
            <div class="welcome-grid">
                <div class="welcome-text">
                    <span class="section-label"><?php echo esc_html(pack3_field('welcome_label', 'Welcome to Albany Cub Scouts Pack 3')); ?></span>
                    <h2><?php echo esc_html(pack3_field('welcome_heading_lead', 'Are you ready for more')); ?> <span style="color: var(--forest)"><?php echo esc_html(pack3_field('welcome_heading_accent', "s'mores, skits, badges, and outdoor fun?")); ?></span></h2>
                    <?php echo wp_kses_post(pack3_field('welcome_body', '')); ?>
                    <div class="highlight-box">
                        <p><?php echo esc_html(pack3_field('welcome_quote', "Albany Pack 3 has a long and proud history of service to Albany's youth and to the community as a whole.")); ?></p>
                    </div>
                    <div class="values-grid">
                        <?php foreach ($value_icons as $i => $v) :
                            list($icon, $def_title, $def_desc) = $v;
                            $vt = pack3_field('value_' . $i . '_title', $def_title);
                            if ($vt === '') continue;
                        ?>
                        <div class="value-item">
                            <div class="value-icon"><?php echo $svg($icon); ?></div>
                            <div><h4><?php echo esc_html($vt); ?></h4><p><?php echo esc_html(pack3_field('value_' . $i . '_desc', $def_desc)); ?></p></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="welcome-image">
                    <img src="<?php echo esc_url($img_or('welcome_image', 'welcome-group.jpg')); ?>" alt="Pack 3 families at community event">
                </div>
            </div>
        </div>
    </section>

    <!-- Organization -->
    <section id="organization" class="section organization">
        <div class="container">
            <div class="section-header">
                <span class="section-label"><?php echo esc_html(pack3_field('org_label', "How We're Organized")); ?></span>
                <h2 class="section-title"><?php echo esc_html(pack3_field('org_title_lead', 'Pack')); ?> <span><?php echo esc_html(pack3_field('org_title_accent', 'Organization')); ?></span></h2>
                <p class="section-subtitle"><?php echo esc_html(pack3_field('org_subtitle', 'Albany Cub Scouts Pack 3 is made up of dens organized by age group. Different grade levels work toward achieving the rank for that year.')); ?></p>
            </div>
            <div class="dens-grid">
                <?php foreach ($den_icons as $i => $d) :
                    list($grad, $icon, $def_name, $def_grade, $def_desc) = $d;
                    $name = pack3_field('den_' . $i . '_name', $def_name);
                    if ($name === '') continue;
                ?>
                <div class="den-card">
                    <div class="den-icon" style="background: <?php echo esc_attr($grad); ?>;"><?php echo $svg($icon); ?></div>
                    <h3><?php echo esc_html($name); ?></h3><div class="den-grade"><?php echo esc_html(pack3_field('den_' . $i . '_grade', $def_grade)); ?></div>
                    <p><?php echo esc_html(pack3_field('den_' . $i . '_desc', $def_desc)); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="meeting-info">
                <div class="meeting-grid">
                    <div class="meeting-block">
                        <h3><?php echo $svg('<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>'); ?>Pack Meetings</h3>
                        <p>The whole Pack (all dens) meets the <?php echo esc_html(strtolower($meeting_day)); ?> at the <?php echo esc_html($meeting_loc); ?>, usually from <?php echo esc_html($meeting_time); ?>. The entire family (including siblings) is welcome.</p>
                        <div class="meeting-location"><?php echo $svg('<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle>'); ?><?php echo esc_html($meeting_loc); ?>, <?php echo esc_html($meeting_addr); ?></div>
                    </div>
                    <div class="meeting-block">
                        <h3><?php echo $svg('<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>'); ?>Den Meetings</h3>
                        <p><?php echo esc_html(pack3_field('den_meetings_text', 'Each den establishes its own meeting schedule, usually 1-2 times per month. At den meetings, Scouts work on advancements, learn skills, and always have a great time.')); ?></p>
                        <p style="font-size: 13px; color: rgba(255,255,255,0.7); margin-top: 8px;"><?php echo esc_html(pack3_field('den_meetings_note', 'For Lion and Tiger Scouts, a parent is expected to join their Scout at meetings.')); ?></p>
                    </div>
                </div>
            </div>
            <p class="charter-info"><?php echo esc_html(pack3_field('org_charter', 'Pack 3 is in the Herms District of the Golden Gate Council and is chartered by the American Legion Post 292 of Albany')); ?></p>
        </div>
    </section>

    <!-- Activities -->
    <section id="activities" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-label"><?php echo esc_html(pack3_field('act_label', 'Pack 3 Activities')); ?></span>
                <h2 class="section-title"><?php echo esc_html(pack3_field('act_title_lead', "What's it like to be in")); ?> <span><?php echo esc_html(pack3_field('act_title_accent', 'Pack 3?')); ?></span></h2>
                <p class="section-subtitle"><?php echo esc_html(pack3_field('act_subtitle', "Check out some of our annual activities. From outdoor adventures to community service, there's always something exciting happening!")); ?></p>
            </div>
            <div class="activities-grid">
                <?php for ($i = 1; $i <= 6; $i++) :
                    $title = pack3_field('activity_' . $i . '_title');
                    if (empty($title)) continue;
                    $desc  = pack3_field('activity_' . $i . '_description');
                    $when  = pack3_field('activity_' . $i . '_when');
                    $where = pack3_field('activity_' . $i . '_where');
                    $image = pack3_field('activity_' . $i . '_image');
                ?>
                <div class="activity-card">
                    <?php if ($image) : ?>
                    <div class="activity-image">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                        <div class="activity-overlay"></div>
                    </div>
                    <?php endif; ?>
                    <div class="activity-content">
                        <h3><?php echo esc_html($title); ?></h3>
                        <?php if ($desc) : ?><p><?php echo esc_html($desc); ?></p><?php endif; ?>
                        <?php if ($when || $where) : ?>
                        <div class="activity-meta">
                            <?php if ($when) : ?>
                            <div class="activity-meta-item"><?php echo $svg('<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>'); ?><?php echo esc_html($when); ?></div>
                            <?php endif; ?>
                            <?php if ($where) : ?>
                            <div class="activity-meta-item"><?php echo $svg('<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle>'); ?><?php echo esc_html($where); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <?php
            $tags = array();
            for ($i = 1; $i <= 8; $i++) { $t = pack3_field('act_tag_' . $i); if ($t !== '') $tags[] = $t; }
            if (!empty($tags)) : ?>
            <div class="more-activities">
                <h3><?php echo esc_html(pack3_field('act_more_heading', 'More Pack Activities')); ?></h3>
                <div class="activity-tags">
                    <?php foreach ($tags as $t) : ?>
                    <div class="activity-tag"><?php echo $svg('<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>', ' width="18" height="18"'); ?><?php echo esc_html($t); ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="community-service">
                <h4><?php echo $svg('<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>', ' width="22" height="22"'); ?><?php echo esc_html(pack3_field('cs_heading', 'Community Service')); ?></h4>
                <p><?php echo esc_html(pack3_field('cs_text', "Our scouts participate in various community service activities including: Scouting for Food, Earth Day cleanup, Storm drain stewardship, Beach Cleanup, and Flag Placement on holidays at Veterans' cemetery. Pack activities are communicated via email.")); ?></p>
            </div>
            <div class="text-center mt-4">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('calendar'))); ?>" class="btn btn-primary btn-large">View Pack Calendar</a>
            </div>
        </div>
    </section>

    <!-- Why Scouting -->
    <section class="section why-scouting">
        <div class="container">
            <div class="section-header">
                <span class="section-label"><?php echo esc_html(pack3_field('why_label', 'Building Skills for Life')); ?></span>
                <h2 class="section-title"><?php echo esc_html(pack3_field('why_title_lead', 'Why Scouting')); ?> <span><?php echo esc_html(pack3_field('why_title_accent', 'Matters')); ?></span></h2>
                <p class="section-subtitle"><?php echo esc_html(pack3_field('why_subtitle', 'Cub Scouting is focused on fun and friendship, and along the way we nurture personal growth and social skills.')); ?></p>
            </div>
            <div class="benefits-grid">
                <?php foreach ($benefit_icons as $i => $b) :
                    list($grad, $icon, $def_title, $def_desc) = $b;
                    $bt = pack3_field('benefit_' . $i . '_title', $def_title);
                    if ($bt === '') continue;
                ?>
                <div class="benefit-card">
                    <div class="benefit-icon" style="background: <?php echo esc_attr($grad); ?>;"><?php echo $svg($icon); ?></div>
                    <h3><?php echo esc_html($bt); ?></h3>
                    <p><?php echo esc_html(pack3_field('benefit_' . $i . '_desc', $def_desc)); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="stats-grid">
                <?php for ($i = 1; $i <= 4; $i++) :
                    $sv = pack3_field('stat_' . $i . '_value', $stat_defaults[$i][0]);
                    if ($sv === '') continue;
                ?>
                <div class="stat-item"><div class="stat-value"><?php echo esc_html($sv); ?></div><div class="stat-label"><?php echo esc_html(pack3_field('stat_' . $i . '_label', $stat_defaults[$i][1])); ?></div></div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- FAQs -->
    <section id="faqs" class="section faq-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label"><?php echo esc_html(pack3_field('faq_label', 'Got Questions?')); ?></span>
                <h2 class="section-title"><?php echo esc_html(pack3_field('faq_title_lead', 'Frequently Asked')); ?> <span><?php echo esc_html(pack3_field('faq_title_accent', 'Questions')); ?></span></h2>
                <p class="section-subtitle"><?php echo esc_html(pack3_field('faq_subtitle', 'Everything you need to know about joining and participating in Albany Pack 3.')); ?></p>
            </div>
            <div class="faq-container">
                <div class="faq-list">
                    <?php
                    $first_faq = true;
                    for ($i = 1; $i <= 8; $i++) :
                        $question = pack3_field('faq_' . $i . '_question');
                        if (empty($question)) continue;
                        $answer = pack3_field('faq_' . $i . '_answer');
                        $icon_key = pack3_field('faq_' . $i . '_icon', 'question');
                    ?>
                    <div class="faq-item<?php echo $first_faq ? ' active' : ''; ?>">
                        <button class="faq-question">
                            <div class="faq-icon"><?php echo pack3_faq_icon_svg($icon_key); ?></div>
                            <h3><?php echo esc_html($question); ?></h3>
                            <div class="faq-chevron"><?php echo $svg('<polyline points="6 9 12 15 18 9"></polyline>'); ?></div>
                        </button>
                        <div class="faq-answer">
                            <?php echo wp_kses_post($answer); ?>
                        </div>
                    </div>
                    <?php $first_faq = false; endfor; ?>
                </div>
                <div class="faq-contact">
                    <p><?php echo esc_html(pack3_field('faq_contact_text', 'Still have questions? Contact our Cubmaster!')); ?></p>
                    <?php $faq_email = pack3_field('faq_contact_email', 'cubmaster@albanycubscouts.org'); ?>
                    <a href="mailto:<?php echo esc_attr($faq_email); ?>"><?php echo esc_html($faq_email); ?></a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
