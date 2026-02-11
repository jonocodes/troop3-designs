<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <header class="header">
        <div class="container">
            <div class="header-content">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <div class="logo-icon"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pack3-logo.png" alt="Pack 3 Logo"></div>
                    <div class="logo-text">
                        <div class="main">Pack 3</div>
                        <div class="sub">Albany, California</div>
                    </div>
                </a>
                <nav class="nav-desktop">
                    <a href="<?php echo esc_url(home_url('/')); ?>"<?php if (is_front_page()) echo ' class="current"'; ?>>Home</a>
                    <a href="<?php echo esc_url(home_url('/#about')); ?>">About</a>
                    <a href="<?php echo esc_url(home_url('/#organization')); ?>">Organization</a>
                    <a href="<?php echo esc_url(home_url('/#activities')); ?>">Activities</a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('calendar'))); ?>"<?php if (is_page('calendar')) echo ' class="current"'; ?>>Calendar</a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>"<?php if (is_page('about')) echo ' class="current"'; ?>>Our Team</a>
                    <a href="<?php echo esc_url(home_url('/#faqs')); ?>">FAQs</a>
                </nav>
                <button class="mobile-menu-btn" onclick="pack3ToggleMenu()" aria-label="Open menu">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>
            </div>
        </div>
    </header>
    <div class="overlay" onclick="pack3ToggleMenu()"></div>
    <div class="mobile-menu">
        <a href="<?php echo esc_url(home_url('/')); ?>" onclick="pack3ToggleMenu()">Home</a>
        <a href="<?php echo esc_url(home_url('/#about')); ?>" onclick="pack3ToggleMenu()">About</a>
        <a href="<?php echo esc_url(home_url('/#organization')); ?>" onclick="pack3ToggleMenu()">Organization</a>
        <a href="<?php echo esc_url(home_url('/#activities')); ?>" onclick="pack3ToggleMenu()">Activities</a>
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('calendar'))); ?>" onclick="pack3ToggleMenu()">Calendar</a>
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" onclick="pack3ToggleMenu()">Our Team</a>
        <a href="<?php echo esc_url(home_url('/#faqs')); ?>" onclick="pack3ToggleMenu()">FAQs</a>
        <a href="<?php echo esc_url(home_url('/#faqs')); ?>" class="btn btn-primary" onclick="pack3ToggleMenu()">Join Pack 3</a>
    </div>
