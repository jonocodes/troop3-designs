    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand">
                        <div class="logo-icon"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pack3-logo.png" alt="Pack 3 Logo"></div>
                        <div class="footer-brand-text">
                            <h3>Pack 3</h3>
                            <p>Albany, CA</p>
                        </div>
                    </div>
                    <div class="footer-about">
                        <p>Building character, citizenship, and personal fitness in young people through fun outdoor adventures and community service since 1935.</p>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                            <a href="#" class="social-link" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                        </div>
                    </div>
                </div>
                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url(home_url('/#about')); ?>">About</a></li>
                        <li><a href="<?php echo esc_url(home_url('/#organization')); ?>">Organization</a></li>
                        <li><a href="<?php echo esc_url(home_url('/#activities')); ?>">Activities</a></li>
                        <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('calendar'))); ?>">Calendar</a></li>
                        <li><a href="<?php echo esc_url(home_url('/#faqs')); ?>">FAQs</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Resources</h4>
                    <ul class="footer-links">
                        <li><a href="https://www.scouting.org" target="_blank" rel="noopener">Scouting America <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg></a></li>
                        <li><a href="https://www.scouting.org/training/youth-protection/" target="_blank" rel="noopener">Youth Protection Training <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg></a></li>
                        <li><a href="#">Golden Gate Council</a></li>
                        <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('calendar'))); ?>">Pack Calendar</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Contact Us</h4>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <a href="mailto:cubmaster@albanycubscouts.org">cubmaster@albanycubscouts.org</a>
                    </div>
                    <div class="footer-contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span>Veterans Memorial Hall<br>1325 Portland Avenue<br>Albany, CA 94706</span>
                    </div>
                    <div class="meeting-box">
                        <p class="title">Pack Meetings</p>
                        <p class="time">First Thursday of each month<br>6:30 PM - 7:30 PM</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; <?php echo date('Y'); ?> Albany Cub Scout Pack 3. All rights reserved.</p>
                    <p>Made with <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg> in Albany, CA</p>
                </div>
            </div>
        </div>
    </footer>

    <button class="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"></polyline></svg>
    </button>

    <?php wp_footer(); ?>
</body>
</html>
