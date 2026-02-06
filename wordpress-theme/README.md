# Pack 3 Albany - WordPress Theme

Custom WordPress theme for Albany Cub Scouts Pack 3, based on the "Forest Adventure" (Design 6) mockup.

## What This Is

A complete WordPress theme that reproduces the winning design as a multi-page site:

- **Homepage** (`/`) - Hero with auto-populated calendar events, quick links, welcome, den cards, activities, why scouting, FAQs
- **About page** (`/about`) - Pack story, editable leaders section, Scout Oath & Law
- **Calendar page** (`/calendar`) - Embedded Google Calendar with subscribe links

## Architecture Decisions

### Why a custom theme instead of a page builder?

- **No plugin dependencies** - everything runs on core WordPress
- **No paid plugins** - zero cost beyond hosting
- **Low maintenance** - no Elementor/Beaver Builder updates to worry about
- **Future-proof** - pure PHP templates can be converted to block patterns later

### What's editable vs hardcoded?

| Content | How it's managed | Where |
|---------|-----------------|-------|
| Hero event cards | **Auto-pulled from Google Calendar** | Homepage hero section |
| Leaders | **Custom post type** (add/edit/remove in WP admin) | About page |
| Meeting time/location | **Custom fields** on the Home page | Organization section + footer |
| Navigation | **WordPress Menus** | Header + mobile menu |
| Calendar | **Google Calendar embed** (manage events in Google) | Calendar page |
| Everything else | Hardcoded in templates | Various sections |

### Why hardcode most sections?

The pack's content (den structure, FAQ answers, activity descriptions, scout values) changes rarely if ever. Hardcoding means:
- No chance of accidentally breaking layout
- No complex block arrangements to maintain
- Faster page loads (no dynamic queries)
- Any section can be converted to editable blocks later without redesigning

### Calendar integration

The homepage pulls upcoming events from the pack's public Google Calendar via its iCal feed. Events are cached for 2 hours using WordPress transients. The calendar page uses a simple iframe embed.

**Calendar ID:** `c03aee33d8f02d3f29f0be5598de80a253718076a086472e3c81ab2e5eb90e3a@group.calendar.google.com`

## File Structure

```
pack3-theme/
  style.css              - All theme styles (design 6 color scheme, layout, responsive)
  functions.php          - Theme setup, enqueues, Leader CPT, custom fields, meta boxes
  header.php             - Shared header with nav (fixed, forest green gradient)
  footer.php             - Shared footer (4-column, dark green)
  page-home.php          - Homepage template (all 8 sections)
  page-about.php         - About page template (story, leaders, values)
  page-calendar.php      - Calendar page template (Google Calendar embed)
  js/main.js             - Mobile menu toggle, FAQ accordion, back-to-top button
  inc/calendar-feed.php  - iCal feed fetcher/parser/cacher
  images/                - Theme images (copy from winning-design-6/images/)
```

## Preview

Open `demo.html` in a browser to preview the full site without WordPress. It loads the theme's CSS and JS directly and shows all three pages inline (homepage, about, calendar) with placeholder data for the dynamic sections.

**Note:** The demo references images from `../winning-design-6/images/` - make sure that folder is present.

## Color Palette

| Name | Hex | Usage |
|------|-----|-------|
| Forest Dark | `#1a4d2e` | Header, footer, dark sections |
| Forest | `#2d6a4f` | Links, accents, section backgrounds |
| Forest Light | `#40916c` | Gradients, hover states |
| Cream | `#f8f6f0` | Page background |
| Campfire | `#e07c3e` | Buttons, CTAs, highlights |
| Gold | `#daa520` | Accent text, nav hover, icons |

## Typography

- **Headings:** Fredoka (600-700 weight)
- **Body:** Nunito (400-700 weight)
- Loaded via Google Fonts, no local font files needed
