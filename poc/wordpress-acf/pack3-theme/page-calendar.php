<?php
/**
 * Template Name: Calendar
 */

get_header();

$calendar_id = 'c03aee33d8f02d3f29f0be5598de80a253718076a086472e3c81ab2e5eb90e3a%40group.calendar.google.com';
$embed_url = 'https://calendar.google.com/calendar/embed?src=' . $calendar_id . '&ctz=America%2FLos_Angeles';
$subscribe_url = 'https://calendar.google.com/calendar/ical/' . $calendar_id . '/public/basic.ics';
$gcal_add_url = 'https://calendar.google.com/calendar/r?cid=' . $calendar_id;
?>

    <div class="page-header">
        <div class="container">
            <h1>Pack Calendar</h1>
            <p>Stay up to date with all Pack 3 meetings, campouts, and events.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="calendar-embed">
                <iframe src="<?php echo esc_url($embed_url); ?>" title="Pack 3 Calendar" loading="lazy"></iframe>
            </div>

            <div class="calendar-subscribe">
                <h3>Never Miss an Event</h3>
                <p>Subscribe to our calendar so Pack 3 events automatically show up on your phone or computer.</p>
                <div class="subscribe-buttons">
                    <a href="<?php echo esc_url($gcal_add_url); ?>" target="_blank" rel="noopener" class="btn btn-primary">Add to Google Calendar</a>
                    <a href="<?php echo esc_url($subscribe_url); ?>" class="btn btn-outline-green">Download .ics File</a>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
