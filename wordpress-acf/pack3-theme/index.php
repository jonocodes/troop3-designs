<?php
/**
 * Fallback template.
 *
 * WordPress requires an index.php as the final template in the hierarchy.
 * The site's real pages use page-home.php / page-about.php / page-calendar.php;
 * this renders anything else (blog posts, search, 404) inside the theme chrome.
 */
defined('ABSPATH') || exit;
get_header();
?>
<main class="section" style="padding-top: 120px;">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article style="max-width: 800px; margin: 0 auto 40px;">
                <h1 class="section-title"><?php the_title(); ?></h1>
                <div class="welcome-text"><?php the_content(); ?></div>
            </article>
        <?php endwhile; else : ?>
            <h1 class="section-title" style="text-align:center;">Nothing found</h1>
        <?php endif; ?>
    </div>
</main>
<?php
get_footer();
