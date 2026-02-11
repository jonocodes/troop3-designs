# Pack 3 WordPress Theme - Setup Guide

Step-by-step instructions for installing the theme on a fresh WordPress install on SiteGround.

## 1. Create a New WordPress Install on SiteGround

1. Log into SiteGround → Site Tools
2. Go to **WordPress → Install & Manage**
3. Click **Install** and choose a subdomain or new domain
4. Complete the install (pick your admin username/password)
5. Log into the new WordPress admin at `yourdomain.com/wp-admin`

## 2. Install the Theme

### Option A: Upload via Admin (recommended)

1. Zip the `pack3-theme/` folder:
   ```
   cd wordpress-theme/
   zip -r pack3-theme.zip pack3-theme/
   ```
2. In WP Admin → **Appearance → Themes → Add New → Upload Theme**
3. Upload `pack3-theme.zip` and click **Install**
4. Click **Activate**

### Option B: Upload via FTP/File Manager

1. In SiteGround Site Tools → **File Manager**
2. Navigate to `public_html/wp-content/themes/`
3. Upload the entire `pack3-theme/` folder
4. In WP Admin → **Appearance → Themes**, find "Pack 3 Albany" and activate it

## 3. Copy Images

Copy all images from `winning-design-6/images/` into the theme's `images/` folder:

```
pack3-theme/images/
  hero-bg.jpg
  pack3-logo.png
  welcome-group.jpg
  card-team.jpg
  card-registration.jpg
  card-activities.jpg
  card-faqs.jpg
  activity-derby.jpg
  activity-camping.jpg
  activity-hiking.jpg
  activity-service.jpg
```

If uploading via FTP/File Manager, put them in:
`wp-content/themes/pack3-theme/images/`

## 4. Create Pages

Create three pages in WP Admin → **Pages → Add New**:

### Home page
- Title: `Home`
- Template: Select **"Home"** from the Page Attributes → Template dropdown
- Publish

### About page
- Title: `About`
- Slug: `about` (check under permalink settings)
- Template: Select **"About"**
- Publish

### Calendar page
- Title: `Calendar`
- Slug: `calendar`
- Template: Select **"Calendar"**
- Publish

## 5. Set the Homepage

1. Go to **Settings → Reading**
2. Select **"A static page"**
3. Set "Homepage" to your **Home** page
4. Save Changes

## 6. Add Leaders

1. In the left sidebar, click **Leaders → Add New Leader**
2. Enter the leader's name as the title
3. Fill in **Role** (e.g., "Cubmaster"), **Description**, and **Sort Order**
4. Optionally set a **Featured Image** (their photo)
5. Publish
6. Repeat for each leader

Leaders appear on the About page, sorted by the Sort Order field (lower numbers first).

## 7. Update Meeting Info (optional)

1. Go to **Pages** and edit the **Home** page
2. Scroll down to the **"Pack Meeting Info"** meta box
3. Update the meeting day, time, venue name, and address
4. Save/Update the page

These values appear in the Organization section and footer.

## 8. Verify Everything Works

- [ ] Homepage loads with all sections
- [ ] Hero shows upcoming events from Google Calendar (may take a moment on first load)
- [ ] About page shows leaders you added
- [ ] Calendar page shows the embedded Google Calendar
- [ ] Mobile menu works (resize browser or test on phone)
- [ ] FAQ accordion expands/collapses
- [ ] Back-to-top button appears when scrolling

## Troubleshooting

### "No upcoming events" on homepage
- The Google Calendar feed is cached for 2 hours. New events may take up to 2 hours to appear.
- Make sure the Google Calendar is set to **public** (it already is based on the embed URL working).
- Check that the calendar ID in `inc/calendar-feed.php` matches your calendar.

### Images not loading
- Make sure images are in `wp-content/themes/pack3-theme/images/` (not a subfolder).
- File names are case-sensitive on Linux servers.

### Page shows default content instead of template
- Make sure you selected the correct **Template** in the Page Attributes sidebar when editing each page.
- The template names are: "Home", "About", "Calendar".

### Leaders not appearing
- Make sure leaders are **Published** (not Draft).
- Check that the Sort Order field has a value (default is 10).
