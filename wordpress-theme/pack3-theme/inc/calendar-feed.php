<?php
/**
 * Google Calendar iCal Feed Parser
 *
 * Fetches and parses the public iCal feed for Pack 3's Google Calendar.
 * Results are cached using WordPress transients to avoid hitting Google on every page load.
 *
 * Usage:
 *   $events = pack3_get_upcoming_events(3); // Get next 3 events
 *   foreach ($events as $event) {
 *       echo $event['summary'];     // Event title
 *       echo $event['dtstart'];     // DateTime object
 *       echo $event['dtend'];       // DateTime object
 *       echo $event['location'];    // Location string or empty
 *       echo $event['description']; // Description string or empty
 *   }
 */

defined('ABSPATH') || exit;

define('PACK3_CALENDAR_ID', 'c03aee33d8f02d3f29f0be5598de80a253718076a086472e3c81ab2e5eb90e3a@group.calendar.google.com');
define('PACK3_CALENDAR_CACHE_KEY', 'pack3_calendar_events');
define('PACK3_CALENDAR_CACHE_HOURS', 2);

/**
 * Get upcoming events from Google Calendar.
 *
 * @param int $count Number of events to return.
 * @return array Array of event arrays sorted by start date.
 */
function pack3_get_upcoming_events($count = 5) {
    $cached = get_transient(PACK3_CALENDAR_CACHE_KEY);
    if ($cached !== false) {
        return array_slice($cached, 0, $count);
    }

    $events = pack3_fetch_ical_events();
    if (!empty($events)) {
        set_transient(PACK3_CALENDAR_CACHE_KEY, $events, PACK3_CALENDAR_CACHE_HOURS * HOUR_IN_SECONDS);
    }

    return array_slice($events, 0, $count);
}

/**
 * Fetch and parse the iCal feed.
 *
 * @return array Parsed events sorted by start date, only future events.
 */
function pack3_fetch_ical_events() {
    $ical_url = 'https://calendar.google.com/calendar/ical/' . urlencode(PACK3_CALENDAR_ID) . '/public/basic.ics';

    $response = wp_remote_get($ical_url, array(
        'timeout' => 10,
        'sslverify' => true,
    ));

    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
        return array();
    }

    $body = wp_remote_retrieve_body($response);
    return pack3_parse_ical($body);
}

/**
 * Parse iCal text into an array of future events.
 *
 * @param string $ical_text Raw iCal data.
 * @return array Parsed events.
 */
function pack3_parse_ical($ical_text) {
    $events = array();
    $now = new DateTime('now', new DateTimeZone('America/Los_Angeles'));

    // Unfold lines per iCal spec (lines starting with space/tab are continuations)
    $ical_text = preg_replace('/\r\n[ \t]/', '', $ical_text);
    $ical_text = preg_replace('/\r/', '', $ical_text);

    // Split into VEVENT blocks
    $blocks = preg_split('/BEGIN:VEVENT/', $ical_text);
    array_shift($blocks); // Remove the part before the first VEVENT

    foreach ($blocks as $block) {
        $end_pos = strpos($block, 'END:VEVENT');
        if ($end_pos === false) continue;
        $block = substr($block, 0, $end_pos);

        $event = array(
            'summary'     => '',
            'dtstart'     => null,
            'dtend'       => null,
            'location'    => '',
            'description' => '',
        );

        // Parse each property
        $lines = explode("\n", $block);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            if (preg_match('/^SUMMARY[;:](.*)$/i', $line, $m)) {
                $event['summary'] = pack3_unescape_ical($m[1]);
            } elseif (preg_match('/^LOCATION[;:](.*)$/i', $line, $m)) {
                $event['location'] = pack3_unescape_ical($m[1]);
            } elseif (preg_match('/^DESCRIPTION[;:](.*)$/i', $line, $m)) {
                $event['description'] = pack3_unescape_ical($m[1]);
            } elseif (preg_match('/^DTSTART[^:]*:(\d{8}T?\d{0,6}Z?)$/i', $line, $m)) {
                $event['dtstart'] = pack3_parse_ical_date($m[1]);
            } elseif (preg_match('/^DTEND[^:]*:(\d{8}T?\d{0,6}Z?)$/i', $line, $m)) {
                $event['dtend'] = pack3_parse_ical_date($m[1]);
            }
        }

        // Only include future events with valid dates
        if ($event['dtstart'] && $event['dtstart'] > $now) {
            $events[] = $event;
        }
    }

    // Sort by start date
    usort($events, function($a, $b) {
        return $a['dtstart'] <=> $b['dtstart'];
    });

    return $events;
}

/**
 * Parse an iCal date string into a DateTime object.
 *
 * @param string $str Date string like 20250821T183000Z or 20250821.
 * @return DateTime|null
 */
function pack3_parse_ical_date($str) {
    $tz = new DateTimeZone('America/Los_Angeles');

    try {
        if (strlen($str) === 8) {
            // All-day event: YYYYMMDD
            return DateTime::createFromFormat('Ymd', $str, $tz)->setTime(0, 0);
        } elseif (substr($str, -1) === 'Z') {
            // UTC time
            $dt = DateTime::createFromFormat('Ymd\THis\Z', $str, new DateTimeZone('UTC'));
            if ($dt) $dt->setTimezone($tz);
            return $dt;
        } else {
            // Local time
            return DateTime::createFromFormat('Ymd\THis', $str, $tz);
        }
    } catch (Exception $e) {
        return null;
    }
}

/**
 * Unescape iCal text values.
 *
 * @param string $text Escaped iCal text.
 * @return string
 */
function pack3_unescape_ical($text) {
    $text = str_replace('\\n', "\n", $text);
    $text = str_replace('\\,', ',', $text);
    $text = str_replace('\\;', ';', $text);
    $text = str_replace('\\\\', '\\', $text);
    return trim($text);
}

/**
 * Render an event card for the homepage hero.
 *
 * @param array $event Event array from pack3_get_upcoming_events().
 * @return string HTML string.
 */
function pack3_render_hero_event($event) {
    $date_str = $event['dtstart']->format('l, F j, Y');
    $time_str = '';
    $is_all_day = ($event['dtstart']->format('H:i') === '00:00' && (!$event['dtend'] || $event['dtend']->format('H:i') === '00:00'));

    if (!$is_all_day && $event['dtend']) {
        $time_str = $event['dtstart']->format('g:i A') . ' - ' . $event['dtend']->format('g:i A');
    } elseif (!$is_all_day) {
        $time_str = $event['dtstart']->format('g:i A');
    }

    $location = esc_html($event['location']);
    $summary = esc_html($event['summary']);

    $html = '<div class="event-card">';
    $html .= '<h3>' . $summary . '</h3>';
    $html .= '<div class="event-item">';
    $html .= '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
    $html .= $date_str;
    $html .= '</div>';

    if ($time_str) {
        $html .= '<div class="event-item">';
        $html .= '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
        $html .= esc_html($time_str);
        $html .= '</div>';
    }

    if ($location) {
        $html .= '<div class="event-item">';
        $html .= '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
        $html .= $location;
        $html .= '</div>';
    }

    $html .= '</div>';
    return $html;
}

/**
 * Force refresh the calendar cache.
 * Can be called manually or via a cron hook.
 */
function pack3_refresh_calendar_cache() {
    delete_transient(PACK3_CALENDAR_CACHE_KEY);
    pack3_get_upcoming_events();
}
