# Pack 3 Albany - WordPress Theme (ACF Version)

Custom WordPress theme for Albany Cub Scouts Pack 3, based on the "Forest Adventure" (Design 6) mockup. Uses **Advanced Custom Fields (free)** to make content editable through the WordPress admin without touching any code.

## Difference from `wordpress-theme/`

| | `wordpress-theme/` | `wordpress-acf/` (this one) |
|---|---|---|
| Hero text | Hardcoded in PHP | Editable via admin form fields |
| FAQ content | Hardcoded in PHP | Editable via admin form fields (up to 8 slots) |
| Activity cards | Hardcoded in PHP | Editable via admin form fields (up to 6 slots) |
| About page story | Hardcoded in PHP | Editable via admin rich text editor |
| Plugin required | None | ACF (free) |
| Who can edit content | Someone who can edit PHP files | Anyone with WP admin access |

Everything else is the same: Leaders CPT, Google Calendar integration, meeting info fields, responsive design, identical visual output.

## What the editor sees

When editing the Home page in WordPress admin, the editor sees labeled form fields below the main content area:

**Hero Section:**
- Badge Text: `[Registration Always Open]`
- Title: `[Albany Cub Scouts Pack 3]`
- Subtitle: `[Are you ready for more s'mores...]`
- Description: `[Albany Pack 3 is back in action...]`

**Meeting Info:**
- Meeting Day: `[First Thursday of each month]`
- Meeting Time: `[6:30 PM - 8:00 PM]`
- Venue Name: `[Veterans Memorial Hall]`
- Venue Address: `[1325 Portland Avenue]`

**Activity Card 1:**
- Title: `[Pinewood Derby]`
- When: `[January (Sunday)]`
- Where: `[Veterans Memorial Building]`
- Description: `[Scouts build and race their own model cars...]`
- Photo: `[Upload/select image]`

*(Repeat for up to 6 activity cards. Empty slots are skipped.)*

**FAQ 1:**
- Question: `[Who Can Participate?]`
- Icon: `[dropdown: People/Question/Dollar/Clock/Star/Shield/Heart/Info]`
- Answer: `[rich text editor with bold, lists, links]`

*(Repeat for up to 8 FAQs. Empty slots are skipped.)*

## What's NOT editable (and why)

| Section | Reason |
|---------|--------|
| Quick link cards | Just anchor links to other sections on the page |
| Den cards | Grade structure (K-5) never changes |
| Why Scouting / benefits | Evergreen BSA content |
| Stats bar | Static historical facts |
| Welcome section | Could be made editable later but changes ~once a year |
| Footer | Contact info rarely changes; social links are hardcoded |

Any of these can be converted to ACF fields later without redesigning.

## Plugin dependency

Requires **Advanced Custom Fields** (free version):
- WordPress plugin directory: https://wordpress.org/plugins/advanced-custom-fields/
- 2M+ active installs, maintained by WP Engine
- If ACF is deactivated, the site still works -- all fields fall back to sensible defaults

## File Structure

```
pack3-theme/
  style.css              - All theme styles (identical to wordpress-theme version)
  theme.json             - Block editor color palette and typography
  functions.php          - Theme setup, Leader CPT, ACF helpers, admin notice if ACF missing
  header.php             - Shared header with nav
  footer.php             - Shared footer
  page-home.php          - Homepage template (reads from ACF fields)
  page-about.php         - About page template (reads from ACF fields)
  page-calendar.php      - Calendar page (Google Calendar embed)
  js/main.js             - Mobile menu, FAQ accordion, back-to-top
  inc/acf-fields.php     - All ACF field group definitions (registered in code, ship with theme)
  inc/calendar-feed.php  - iCal feed fetcher/parser/cacher
  images/                - Theme images (copy from winning-design-6/images/)
```

## Key design decisions

1. **ACF fields are registered in code** (`inc/acf-fields.php`), not through the ACF admin UI. This means the field definitions ship with the theme and don't need to be manually recreated on a new install.

2. **Fixed slots instead of repeaters** for FAQs (8 max) and activities (6 max). ACF Free doesn't have repeater fields. Empty slots are skipped in the template. This is adequate for a pack site that has ~5 FAQs and ~4 activities.

3. **Leaders stay as a custom post type** rather than ACF fields because the add/edit/delete/reorder workflow is better suited to the WP post list screen.

4. **Every ACF field has a default value.** If you activate the theme before filling in any fields, the site shows the same content as the original design 6 mockup. Nothing is blank.
