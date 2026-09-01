# Pack 3 Website - Maintenance Guide (ACF Version)

Day-to-day operations for the site owner. **No coding or HTML knowledge required** for routine tasks.

## What You Can Edit (and How)

**Every section of the home page is editable** from the Home page editor. Open
**Pages → Home**, and you'll find numbered field groups (1. Hero, 2. Quick Links,
3. Welcome, 5. Meeting Info, 6. Organization & Dens, 7. Activities, 8. Activity
Cards, 9. Why Scouting, 10. FAQs) above the content area. Edit any text or photo
and click **Update**. Fields are pre-filled with the current copy, so you're
always editing real text, never a blank form.

### Events / Calendar

Events are managed in **Google Calendar**, not WordPress.

1. Open the Pack 3 Google Calendar
2. Add, edit, or delete events as normal
3. The website homepage automatically shows the next 2 upcoming events
4. Changes appear on the site within **2 hours**

### Hero Section (the big banner at the top)

1. Log into WordPress admin
2. Go to **Pages** > edit the **Home** page
3. Scroll to the **"Hero Section"** fields
4. Edit the Badge Text, Title, Subtitle, or Description
5. Click **Update**

### Meeting Info

1. Edit the **Home** page
2. Scroll to the **"Meeting Info"** fields
3. Update the day, time, venue, or address
4. Click **Update**

### Activity Cards

1. Edit the **Home** page
2. Scroll to the **"Activity Cards"** fields
3. For each activity, you can edit:
   - **Title** (leave blank to hide this card)
   - **When** (e.g., "January (Sunday)")
   - **Where** (e.g., "Veterans Memorial Building")
   - **Description** (a sentence or two)
   - **Photo** (click to upload or choose from media library)
4. Click **Update**

**To add a new activity:** Find the next empty slot (Activity 5 or 6) and fill in the title.
**To remove an activity:** Clear the title field. The card will disappear from the site.

### FAQ Section

1. Edit the **Home** page
2. Scroll to the **"FAQs"** fields
3. For each FAQ, you can edit:
   - **Question** (leave blank to hide this FAQ)
   - **Icon** (choose from the dropdown: People, Question Mark, Dollar, Clock, etc.)
   - **Answer** (a rich text editor -- you can use bold, links, and bullet lists)
4. Click **Update**

**To add a new FAQ:** Find the next empty slot and fill in the question.
**To remove a FAQ:** Clear the question field.

### Quick Links, Welcome, Organization, Why Scouting

All four of these sections are edited the same way — on the **Home** page, in
their numbered field group:

- **2. Quick Links** — the four image cards. Edit each card's title, description, and background photo.
- **3. Welcome / About** — the intro heading, body paragraphs (rich text), highlight quote, the four value tiles (Character, Citizenship, etc.), and the photo.
- **6. Organization & Dens** — the "How We're Organized" heading and all six den cards (name, grade, description), plus the den-meeting text and charter line.
- **9. Why Scouting** — the "Why Scouting Matters" heading, the six benefit cards, and the four stat numbers/labels.

Clear a card's main text field to hide it (e.g. blank a den name to drop that den card).

### About Page Story

1. Go to **Pages** > edit the **About** page
2. Edit the heading, story content, quote, or photo
3. Click **Update**

The story content field is a rich text editor -- you can use bold, italics, links, and paragraphs without knowing HTML.

### Leaders

1. Click **Leaders** in the left sidebar
2. **Add:** Click "Add New Leader", enter name, role, description, sort order, and optionally a photo
3. **Edit:** Click the leader's name, make changes, click Update
4. **Remove:** Hover over the name, click Trash
5. **Reorder:** Change the Sort Order number (lower = appears first)

### Swapping Photos

**Most photos are editable right in the page editor** (no File Manager needed):
activity cards, the welcome photo, the About photo, and the four Quick Link card
backgrounds all have an image field — click it to upload or pick a new one.

**For the remaining theme images** (hero background and the logo), replace the
file in `wp-content/themes/pack3-theme/images/` via SiteGround File Manager,
keeping the same filename:

| File | Where it appears | How to change |
|------|-----------------|---------------|
| `hero-bg.jpg` | Homepage hero background | Replace file (same name) |
| `pack3-logo.png` | Header, footer, hero | Replace file (same name) |
| `welcome-group.jpg` | Welcome section (default) | Editable in **3. Welcome** field group |
| `card-team.jpg` | Quick links – Our Team (default) | Editable in **2. Quick Links** field group |
| `card-registration.jpg` | Quick links – Registration (default) | Editable in **2. Quick Links** field group |
| `card-activities.jpg` | Quick links – Activities (default) | Editable in **2. Quick Links** field group |
| `card-faqs.jpg` | Quick links – FAQs (default) | Editable in **2. Quick Links** field group |

## Annual Checklist

At the start of each scouting year:

- [ ] Update the Hero description with the new year (e.g., "2026-2027")
- [ ] Review and update activity cards if events change
- [ ] Update registration fees in the FAQ if they change
- [ ] Review leader list -- add new den leaders, remove departed ones
- [ ] Update meeting info if the schedule changes

## What NOT to Touch

- Theme files (style.css, functions.php, etc.) -- unless doing a deliberate code update
- The ACF plugin settings -- field groups are managed by the theme code
- The Google Calendar ID in `inc/calendar-feed.php`

## If Something Looks Wrong

**Content is showing defaults instead of your edits:**
- Make sure you clicked "Update" after editing
- Make sure the correct page template is selected (Home, About, or Calendar)

**Activity or FAQ disappeared:**
- Check that the title/question field isn't empty -- empty titles hide the card

**Events not updating on homepage:**
- Calendar data is cached for 2 hours. Wait and check again.
- Make sure events are in the future (past events don't show)

## Getting Help

For content updates: Any pack volunteer with WP admin access can do everything above.

For design/code changes: Requires someone comfortable editing PHP/CSS. The codebase is straightforward.
