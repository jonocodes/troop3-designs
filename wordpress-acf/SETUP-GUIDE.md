# Pack 3 WordPress Theme (ACF) - Setup Guide

Step-by-step instructions for installing the theme on a fresh WordPress install on SiteGround.

## 1. Create a New WordPress Install on SiteGround

1. Log into SiteGround > Site Tools
2. Go to **WordPress > Install & Manage**
3. Click **Install** and choose a subdomain or new domain
4. Complete the install (pick your admin username/password)
5. Log into the new WordPress admin at `yourdomain.com/wp-admin`

## 2. Install the ACF Plugin

1. In WP Admin > **Plugins > Add New**
2. Search for **"Advanced Custom Fields"**
3. Install the one by **WP Engine** (it should be the first result, 2M+ installs)
4. Click **Activate**

## 3. Install the Theme

### Option A: Upload via Admin (recommended)

1. Zip the `pack3-theme/` folder:
   ```
   cd wordpress-acf/
   zip -r pack3-theme.zip pack3-theme/
   ```
2. In WP Admin > **Appearance > Themes > Add New > Upload Theme**
3. Upload `pack3-theme.zip` and click **Install**
4. Click **Activate**

### Option B: Upload via FTP/File Manager

1. In SiteGround Site Tools > **File Manager**
2. Navigate to `public_html/wp-content/themes/`
3. Upload the entire `pack3-theme/` folder
4. In WP Admin > **Appearance > Themes**, find "Pack 3 Albany" and activate it

## 4. Copy Images

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

## 5. Create Pages

Create three pages in WP Admin > **Pages > Add New**:

### Home page
- Title: `Home`
- Template: Select **"Home"** from the Page Attributes > Template dropdown
- Publish

### About page
- Title: `About`
- Slug: `about`
- Template: Select **"About"**
- Publish

### Calendar page
- Title: `Calendar`
- Slug: `calendar`
- Template: Select **"Calendar"**
- Publish

## 6. Set the Homepage

1. Go to **Settings > Reading**
2. Select **"A static page"**
3. Set "Homepage" to your **Home** page
4. Save Changes

## 7. Fill in Content

### Home page content

1. Go to **Pages** > edit the **Home** page
2. Below the main editor, you'll see labeled field groups:

**Hero Section** - Fill in the headline, subtitle, and description text. These have sensible defaults already.

**Meeting Info** - Update the meeting day, time, venue name, and address.

**Activity Cards** - Fill in up to 6 activity cards. Each has fields for title, when, where, description, and a photo upload. Leave the title blank to skip a slot.

**FAQs** - Fill in up to 8 FAQ items. Each has a question, icon selector, and a rich text answer editor. Leave the question blank to skip a slot.

3. Click **Update**

### About page content

1. Edit the **About** page
2. Fill in the story heading, story content (rich text), highlight quote, and optionally upload a photo
3. Click **Update**

### Leaders

1. In the left sidebar, click **Leaders > Add New Leader**
2. Enter name as the title, fill in Role, Description, Sort Order
3. Optionally set a Featured Image (their photo)
4. Publish
5. Repeat for each leader

## 8. Verify Everything Works

- [ ] Homepage loads with your content from the ACF fields
- [ ] Hero shows upcoming events from Google Calendar
- [ ] Activity cards show the ones you filled in (empty slots are hidden)
- [ ] FAQs show the ones you filled in with working accordion
- [ ] About page shows your story text and leaders
- [ ] Calendar page shows the embedded Google Calendar
- [ ] Mobile menu works
- [ ] Back-to-top button appears when scrolling

## Troubleshooting

### ACF fields not showing on the page edit screen
- Make sure ACF plugin is installed AND activated
- Make sure you selected the correct page Template ("Home" or "About") before saving
- ACF field groups are tied to the page template -- they only appear when the right template is selected

### Fields are blank / showing defaults
- The theme shows default content if fields are empty. Just fill in the fields and click Update.

### "Pack 3 Theme requires Advanced Custom Fields" admin notice
- This appears if ACF isn't activated. Install and activate it from Plugins > Add New.

### Activity card not showing
- Make sure the Title field is filled in. Cards with empty titles are skipped.

### FAQ not showing
- Same as above -- the Question field must be filled in. Empty questions are skipped.
