# Pack 3 Website - Platform Decision Summary

## Goal

Build a website for Albany Cub Scouts Pack 3 that:
1. Looks professional with a forest/scout theme
2. The site owner can easily edit text and images without technical knowledge
3. No ongoing developer maintenance required

---

## Platforms Considered

### Squarespace

**Pros:**
- Clean, professional templates
- Easy visual editor for content
- Built-in hosting and SSL
- Good for non-technical users

**Cons:**
- Custom CSS requires Business plan ($33/month vs $16/month for Personal)
- Code Injection (for scripts/advanced CSS) also requires Business plan
- Personal plan has no way to add global custom styling

### Wix

**Pros:**
- More granular visual design controls (can style individual elements without CSS)
- Custom fonts, colors, spacing all adjustable in the editor
- Lower cost plans still allow visual customization
- Drag-and-drop flexibility

**Cons:**
- Can feel cluttered with options
- Less "polished" default templates than Squarespace
- Ads on free plan

---

## Key Finding: Squarespace Custom CSS Limitations

During setup, we discovered:

1. **Custom CSS** (Design → Custom CSS) - Not available on all plans, location varies by Squarespace version
2. **Code Injection** (Settings → Advanced → Code Injection) - Only available on Business plan and above
3. **Personal plan** (~$16/month) has no way to inject custom CSS globally

This means achieving a custom design look on Squarespace Personal plan requires using only the built-in Site Styles settings.

---

## Decision: Squarespace with Native Site Styles

We chose to build using **Squarespace's native features only** (no custom CSS) because:

1. **Owner independence** - The site owner can edit everything without touching code
2. **No upgrade required** - Works on any Squarespace plan, including Personal
3. **Lower risk** - No custom code that could break or need maintenance
4. **80-90% of the design** is achievable through Site Styles (fonts, colors, buttons, section backgrounds)

**What we give up:**
- Subtle hover animations
- Pixel-perfect spacing matching the original design
- Some decorative elements (rounded card corners, custom shadows)

**What we keep:**
- Forest green / cream / orange color scheme
- Rounded buttons
- Professional typography (Nunito/Poppins fonts)
- All content sections and layout structure
- Easy editing for the owner

---

## Alternative: Wix

If Squarespace's native styling proves too limiting, **Wix is a good alternative** because:

- Visual controls let you customize fonts, colors, spacing on individual elements
- No CSS needed to achieve custom looks
- Similar ease-of-editing for the owner
- Comparable pricing

Wix would require rebuilding the site from scratch but offers more design flexibility without code.

---

## Content Decision: Removed "Values We Live By" Section

We removed the Scout Values section (Scout Oath, Scout Law, Scout Mission, 12 Points) because:
- It appeared to be a direct copy from another troop's website (Mill Valley)
- Reduces page length
- Core scout values are still mentioned in other sections (Welcome, Why Scouting Matters)

---

## Final Deliverables

| File | Purpose |
|------|---------|
| `index.html` | The complete design (for reference/preview) |
| `SQUARESPACE-GUIDE-NO-CSS.md` | Step-by-step build instructions using only native Squarespace features |
| `images/` | All photos needed for the site |
| `PLATFORM-DECISION.md` | This document |

---

## Recommendation

**Use Squarespace with the no-CSS guide** if:
- You want the simplest setup
- The owner is comfortable with Squarespace's editor
- You're okay with the design being "close" but not pixel-perfect

**Consider Wix instead** if:
- You want more design control without upgrading plans
- The Squarespace native styling feels too limiting
- You're starting fresh anyway

**Upgrade to Squarespace Business** if:
- You need pixel-perfect design matching
- You want custom animations or advanced features
- Budget allows for ~$33/month

---

## Site Sections (Final)

1. **Hero** - Welcome banner with camping background, event info, CTA buttons
2. **Quick Links** - 4 image cards (Team, Registration, Activities, FAQs)
3. **Welcome/About** - Introduction to Pack 3, values grid, group photo
4. **Pack Organization** - Den cards (Lion through Arrow of Light), meeting info
5. **Activities** - Pinewood Derby, Campouts, Pancake Breakfast, Egg Drop, more
6. **Why Scouting Matters** - Benefits grid, stats bar
7. **FAQs** - Accordion with common questions
8. **Footer** - Contact info, links, social media
