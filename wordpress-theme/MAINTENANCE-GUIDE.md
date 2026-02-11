# Pack 3 Website - Maintenance Guide

Day-to-day operations for the site owner. No technical knowledge required for routine tasks.

## Routine Tasks

### Adding/Editing Events

Events are managed in **Google Calendar**, not WordPress.

1. Open the Pack 3 Google Calendar
2. Add, edit, or delete events as normal
3. The website homepage automatically shows the next 2 upcoming events
4. The calendar page shows the full calendar
5. Changes appear on the site within **2 hours** (the cache refresh period)

**To force an immediate refresh:** Add `?refresh_calendar=1` to any page URL. (This is not built-in by default but can be added if needed.)

### Adding/Editing Leaders

1. Log into WordPress admin (`yourdomain.com/wp-admin`)
2. Click **Leaders** in the left sidebar
3. To add: Click **Add New Leader**
   - Enter name as the title
   - Fill in Role and Description
   - Set Sort Order (lower = appears first, e.g., Cubmaster = 1, Committee Chair = 2)
   - Optionally upload a photo via Set Featured Image
   - Click Publish
4. To edit: Click on the leader's name, make changes, click Update
5. To remove: Hover over the leader's name, click Trash

### Updating Meeting Times

1. Go to **Pages** → edit the **Home** page
2. Scroll to the **Pack Meeting Info** box
3. Update the fields (day, time, venue, address)
4. Click Update

### Updating Photos

Theme images (hero background, activity photos, etc.) are stored in the theme's `images/` folder.

To replace a photo:
1. Go to SiteGround → Site Tools → File Manager
2. Navigate to `wp-content/themes/pack3-theme/images/`
3. Upload the new image **with the same filename** (e.g., `hero-bg.jpg`)
4. The site will use the new image immediately

**Image filenames:**
| File | Where it appears |
|------|-----------------|
| `hero-bg.jpg` | Homepage hero background |
| `pack3-logo.png` | Header, footer, hero |
| `welcome-group.jpg` | Welcome section, About page |
| `card-team.jpg` | Quick links - Our Team |
| `card-registration.jpg` | Quick links - Registration |
| `card-activities.jpg` | Quick links - Activities |
| `card-faqs.jpg` | Quick links - FAQs |
| `activity-derby.jpg` | Pinewood Derby card |
| `activity-camping.jpg` | Family Campouts card |
| `activity-service.jpg` | Pancake Breakfast card |
| `activity-hiking.jpg` | Egg Drop card |

## Annual Updates

At the start of each scouting year, you may want to:

1. **Update the hero subtitle** - currently says "2025-2026". This is in `page-home.php` line ~20. Ask a developer or edit via SiteGround File Manager.
2. **Update registration fees** in the FAQ section if they change.
3. **Review leader list** - add new den leaders, remove departed ones.
4. **Update meeting info** if the schedule changes.
5. **Update the copyright year** - this auto-updates in the footer (uses PHP `date('Y')`).

## What NOT to Touch

These things should not need changing and are safe to leave alone:

- The theme files (style.css, functions.php, etc.) - unless doing an intentional update
- Den card structure (grades don't change)
- Scout values / Why Scouting Matters content
- Footer links to Scouting America and Youth Protection Training
- The Google Calendar ID in `inc/calendar-feed.php`

## Future Enhancements

The theme is built so any hardcoded section can be made editable later without a redesign:

| Section | How to make editable | Effort |
|---------|---------------------|--------|
| FAQ content | Move to custom post type or ACF repeater | Low |
| Activity cards | Custom post type with image + meta fields | Medium |
| Den cards | ACF repeater field | Low |
| Welcome text | WordPress page content (the_content()) | Low |
| Hero text/subtitle | Custom fields on the Home page | Low |

This would require a developer for a few hours but would not change the site's appearance.

## Technical Notes (for developers)

- **Theme type:** Classic PHP theme (not FSE/block theme)
- **No plugins required** - all functionality is in the theme
- **Calendar cache:** WordPress transients, 2-hour TTL, key: `pack3_calendar_events`
- **Leader CPT:** `pack3_leader` with meta fields `_pack3_leader_role`, `_pack3_leader_description`, `_pack3_leader_order`
- **Meeting info:** Page meta fields `_pack3_meeting_day`, `_pack3_meeting_time`, `_pack3_meeting_location`, `_pack3_meeting_address`
- **Google Fonts:** Loaded via `wp_enqueue_style` in functions.php, not `@import`
- **No jQuery dependency** - vanilla JS only
- **Responsive breakpoints:** 640px (tablet), 768px (desktop nav), 1024px (large)

## Getting Help

For content updates (events, leaders, meeting times): Any pack volunteer with WP admin access can do this.

For design/code changes: Requires someone comfortable editing PHP/CSS. The codebase is straightforward - single-file templates with inline comments.
