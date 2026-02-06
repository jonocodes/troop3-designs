<?php
/**
 * Template Name: Home
 */

get_header();

// Get upcoming events from Google Calendar
$upcoming_events = pack3_get_upcoming_events(2);

// Meeting info from custom fields (with defaults)
$page_id = get_the_ID();
$meeting_day = get_post_meta($page_id, '_pack3_meeting_day', true) ?: 'First Thursday of each month';
$meeting_time = get_post_meta($page_id, '_pack3_meeting_time', true) ?: '6:30 PM - 8:00 PM';
$meeting_location = get_post_meta($page_id, '_pack3_meeting_location', true) ?: 'Veterans Memorial Hall';
$meeting_address = get_post_meta($page_id, '_pack3_meeting_address', true) ?: '1325 Portland Avenue';
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
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            Registration Always Open
                        </span>
                        <h1>Albany Cub Scouts Pack 3</h1>
                        <p class="hero-subtitle">Are you ready for more s'mores, skits, badges, and outdoor fun?</p>
                        <p class="hero-text">Albany Pack 3 is back in action for 2025-2026! We're an inclusive pack welcoming all kids in Kindergarten through Fifth Grade.</p>

                        <?php if (!empty($upcoming_events)) : ?>
                            <?php foreach ($upcoming_events as $event) : ?>
                                <?php echo pack3_render_hero_event($event); ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="no-events">Check our <a href="<?php echo esc_url(get_permalink(get_page_by_path('calendar'))); ?>" style="color: var(--gold); text-decoration: underline;">calendar</a> for upcoming events.</p>
                        <?php endif; ?>

                        <div class="hero-buttons">
                            <a href="#faqs" class="btn btn-primary btn-large">Join Pack 3</a>
                            <a href="#about" class="btn btn-outline btn-large">About Cub Scouts</a>
                        </div>
                    </div>
                    <div class="hero-logo">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pack3-logo.png" alt="Albany Cub Scouts Pack 3 Logo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    <section class="quick-links">
        <a href="#about" class="quick-link-card green">
            <div class="quick-link-bg" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/images/card-team.jpg');"></div>
            <div class="quick-link-overlay"></div>
            <div class="quick-link-content">
                <div class="quick-link-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3>Our Team</h3>
                <p>Meet the Pack 3 leadership team and volunteers.</p>
                <span class="quick-link-arrow">Learn More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span>
            </div>
        </a>
        <a href="#faqs" class="quick-link-card orange">
            <div class="quick-link-bg" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/images/card-registration.jpg');"></div>
            <div class="quick-link-overlay"></div>
            <div class="quick-link-content">
                <div class="quick-link-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                </div>
                <h3>Registration</h3>
                <p>Learn about membership fees and how to join.</p>
                <span class="quick-link-arrow">Learn More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span>
            </div>
        </a>
        <a href="#activities" class="quick-link-card gold">
            <div class="quick-link-bg" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/images/card-activities.jpg');"></div>
            <div class="quick-link-overlay"></div>
            <div class="quick-link-content">
                <div class="quick-link-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <h3>Activities</h3>
                <p>Explore our events, campouts, and adventures.</p>
                <span class="quick-link-arrow">Learn More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span>
            </div>
        </a>
        <a href="#faqs" class="quick-link-card bark">
            <div class="quick-link-bg" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/images/card-faqs.jpg');"></div>
            <div class="quick-link-overlay"></div>
            <div class="quick-link-content">
                <div class="quick-link-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
                <h3>Scouting FAQs</h3>
                <p>Common questions about Cub Scouts answered.</p>
                <span class="quick-link-arrow">Learn More <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span>
            </div>
        </a>
    </section>

    <!-- Welcome -->
    <section id="about" class="section">
        <div class="container">
            <div class="welcome-grid">
                <div class="welcome-text">
                    <span class="section-label">Welcome to Albany Cub Scouts Pack 3</span>
                    <h2>Are you ready for more <span style="color: var(--forest)">s'mores, skits, badges, and outdoor fun?</span></h2>
                    <p>Albany Cub Scouts are kids in kindergarten through fifth grade who join a pack to go hiking, play games, learn skills, make friends, and much, much more.</p>
                    <p><strong>Cub Scouting means "doing".</strong> You have lots to do as a Cub Scout—hiking, camping, crafts, games, sports, songs, stories, and puzzles, to name just a few things. Much of the fun happens right in the den and pack.</p>
                    <p>Scouts also participate in events like the annual Blue and Gold banquet, the Pinewood Derby, an Egg Drop, and our Pancake Breakfast. Whatever it is that you enjoy, you'll have a chance to do it in Cub Scouting!</p>
                    <div class="highlight-box">
                        <p>"Albany Pack 3 has a long and proud history of service to Albany's youth and to the community as a whole."</p>
                    </div>
                    <div class="values-grid">
                        <div class="value-item">
                            <div class="value-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></div>
                            <div><h4>Character</h4><p>Building strong moral values</p></div>
                        </div>
                        <div class="value-item">
                            <div class="value-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg></div>
                            <div><h4>Citizenship</h4><p>Community responsibility</p></div>
                        </div>
                        <div class="value-item">
                            <div class="value-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>
                            <div><h4>Fitness</h4><p>Healthy active lifestyles</p></div>
                        </div>
                        <div class="value-item">
                            <div class="value-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></div>
                            <div><h4>Leadership</h4><p>Developing future leaders</p></div>
                        </div>
                    </div>
                </div>
                <div class="welcome-image">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/welcome-group.jpg" alt="Pack 3 families at community event">
                </div>
            </div>
        </div>
    </section>

    <!-- Organization -->
    <section id="organization" class="section organization">
        <div class="container">
            <div class="section-header">
                <span class="section-label">How We're Organized</span>
                <h2 class="section-title">Pack <span>Organization</span></h2>
                <p class="section-subtitle">Albany Cub Scouts Pack 3 is made up of dens organized by age group. Different grade levels work toward achieving the rank for that year.</p>
            </div>
            <div class="dens-grid">
                <div class="den-card">
                    <div class="den-icon" style="background: linear-gradient(135deg, #facc15, #eab308);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg></div>
                    <h3>Lion</h3>
                    <div class="den-grade">Kindergarten</div>
                    <p>Our youngest scouts start their adventure with fun activities and family involvement!</p>
                </div>
                <div class="den-card">
                    <div class="den-icon" style="background: linear-gradient(135deg, #fb923c, #ea580c);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3.1-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z"></path></svg></div>
                    <h3>Tiger</h3>
                    <div class="den-grade">1st Grade</div>
                    <p>Building confidence and new skills while exploring the world around them.</p>
                </div>
                <div class="den-card">
                    <div class="den-icon" style="background: linear-gradient(135deg, #60a5fa, #3b82f6);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 5.172C10 3.782 8.423 2.679 6.5 3c-2.823.47-4.113 6.006-4 7 .08.703 1.725 1.722 3.656 1 1.261-.472 1.855-1.24 2.344-2.5"></path><path d="M14.267 5.172c0-1.39 1.577-2.493 3.5-2.172 2.823.47 4.113 6.006 4 7-.08.703-1.725 1.722-3.656 1-1.261-.472-1.855-1.24-2.344-2.5"></path><path d="M8 14v.5"></path><path d="M16 14v.5"></path><path d="M11.25 16.25h1.5L12 17l-.75-.75Z"></path><path d="M4.42 11.247A13.152 13.152 0 0 0 4 14.556C4 18.728 7.582 21 12 21s8-2.272 8-6.444c0-1.061-.162-2.2-.493-3.309m-9.243-6.082A8.801 8.801 0 0 1 12 5c.78 0 1.5.108 2.161.306"></path></svg></div>
                    <h3>Wolf</h3>
                    <div class="den-grade">2nd Grade</div>
                    <p>Exploring the outdoors and learning about our community together.</p>
                </div>
                <div class="den-card">
                    <div class="den-icon" style="background: linear-gradient(135deg, #a78bfa, #8b5cf6);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="4" r="2"></circle><path d="M7 21h8.8a2 2 0 0 0 1.8-2.3l-.8-4a2 2 0 0 0-1.8-1.7H13V9a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v7a3 3 0 0 0 3 3Z"></path></svg></div>
                    <h3>Bear</h3>
                    <div class="den-grade">3rd Grade</div>
                    <p>Taking on bigger challenges and developing teamwork skills.</p>
                </div>
                <div class="den-card">
                    <div class="den-icon" style="background: linear-gradient(135deg, #f87171, #ef4444);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"></path></svg></div>
                    <h3>Webelos</h3>
                    <div class="den-grade">4th Grade</div>
                    <p>We Be Loyal Scouts - preparing for the next step in their journey.</p>
                </div>
                <div class="den-card">
                    <div class="den-icon" style="background: linear-gradient(135deg, var(--forest), var(--forest-light));"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg></div>
                    <h3>Arrow of Light</h3>
                    <div class="den-grade">5th Grade</div>
                    <p>The highest rank in Cub Scouting before bridging to Scouts BSA.</p>
                </div>
            </div>
            <div class="meeting-info">
                <div class="meeting-grid">
                    <div class="meeting-block">
                        <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Pack Meetings</h3>
                        <p>The whole Pack (all dens) meets the <?php echo esc_html(strtolower($meeting_day)); ?> at the <?php echo esc_html($meeting_location); ?>, usually from <?php echo esc_html($meeting_time); ?>. The entire family (including siblings) is welcome.</p>
                        <div class="meeting-location"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg><?php echo esc_html($meeting_location); ?>, <?php echo esc_html($meeting_address); ?></div>
                    </div>
                    <div class="meeting-block">
                        <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Den Meetings</h3>
                        <p>Each den establishes its own meeting schedule, usually 1-2 times per month. At den meetings, Scouts work on advancements, learn skills, and always have a great time.</p>
                        <p style="font-size: 13px; color: rgba(255,255,255,0.7); margin-top: 8px;">For Lion and Tiger Scouts, a parent is expected to join their Scout at meetings.</p>
                    </div>
                </div>
            </div>
            <p class="charter-info">Pack 3 is in the Herms District of the Golden Gate Council and is chartered by the <span>American Legion Post 292 of Albany</span></p>
        </div>
    </section>

    <!-- Activities -->
    <section id="activities" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Pack 3 Activities</span>
                <h2 class="section-title">What's it like to be in <span>Pack 3?</span></h2>
                <p class="section-subtitle">Check out some of our annual activities. From outdoor adventures to community service, there's always something exciting happening!</p>
            </div>
            <div class="activities-grid">
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/activity-derby.jpg" alt="Pinewood Derby">
                        <div class="activity-overlay"></div>
                        <div class="activity-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 16H9m10 0h3v-3.15a1 1 0 0 0-.84-.99L16 11l-2.7-3.6a1 1 0 0 0-.8-.4H5.24a2 2 0 0 0-1.8 1.1l-.8 1.63A6 6 0 0 0 2 12.42V16h2"></path><circle cx="6.5" cy="16.5" r="2.5"></circle><circle cx="16.5" cy="16.5" r="2.5"></circle></svg></div>
                    </div>
                    <div class="activity-content">
                        <h3>Pinewood Derby</h3>
                        <p>Scouts build and race their own model cars! One of our most exciting annual events that the whole family enjoys.</p>
                        <div class="activity-meta">
                            <div class="activity-meta-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>January (Sunday)</div>
                            <div class="activity-meta-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>Veterans Memorial Building</div>
                        </div>
                    </div>
                </div>
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/activity-camping.jpg" alt="Family Campouts">
                        <div class="activity-overlay"></div>
                        <div class="activity-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 22h20L12 2z"></path><path d="M12 22v-6"></path></svg></div>
                    </div>
                    <div class="activity-content">
                        <h3>Family Campouts</h3>
                        <p>Typically at least one each in the spring & fall. Great for bonding, learning outdoor skills, and making memories!</p>
                        <div class="activity-meta">
                            <div class="activity-meta-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Spring & Fall</div>
                            <div class="activity-meta-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>Various Campgrounds</div>
                        </div>
                    </div>
                </div>
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/activity-service.jpg" alt="Pancake Breakfast">
                        <div class="activity-overlay"></div>
                        <div class="activity-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path><path d="M7 2v20"></path><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"></path></svg></div>
                    </div>
                    <div class="activity-content">
                        <h3>Pancake Breakfast</h3>
                        <p>Our annual fundraiser held in the Veterans Memorial Building. Scouts sell tickets and help serve the community!</p>
                        <div class="activity-meta">
                            <div class="activity-meta-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>February (Sunday)</div>
                            <div class="activity-meta-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>Veterans Memorial Building</div>
                        </div>
                    </div>
                </div>
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/activity-hiking.jpg" alt="Annual Egg Drop">
                        <div class="activity-overlay"></div>
                        <div class="activity-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="M12 18v-6"></path><path d="M12 8V6"></path></svg></div>
                    </div>
                    <div class="activity-content">
                        <h3>Annual Egg Drop</h3>
                        <p>Yes, it's exactly what it sounds like! A fun engineering challenge where scouts design contraptions to protect their eggs.</p>
                        <div class="activity-meta">
                            <div class="activity-meta-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Spring</div>
                            <div class="activity-meta-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>TBD</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="more-activities">
                <h3>More Pack Activities</h3>
                <div class="activity-tags">
                    <div class="activity-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>Hiking (local park trails)</div>
                    <div class="activity-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>Community Service</div>
                    <div class="activity-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>Flag Placement on Veterans' Graves</div>
                    <div class="activity-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M8 12h8"></path></svg>Ice Skating</div>
                    <div class="activity-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5.5" cy="17.5" r="3.5"></circle><circle cx="18.5" cy="17.5" r="3.5"></circle><path d="M15 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-3 11.5V14l-3-3 4-3 2 3h2"></path></svg>Bike Rides</div>
                    <div class="activity-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18"></path><path d="m5 6 14 12"></path><path d="m5 18 14-12"></path></svg>Water Park</div>
                    <div class="activity-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>Blue and Gold Banquet</div>
                </div>
            </div>
            <div class="community-service">
                <h4><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>Community Service</h4>
                <p>Our scouts participate in various community service activities including: Scouting for Food, Earth Day cleanup, Storm drain stewardship, Beach Cleanup, and Flag Placement on holidays at Veterans' cemetery. Pack activities are communicated via email.</p>
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
                <span class="section-label">Building Skills for Life</span>
                <h2 class="section-title">Why Scouting <span>Matters</span></h2>
                <p class="section-subtitle">Cub Scouting is focused on fun and friendship, and along the way we nurture personal growth and social skills.</p>
            </div>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon" style="background: linear-gradient(135deg, var(--forest), var(--forest-light));"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                    <h3>Leadership Development</h3>
                    <p>Scouts share in adventure and take turns leading other scouts, building confidence and communication skills.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon" style="background: linear-gradient(135deg, #059669, #10b981);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 22h20L12 2z"></path><path d="M12 22v-6"></path></svg></div>
                    <h3>Outdoor Skills</h3>
                    <p>Scouts learn how to safely enjoy and care for the outdoors through camping, hiking, and nature activities.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon" style="background: linear-gradient(135deg, #2563eb, #3b82f6);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></div>
                    <h3>Participatory Citizenship</h3>
                    <p>Civic awareness and patriotism with an emphasis on service to the community through volunteer projects.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon" style="background: linear-gradient(135deg, var(--campfire), var(--campfire-dark));"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6.5 6.5h11"></path><path d="M6.5 17.5h11"></path><path d="M6 20v-2a6 6 0 1 1 12 0v2"></path><path d="M12 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg></div>
                    <h3>Personal Fitness</h3>
                    <p>Healthy eating and an active lifestyle are encouraged through physical activities and sports.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon" style="background: linear-gradient(135deg, #7c3aed, #8b5cf6);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg></div>
                    <h3>Character Building</h3>
                    <p>We seek to develop good character, guided by the Scout Oath, Scout Law, and Scout Mission.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon" style="background: linear-gradient(135deg, #db2777, #ec4899);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg></div>
                    <h3>Lifelong Friendship</h3>
                    <p>Make lifelong friends and create memories that will last a lifetime through shared experiences.</p>
                </div>
            </div>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">100+</div>
                    <div class="stat-label">Years of Scouting</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">2M+</div>
                    <div class="stat-label">Scouts Nationwide</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">130+</div>
                    <div class="stat-label">Merit Badges</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">Since 1935</div>
                    <div class="stat-label">Pack 3 Albany</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs -->
    <section id="faqs" class="section faq-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Got Questions?</span>
                <h2 class="section-title">Frequently Asked <span>Questions</span></h2>
                <p class="section-subtitle">Everything you need to know about joining and participating in Albany Pack 3.</p>
            </div>
            <div class="faq-container">
                <div class="faq-list">
                    <div class="faq-item active">
                        <button class="faq-question">
                            <div class="faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                            <h3>Who Can Participate?</h3>
                            <div class="faq-chevron"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                        </button>
                        <div class="faq-answer">
                            <p>Anyone in kindergarten through fifth grades! Starting in 2018, we welcomed girls to join the cub scouts. We will be establishing dens at the outset of the Scouting season based on the number of Scouts who sign up in each grade. Den sizes are 10 or fewer.

Albany's Pack 3 has always prided itself on being an inclusive unit that represents the diversity of our community. We are strongly committed to creating a welcoming environment for all children who wish to join our Pack.

We are proud to be designated as an Inclusive Unit by Scouts for Equality and our leaders wear the "Scouts for Equality" badge on their uniforms to signal our dedication to a Scouting movement rooted in equality and free of discrimination.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <div class="faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></div>
                            <h3>How Does Cub Scouts Work?</h3>
                            <div class="faq-chevron"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                        </button>
                        <div class="faq-answer">
                            <p>Cub Scouts is a family program for all kids interested in having fun, learning life skills, building community, exploring the outdoors, becoming leaders and good citizens, and making friends.

The basic structure of the group is a "pack" – which includes the whole group of Scouts, from kindergarten through fifth grades. Each grade has one or more "dens" that meet in smaller groups to work on adventures to earn their rank.

Cub Scouts complete adventures as they work to achieve their rank for that year. The adventures are different for each rank, allowing Cub Scouts to learn new age-appropriate skills and explore new topics each year. At the end of the year, if a Scout has met all of the requirements for that year, he or she will receive the rank (i.e. a first grader would receive the "Tiger" rank).</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <div class="faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                            <h3>What Are the Ranks?</h3>
                            <div class="faq-chevron"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                        </button>
                        <div class="faq-answer">
                            <p>• Kindergarten = Lion
• First Grade = Tiger
• Second Grade = Wolf
• Third Grade = Bear
• Fourth Grade = Webelos (We Be Loyal Scouts)
• Fifth Grade = Arrow of Light (AOL)

In their fifth grade year, scouts "bridge" to Boy Scouts. This involves visiting local troops and choosing one that the scout will participate in and contribute to during their further adventures in Scouting.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <div class="faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div>
                            <h3>How Much Does Cub Scouts Cost?</h3>
                            <div class="faq-chevron"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                        </button>
                        <div class="faq-answer">
                            <p>Annual registration fee is $300.00 per child ($275 for returning scouts) paid by check or Zelle to our treasurer. Fees cover activities, achievements, badges and a "Class B" Pack t-shirt for your Scout. Lion and Tiger Scouts also require a parent to register with Pack 3 as an adult leader for $15.

The basic uniform consists of a shirt, hat, neckerchief, neckerchief slide, and the pack and council patches. This can add up to $100 or so. (Our pack re-uses shirts and gear so check with us before buying!) The hat, neckerchief and slide will change with the different grades, but the same blue shirt can be used from kindergarten through third grade. In fourth and fifth grades, Scouts switch to a tan-colored shirt.

A limited number of scholarships are available for those in need.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">
                            <div class="faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg></div>
                            <h3>What Is the Time Commitment?</h3>
                            <div class="faq-chevron"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                        </button>
                        <div class="faq-answer">
                            <p>The Pack meets once a month on a Thursday evening from 6:30 to 7:30. The dens meet once or twice monthly on a day selected by the den.

In addition, there are at least two family campouts per year, one in fall (October) and one in the spring (April), which are usually Friday to Sunday. For 2025-2026, we have scheduled 2 additional campouts for a total of 4 campouts!

Other activities include:
• Pinewood Derby (Sunday in January)
• Pancake Breakfast (Sunday in February)
• Bake sale (April)
• Community service projects
• Fall and spring hikes

Lion and Tiger parents need to complete Youth Protection Training online (takes about one hour).</p>
                        </div>
                    </div>
                </div>
                <div class="faq-contact">
                    <p>Still have questions? Contact our Cubmaster!</p>
                    <a href="mailto:cubmaster@albanycubscouts.org">cubmaster@albanycubscouts.org</a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
