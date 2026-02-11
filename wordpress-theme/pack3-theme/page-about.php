<?php
/**
 * Template Name: About
 */

get_header();
$leaders = pack3_get_leaders();
?>

    <div class="page-header">
        <div class="container">
            <h1>About Pack 3</h1>
            <p>Meet the volunteers who make Albany Cub Scouts Pack 3 a great experience for every family.</p>
        </div>
    </div>

    <!-- Our Story -->
    <section class="section">
        <div class="container">
            <div class="welcome-grid">
                <div class="welcome-text">
                    <span class="section-label">Our Story</span>
                    <h2>Albany Pack 3 has a long and proud history of service to <span style="color: var(--forest)">Albany's youth</span></h2>
                    <p>Pack 3 is chartered by the American Legion Post 292 of Albany and is part of the Herms District of the Golden Gate Council, Boy Scouts of America.</p>
                    <p>We are an inclusive pack that represents the diversity of our community. We are strongly committed to creating a welcoming environment for all children who wish to join our Pack.</p>
                    <p>We are proud to be designated as an <strong>Inclusive Unit by Scouts for Equality</strong> and our leaders wear the "Scouts for Equality" badge on their uniforms.</p>
                    <div class="highlight-box">
                        <p>"Serving Albany's youth and community since 1935."</p>
                    </div>
                </div>
                <div class="welcome-image">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/welcome-group.jpg" alt="Pack 3 families at community event">
                </div>
            </div>
        </div>
    </section>

    <!-- Leaders -->
    <section class="section" style="background: linear-gradient(180deg, var(--cream) 0%, white 100%);">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Our Volunteers</span>
                <h2 class="section-title">Pack 3 <span>Leadership</span></h2>
                <p class="section-subtitle">Our pack is run entirely by parent volunteers who are passionate about giving kids a great scouting experience.</p>
            </div>

            <?php if (!empty($leaders)) : ?>
                <div class="leaders-grid">
                    <?php foreach ($leaders as $leader) :
                        $role = get_post_meta($leader->ID, '_pack3_leader_role', true);
                        $desc = get_post_meta($leader->ID, '_pack3_leader_description', true);
                        $has_photo = has_post_thumbnail($leader->ID);
                    ?>
                        <div class="leader-card">
                            <div class="leader-avatar">
                                <?php if ($has_photo) : ?>
                                    <?php echo get_the_post_thumbnail($leader->ID, 'leader-avatar'); ?>
                                <?php else : ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <?php endif; ?>
                            </div>
                            <div class="leader-info">
                                <h3><?php echo esc_html($leader->post_title); ?></h3>
                                <?php if ($role) : ?>
                                    <div class="leader-role"><?php echo esc_html($role); ?></div>
                                <?php endif; ?>
                                <?php if ($desc) : ?>
                                    <p><?php echo esc_html($desc); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p style="text-align: center; color: var(--text-medium);">Leader information coming soon. Check back later!</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Values -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">What Guides Us</span>
                <h2 class="section-title">The Scout <span>Oath & Law</span></h2>
            </div>
            <div class="benefits-grid" style="max-width: 800px; margin: 0 auto;">
                <div class="benefit-card" style="grid-column: 1 / -1;">
                    <div class="benefit-icon" style="background: linear-gradient(135deg, var(--forest), var(--forest-light));"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></div>
                    <h3>Scout Oath</h3>
                    <p>On my honor I will do my best to do my duty to God and my country and to obey the Scout Law; to help other people at all times; to keep myself physically strong, mentally awake, and morally straight.</p>
                </div>
                <div class="benefit-card" style="grid-column: 1 / -1;">
                    <div class="benefit-icon" style="background: linear-gradient(135deg, var(--campfire), var(--campfire-dark));"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></div>
                    <h3>Scout Law</h3>
                    <p>A Scout is Trustworthy, Loyal, Helpful, Friendly, Courteous, Kind, Obedient, Cheerful, Thrifty, Brave, Clean, and Reverent.</p>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
