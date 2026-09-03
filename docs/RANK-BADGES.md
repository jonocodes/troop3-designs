# Cub Scout Rank Badges — Source & Licensing

## Current state

- **3 of 6 colored rank badges** are live on the site (Lion, Wolf, Webelos), downloaded from `scouting.org` in the colors as published by Scouting America.
- **3 of 6** (Tiger, Bear, Arrow of Light) currently use the original SVG placeholder icons. **The site owner is sourcing real PNGs and dropping them in** at `raw-html/images/ranks/rank-{tiger,bear,arrow-of-light}.png`. Once added, swap the `<svg>` for `<img src="images/ranks/rank-..." class="has-badge">` in `raw-html/index.html` like the three below.
- **Licensing**: these are official Scouting America trademarks. Use for chartered-unit Scouting purposes (a pack's own website identifying its own program) is the intended use; never modify the artwork; add a credit.

## What the official Guide says

Two relevant PDFs are kept at `docs/scouting-refs/` (July 2024 revision):

### `Official_Policy.pdf`

Establishes that insignia are **uniform marks of identification** for Scouting America members. Policy covers how they're worn on the uniform, not directly about web/print reproduction, but confirms the marks are official organizational identifiers.

### `Guidelines_for_Custom_Patches_And_Emblems.pdf` (the most relevant for reproduction rules)

Rulebook for *custom* (unit/council-made) patches, but it spells out what's reserved:

> A licensee must not produce:
> - ...
> - **Rank insignia, or patches/emblems substantially similar to rank insignia**
> - Merit badges or merit badge "knockoffs"

Key implication: **the official rank insignia is protected**, and you must not make knockoff versions. Using the official artwork (as provided by scouting.org or in the official Insignia Guide) for a chartered pack's own website is the intended path.

### Modified Trademark Use

> If modifications are made to Scouting America trademarks, they require permission from the Scouting America Licensing Team and are subject to design approval on a case-by-case basis.

**Rule for the website: render the official badges as-is** — no color shifts, no cropping, no overlay text.

### Statutory Marks (`®`, `™`)

> Patches and emblems do not require statutory markings (i.e., ®, ™, ©), except in cases where the emblem or patch is of sufficient size that these marks can be produced legibly. Typically this is a patch that is 3½ inches in diameter or larger for a round patch, or any patch that is at least 4 inches wide or tall.

Not required for web embeds.

## What the website does

1. **Use the official artwork from scouting.org / the Insignia Guide** directly.
2. **Add a credit** below the den-organization grid: "Cub Scout rank badges are trademarks of Scouting America, used with permission."
3. **Never modify** the badge artwork (no recoloring, no reskinning, no text overlays).
4. **Do not hotlink** — ship the PNGs with the site.

## Image source — what we tried, what we got

### scouting.org hosted PNGs (color, the ones we use)

URL pattern: `https://www.scouting.org/wp-content/uploads/2023/04/logos-cub-ranks-N-RANK-1-original@2x.png`

| Rank | File pattern `logos-cub-ranks-…` | Status | In use |
|---|---|---|---|
| Lion | `1-lion-1-original@2x.png` | ✅ 200 (color) | ✅ |
| Wolf | `3-wolf-1-original@2x.png` | ✅ 200 (color) | ✅ |
| Webelos | `5-webelos-1-original@2x.png` | ✅ 200 (color) | ✅ |
| Tiger | `2-tiger-1-original@2x.png` | ❌ 404 | owner adding |
| Bear | `4-bear-1-original@2x.png` | ❌ 404 | owner adding |
| Arrow of Light | `6-arrow-of-light-1-original@2x.png` | ❌ 404 | owner adding |

Other URL variants tried: `original.png`, `original2x.png`, with and without `1-` prefix, `6-aol-` — all 404. Not indexed by Google. Not linked from the Tiger/Bear/AOL adventure pages on scouting.org (verified via Playwright DOM scrape of those pages).

### Insignia Guide PDF fallback (tried and abandoned — B&W was jarring on a colorful site)

Page 4 of `docs/scouting-refs/33066-24-Cub_Scout_Insignia.pdf` does contain every badge, but only as black-and-white line art, which clashed with the site's colorful design. Stuck with the colored scouting.org versions for the three we have, rather than show the den grid in mixed color/B&W.

The Arrow of Light badge **is not a separate image in the PDF either** — page 3 states: *"The Webelos badge of rank does not go on the blue Cub Scout uniform; it is designed to be placed on the tan Scouts BSA uniform shirt"*. In other words, **Webelos Scouts and Arrow of Light Scouts wear the same oval badge** in real scouting.

## How the site owner should add the missing 3

1. Get the colored Tiger, Bear, and Arrow of Light badge PNGs from scouting.org. Reasonable approaches:
   - Ask your **local council's marketing contact** — they routinely provide rank-badge asset bundles to chartered units.
   - Email **`licensing@scouting.org`** directly with a request as the chartered unit.
   - Crop the colored PDF page from the Insignia Guide, but recolor to match — this would require permission, so prefer the above.
2. Save as `raw-html/images/ranks/rank-tiger.png`, `rank-bear.png`, `rank-arrow-of-light.png`.
3. In `raw-html/index.html`, find each den card's `.den-icon` div and swap the inner `<svg>...</svg>` for `<img src="images/ranks/rank-<name>.png" alt="<Rank> rank badge">`. Add the `has-badge` class to the `.den-icon` div so the tile expands to 96×96.
4. Repeat for all three.

## What is currently wired up

| Rank | Currently in den grid | Tile size | Source |
|---|---|---|---|
| Lion | `images/ranks/rank-lion.png` (color) | 96×96 (`.has-badge`) | scouting.org |
| Tiger | SVG placeholder (orange tiger face) | 56×56 (default) | original design |
| Wolf | `images/ranks/rank-wolf.png` (color) | 96×96 (`.has-badge`) | scouting.org |
| Bear | SVG placeholder (purple paw) | 56×56 (default) | original design |
| Webelos | `images/ranks/rank-webelos.png` (color) | 96×96 (`.has-badge`) | scouting.org |
| Arrow of Light | SVG placeholder (forest medal) | 56×56 (default) | original design |

CSS rule: `.den-icon { width: 56px; height: 56px; }` is the default for SVG icons; `.den-icon.has-badge { width: 96px; height: 96px; }` is for badge images. The `.den-icon img` rule scales badges via `object-fit: contain` so they fit cleanly without distortion.

The credit line under the grid reads: "Cub Scout rank badges are trademarks of Scouting America, used with permission."
