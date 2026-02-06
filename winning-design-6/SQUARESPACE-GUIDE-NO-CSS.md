# Pack 3 Website - Squarespace Build Guide (No Custom CSS)

This guide builds the Pack 3 website using **only native Squarespace features**. No coding required. The site owner can easily edit all text and images.

---

## Step 1: Site Styles Setup

Go to **Design → Site Styles** and configure:

### Fonts

| Setting | Recommended Choice |
|---------|-------------------|
| Headings | **Poppins** or **Nunito** (Bold/700) |
| Body Text | **Nunito** or **Open Sans** (Regular/400) |

*If Nunito isn't available, Poppins or Lato work well*

### Site Colors

Add these colors to your palette:

| Color Name | Hex Code | What It's For |
|------------|----------|---------------|
| Forest Dark | `#1a4d2e` | Dark green sections, footer |
| Forest | `#2d6a4f` | Links, accents |
| Cream | `#f8f6f0` | Main page background |
| Campfire Orange | `#e07c3e` | Buttons, highlights |
| Gold | `#daa520` | Special accent text |

### Buttons

| Setting | Value |
|---------|-------|
| Button Shape | **Pill** or maximum rounded corners |
| Primary Button Background | Campfire Orange (`#e07c3e`) |
| Primary Button Text | White |
| Secondary Button | Outline style, white or Forest |

### Global Settings

| Setting | Value |
|---------|-------|
| Site Background | Cream (`#f8f6f0`) |
| Link Color | Forest (`#2d6a4f`) |
| Border Radius (if available) | Rounded/Large |

---

## Step 2: Upload Images

Before building pages, upload all images to your Squarespace library.

Go to **Assets** (or upload as you build) and add:

| Filename | Description |
|----------|-------------|
| hero-bg.jpg | Hero background (camping scene) |
| pack3-logo.png | Pack 3 logo |
| welcome-group.jpg | Group photo for About section |
| card-team.jpg | Quick link card - team |
| card-registration.jpg | Quick link card - registration |
| card-activities.jpg | Quick link card - activities |
| card-faqs.jpg | Quick link card - FAQs |
| activity-derby.jpg | Pinewood Derby photo |
| activity-camping.jpg | Camping photo |
| activity-service.jpg | Pancake breakfast photo |
| activity-hiking.jpg | Hiking/outdoor photo |

---

## Step 3: Build the Page

Create a new page or edit your homepage. Build these sections in order:

---

### SECTION 1: Hero

**Add:** Banner Section (or Page Header)

**Settings:**
- Background: Upload `hero-bg.jpg`
- Overlay: Dark green (`#1a4d2e`) at 60-70% opacity
- Height: Large or Full
- Content alignment: Left
- Section ID: `home`

**Add these blocks:**

1. **Text Block** (small, for badge):
   ```
   REGISTRATION ALWAYS OPEN
   ```
   - Make it small, bold, uppercase
   - If possible, set background to orange with white text

2. **Text Block** (Heading 1):
   ```
   Albany Cub Scouts Pack 3
   ```
   - Color: White
   - Size: Large

3. **Text Block** (Heading 3 or Large text):
   ```
   Are you ready for more s'mores, skits, badges, and outdoor fun?
   ```
   - Color: Gold (`#daa520`)

4. **Text Block** (paragraph):
   ```
   Albany Pack 3 is back in action for 2025-2026! We're an inclusive pack welcoming all kids in Kindergarten through Fifth Grade.
   ```
   - Color: White

5. **Text Block** (event info):
   ```
   PARENT INFO EVENT
   Thursday, August 21, 2025
   6:30 PM - 7:30 PM
   Memorial Hall, Memorial Park
   ```
   - Style with white text
   - Consider adding a subtle background if your template supports it

6. **Button Block**:
   - Text: `Join Pack 3`
   - Style: Primary (orange)
   - Link: `#faqs` (or your registration link)

7. **Button Block**:
   - Text: `About Cub Scouts`
   - Style: Secondary (outline)
   - Link: `#about`

8. **Image Block** (optional, on right side if 2-column layout):
   - Upload `pack3-logo.png`
   - Size: Medium-Large

---

### SECTION 2: Quick Links (4 Cards)

**Add:** Gallery Section or 4-Column Layout

**Settings:**
- Background: Cream (`#f8f6f0`) or White
- Layout: 4 columns, equal width

**Option A - Use Image Blocks with Overlay Text:**

For each of the 4 cards, add an Image Block:

| Position | Image | Title | Description | Link |
|----------|-------|-------|-------------|------|
| 1 | card-team.jpg | Our Team | Meet the Pack 3 leadership | #about |
| 2 | card-registration.jpg | Registration | Learn about fees & joining | #faqs |
| 3 | card-activities.jpg | Activities | Explore events & adventures | #activities |
| 4 | card-faqs.jpg | Scouting FAQs | Common questions answered | #faqs |

- Enable image overlay or caption
- Add title and short description to each

**Option B - Use Summary Block:**

If your template has a Summary Block, you can create 4 small pages or blog posts (one for each card) and display them as a grid.

---

### SECTION 3: Welcome / About

**Add:** Section with 2 columns

**Settings:**
- Background: Cream (`#f8f6f0`)
- Layout: 2 columns (text left, image right)
- Section ID: `about`
- Padding: Medium-Large

**Left Column - Add these Text Blocks:**

1. **Small label text:**
   ```
   WELCOME TO ALBANY CUB SCOUTS PACK 3
   ```
   - Small size, uppercase, orange color, bold

2. **Heading 2:**
   ```
   Are you ready for more s'mores, skits, badges, and outdoor fun?
   ```
   - Highlight "s'mores, skits, badges, and outdoor fun" in Forest green if possible

3. **Paragraph:**
   ```
   Albany Cub Scouts are kids in kindergarten through fifth grade who join a pack to go hiking, play games, learn skills, make friends, and much, much more.
   ```

4. **Paragraph:**
   ```
   Cub Scouting means "doing". You have lots to do as a Cub Scout—hiking, camping, crafts, games, sports, songs, stories, and puzzles, to name just a few things.
   ```

5. **Paragraph:**
   ```
   Scouts also participate in events like the annual Blue and Gold banquet, the Pinewood Derby, an Egg Drop, and our Pancake Breakfast.
   ```

6. **Quote Block:**
   ```
   "Albany Pack 3 has a long and proud history of service to Albany's youth and to the community as a whole."
   ```

7. **Text Block** (values - use a simple list or 2x2 if your template supports):
   ```
   CHARACTER - Building strong moral values
   CITIZENSHIP - Community responsibility
   FITNESS - Healthy active lifestyles
   LEADERSHIP - Developing future leaders
   ```

**Right Column:**

1. **Image Block:**
   - Upload `welcome-group.jpg`
   - Rounded corners if available

---

### SECTION 4: Pack Organization

**Add:** Section with centered content

**Settings:**
- Background: White or Light Cream
- Section ID: `organization`

**Header (centered):**

1. **Small label:**
   ```
   HOW WE'RE ORGANIZED
   ```
   - Orange, uppercase, small, bold

2. **Heading 2:**
   ```
   Pack Organization
   ```

3. **Paragraph (centered):**
   ```
   Albany Cub Scouts Pack 3 is made up of dens organized by age group. Different grade levels work toward achieving the rank for that year.
   ```

**Den Cards (3 columns x 2 rows = 6 cards):**

Use Text Blocks in a grid layout:

| Den | Grade | Description |
|-----|-------|-------------|
| **Lion** | Kindergarten | Our youngest scouts start their adventure with fun activities and family involvement! |
| **Tiger** | 1st Grade | Building confidence and new skills while exploring the world around them. |
| **Wolf** | 2nd Grade | Exploring the outdoors and learning about our community together. |
| **Bear** | 3rd Grade | Taking on bigger challenges and developing teamwork skills. |
| **Webelos** | 4th Grade | We Be Loyal Scouts - preparing for the next step in their journey. |
| **Arrow of Light** | 5th Grade | The highest rank in Cub Scouting before bridging to Scouts BSA. |

**Meeting Info Box:**

Add a new row/section with dark green background (`#1a4d2e`):

1. **Heading 3** (white text):
   ```
   Pack Meetings
   ```

2. **Paragraph** (white text):
   ```
   The whole Pack meets the first Thursday of every month at the Veterans Memorial Building, usually from 6:30 to 8pm. The entire family is welcome.

   Location: Veterans Memorial Hall, 1325 Portland Avenue
   ```

3. **Heading 3** (white text):
   ```
   Den Meetings
   ```

4. **Paragraph** (white text):
   ```
   Each den establishes its own meeting schedule, usually 1-2 times per month. At den meetings, Scouts work on advancements and learn skills.

   For Lion and Tiger Scouts, a parent is expected to join their Scout at meetings.
   ```

---

### SECTION 5: Activities

**Add:** Section

**Settings:**
- Background: Cream or White
- Section ID: `activities`

**Header (centered):**

1. **Small label:**
   ```
   PACK 3 ACTIVITIES
   ```

2. **Heading 2:**
   ```
   What's it like to be in Pack 3?
   ```

3. **Paragraph:**
   ```
   Check out some of our annual activities. From outdoor adventures to community service, there's always something exciting happening!
   ```

**Activity Cards (2x2 grid):**

Use Image Blocks with captions, or a Gallery Block:

| Activity | Image | When | Where |
|----------|-------|------|-------|
| **Pinewood Derby** | activity-derby.jpg | January (Sunday) | Veterans Memorial Building |
| **Family Campouts** | activity-camping.jpg | Spring & Fall | Various Campgrounds |
| **Pancake Breakfast** | activity-service.jpg | February (Sunday) | Veterans Memorial Building |
| **Annual Egg Drop** | activity-hiking.jpg | Spring | TBD |

For each card, include:
- Image
- Activity name (bold)
- Short description
- When & Where info

**More Activities List:**

Add a Text Block:
```
MORE PACK ACTIVITIES

Hiking (local park trails) • Community Service • Flag Placement on Veterans' Graves • Ice Skating • Bike Rides • Water Park • Blue and Gold Banquet
```

**Community Service Box:**

Add a Text Block with light orange/cream background if possible:
```
COMMUNITY SERVICE

Our scouts participate in various community service activities including: Scouting for Food, Earth Day cleanup, Storm drain stewardship, Beach Cleanup, and Flag Placement on holidays at Veterans' cemetery.
```

**Button (centered):**
- Text: `View Pack Calendar`
- Style: Primary (orange)

---

### SECTION 6: Why Scouting Matters

**Add:** Section

**Settings:**
- Background: White
- Padding: Large

**Header (centered):**

1. **Small label** (orange):
   ```
   BUILDING SKILLS FOR LIFE
   ```

2. **Heading 2:**
   ```
   Why Scouting Matters
   ```

3. **Paragraph:**
   ```
   Cub Scouting is focused on fun and friendship, and along the way we nurture personal growth and social skills.
   ```

**Benefit Cards (3 columns x 2 rows):**

| Benefit | Description |
|---------|-------------|
| **Leadership Development** | Scouts share in adventure and take turns leading, building confidence and communication skills. |
| **Outdoor Skills** | Scouts learn how to safely enjoy and care for the outdoors through camping, hiking, and nature activities. |
| **Participatory Citizenship** | Civic awareness and patriotism with an emphasis on service to the community. |
| **Personal Fitness** | Healthy eating and an active lifestyle are encouraged through physical activities and sports. |
| **Character Building** | We seek to develop good character, guided by the Scout Oath, Scout Law, and Scout Mission. |
| **Lifelong Friendship** | Make lifelong friends and create memories that will last a lifetime through shared experiences. |

**Stats Bar:**

Add a row with Forest green background (`#2d6a4f`), 4 columns:

| Stat | Label |
|------|-------|
| **100+** | Years of Scouting |
| **2M+** | Scouts Nationwide |
| **130+** | Merit Badges |
| **Since 1935** | Pack 3 Albany |

- Numbers: Large, bold, gold color
- Labels: Smaller, white

---

### SECTION 7: FAQs

**Add:** Section with Accordion Block

**Settings:**
- Background: Cream (`#f8f6f0`)
- Section ID: `faqs`

**Header (centered):**

1. **Small label:**
   ```
   GOT QUESTIONS?
   ```

2. **Heading 2:**
   ```
   Frequently Asked Questions
   ```

3. **Paragraph:**
   ```
   Everything you need to know about joining and participating in Albany Pack 3.
   ```

**Accordion Block - Add these FAQ items:**

---

**Q: Who Can Participate?**

A: Anyone in kindergarten through fifth grades! Starting in 2018, we welcomed girls to join the cub scouts.

Albany's Pack 3 has always prided itself on being an inclusive unit that represents the diversity of our community. We are strongly committed to creating a welcoming environment for all children who wish to join our Pack.

We are proud to be designated as an Inclusive Unit by Scouts for Equality.

---

**Q: How Does Cub Scouts Work?**

A: Cub Scouts is a family program for all kids interested in having fun, learning life skills, building community, exploring the outdoors, becoming leaders and good citizens, and making friends.

The basic structure is a "pack" which includes all Scouts from kindergarten through fifth grades. Each grade has one or more "dens" that meet in smaller groups to work on adventures.

---

**Q: What Are the Ranks?**

A:
- Kindergarten = Lion
- First Grade = Tiger
- Second Grade = Wolf
- Third Grade = Bear
- Fourth Grade = Webelos (We Be Loyal Scouts)
- Fifth Grade = Arrow of Light (AOL)

In their fifth grade year, scouts "bridge" to Boy Scouts.

---

**Q: How Much Does Cub Scouts Cost?**

A: Annual registration fee is $300.00 per child ($275 for returning scouts) paid by check or Zelle. Fees cover activities, achievements, badges and a Pack t-shirt.

The basic uniform (shirt, hat, neckerchief, slide, patches) can add up to $100 or so. Check with us before buying - our pack re-uses shirts and gear!

A limited number of scholarships are available for those in need.

---

**Q: What Is the Time Commitment?**

A: The Pack meets once a month on a Thursday evening from 6:30 to 7:30. Dens meet once or twice monthly.

There are at least two family campouts per year (fall and spring), usually Friday to Sunday. For 2025-2026, we have scheduled 4 total campouts!

Other activities include Pinewood Derby, Pancake Breakfast, community service projects, and seasonal hikes.

---

**Contact line (below accordion):**

```
Still have questions? Contact our Cubmaster!
cubmaster@albanycubscouts.org
```

---

### SECTION 8: Footer

**Configure in:** Design → Footer (or your template's footer settings)

**Settings:**
- Background: Forest Dark (`#1a4d2e`)
- Text color: White
- Link color: White (hover: Gold)

**Footer Layout (4 columns if possible):**

**Column 1 - About:**
- Pack 3 logo image
- "Pack 3 - Albany, CA"
- "Building character, citizenship, and personal fitness in young people through fun outdoor adventures and community service since 1935."
- Social media icons (Instagram, Facebook)

**Column 2 - Quick Links:**
- Home
- About
- Organization
- Activities
- FAQs
- Join Pack 3

**Column 3 - Resources:**
- Scouting America (link to scouting.org)
- Youth Protection Training
- Golden Gate Council
- Pack Calendar

**Column 4 - Contact:**
- Email: cubmaster@albanycubscouts.org
- Address: Veterans Memorial Hall, 1325 Portland Avenue, Albany, CA 94706
- Pack Meetings: First Thursday of each month, 6:30 PM - 7:30 PM

**Footer Bottom:**
```
© 2025 Albany Cub Scout Pack 3. All rights reserved.
```

---

## Step 4: Navigation Setup

Go to **Pages → Main Navigation**

Add these links:

| Menu Label | Link To |
|------------|---------|
| Home | / or /#home |
| About | /#about |
| Organization | /#organization |
| Activities | /#activities |
| FAQs | /#faqs |
| Contact | /#contact |

**Header Button** (if your template supports it):
- Text: "Join Pack 3"
- Link: /#faqs (or external registration link)
- Style: Primary button

---

## Editing Guide for Site Owner

### To Edit Text:
1. Log into Squarespace
2. Click "Edit" on your page
3. Click on any text block
4. Type your changes
5. Click "Save" (top right)

### To Change an Image:
1. Click "Edit" on your page
2. Click on the image
3. Click the gear icon or "Edit"
4. Click "Replace" or "Delete" and add new
5. Click "Save"

### To Edit FAQ Questions:
1. Click "Edit" on your page
2. Click on the Accordion block
3. Click any question to edit it
4. Click "Save"

### To Change Colors or Fonts:
1. Go to Design → Site Styles
2. Find the setting you want to change
3. Select new color or font
4. Click "Save"

### Things You CAN Safely Change:
- Any text content
- Any images
- Button text and links
- FAQ questions and answers
- Footer contact info

### Things to Be Careful With:
- Section backgrounds (keep the color scheme)
- Deleting entire sections
- Changing fonts (keep it consistent)

---

## Color Quick Reference

Keep this handy when setting section backgrounds:

| Section | Background Color |
|---------|-----------------|
| Hero | Image with dark overlay |
| Quick Links | White or Cream |
| Welcome/About | Cream (`#f8f6f0`) |
| Organization | White, Meeting box: Forest Dark |
| Activities | Cream or White |
| Why Scouting | White, Stats: Forest (`#2d6a4f`) |
| FAQs | Cream (`#f8f6f0`) |
| Footer | Forest Dark (`#1a4d2e`) |

---

## Need Help?

If something looks wrong or you need to make a bigger change, contact your web designer before making changes to:
- Site Styles (fonts, colors)
- Section layouts
- Navigation structure
