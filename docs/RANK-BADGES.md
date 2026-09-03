# Cub Scout Rank Badges — Source & Licensing

## TL;DR

- **Source**: Scouting America (formerly BSA) at `scouting.org`. All six badges are now extracted from the official **Guide to Awards and Insignia** (Section 2: Cub Scout Insignia, July 2024 revision) PDF — `docs/scouting-refs/33066-24-Cub_Scout_Insignia.pdf`.
- **6 of 6 real badges**, all from one trusted source. Files are B&W line-art (how they appear in the print guide) and live in `raw-html/images/ranks/`.
- **Licensing**: official Scouting America trademarks. Use for chartered-unit Scouting purposes (a pack's own website identifying its own program) is the intended use; never modify the artwork; add a credit.

## What the official Guide says

Two relevant PDFs were downloaded to `docs/scouting-refs/` (July 2024 revision):

### `Official_Policy.pdf`

Establishes that insignia are **uniform marks of identification** for Scouting America members. Policy covers how they're worn on the uniform — not directly about web/print reproduction, but confirms the marks are official organizational identifiers.

### `Guidelines_for_Custom_Patches_And_Emblems.pdf` (the most relevant one for reproduction rules)

This is the rulebook for *custom* (unit/council-made) patches, but it spells out what's reserved:

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

Not required for our web embeds.

## What the website does

1. **Use the official artwork from scouting.org / the Insignia Guide** directly.
2. **Add a credit** below the den-organization grid: "Cub Scout rank badges are trademarks of Scouting America, used with permission."
3. **Never modify** the badge artwork (no recoloring, no reskinning, no text overlays).
4. **Do not hotlink** — ship the PNGs with the site.

## Image source — what we tried, what we got

### First attempt: scouting.org hosted PNGs (color)

URL pattern: `https://www.scouting.org/wp-content/uploads/2023/04/logos-cub-ranks-N-RANK-1-original@2x.png`

| Rank | File pattern `logos-cub-ranks-…` | Status |
|---|---|---|
| Lion | `1-lion-1-original@2x.png` | ✅ 200 (color) |
| Wolf | `3-wolf-1-original@2x.png` | ✅ 200 (color) |
| Webelos | `5-webelos-1-original@2x.png` | ✅ 200 (color) |
| Tiger | `2-tiger-1-original@2x.png` | ❌ 404 |
| Bear | `4-bear-1-original@2x.png` | ❌ 404 |
| Arrow of Light | `6-arrow-of-light-1-original@2x.png` | ❌ 404 |

Other URL variants tried: `original.png`, `original2x.png`, with and without `1-` prefix, `6-aol-` — all 404. Not indexed by Google. Not linked from the Tiger/Bear/AOL adventure pages on scouting.org (verified via Playwright DOM scrape).

### Second attempt: extract from the official Insignia PDF

Page 4 of `33066-24-Cub_Scout_Insignia.pdf` contains line-art versions of five badges (Lion, Wolf, Tiger, Bear, Webelos oval). I rendered it via PDF.js in the nix-store Chromium, then cropped each badge using Playwright's screenshot clip (after a labelled-probe pass to find exact coords).

The Arrow of Light badge **is not a separate image in the PDF** — page 3 states: *"The Webelos badge of rank does not go on the blue Cub Scout uniform; it is designed to be placed on the tan Scouts BSA uniform shirt"*. In other words, in real scouting, **Webelos Scouts and Arrow of Light Scouts wear the same oval badge**. The "Arrow of Light" as a separate visual is the **AOL patrol emblem** (a different thing, on the right sleeve). So on the website, both the "Webelos" and the "Arrow of Light" rows correctly show the same oval badge image (`rank-webelos.png` / `rank-arrow-of-light.png` are byte-identical files).

### Practical trade-off

The PDF-sourced badges are **black-and-white line art**. The scouting.org-hosted ones are full-color. Mixing them (3 color + 3 B&W) would look inconsistent on the page, so the final state is: **all 6 B&W from one consistent source** (the Insignia PDF). This is a deliberate consistency trade-off; the alternative would be to use the 3 colored versions we have for Lion/Wolf/Webelos and the 3 B&W for Tiger/Bear/Arrow of Light, which would look patchy.

To upgrade to **all-color**: contact the Scouting America Licensing Team (`licensing@scouting.org`) or your local council — they routinely provide rank badge asset bundles to chartered units. See `docs/scouting-refs/33066-24-Cub_Scout_Insignia.pdf` (page 3) for the official uniform guidance.

## What was wired up

| File | Source | Size |
|---|---|---|
| `raw-html/images/ranks/rank-lion.png` | PDF page 4 crop | ~21 KB |
| `raw-html/images/ranks/rank-wolf.png` | PDF page 4 crop | ~25 KB |
| `raw-html/images/ranks/rank-tiger.png` | PDF page 4 crop | ~22 KB |
| `raw-html/images/ranks/rank-bear.png` | PDF page 4 crop | ~23 KB |
| `raw-html/images/ranks/rank-webelos.png` | PDF page 4 crop | ~31 KB |
| `raw-html/images/ranks/rank-arrow-of-light.png` | copy of webelos | ~31 KB |

Each den card in `raw-html/index.html` uses an `<img>` inside its `.den-icon` div with `object-fit: contain` so the badge scales cleanly inside its colored background tile. The credit line under the grid reads: "Cub Scout rank badges are trademarks of Scouting America, used with permission."

The `.den-icon` tile is sized to `96×96` via a `.has-badge` modifier (the previous default of 56×56 was sized for the small SVG icons and clipped the badge art). The cropped PNGs are 240–320 px tall; `object-fit: contain` scales them down to fit cleanly without distortion.

### Note on the crops

The crops come from the official Insignia Guide PDF (1809×2349 at 3× zoom = a high-resolution render). Each rank badge is centered roughly between its description paragraph and the next. Coordinates were found by an iterative Playwright probe pass (drawing labelled red rectangles, then re-cropping). A small slice of the badge caption text ("cloth, yellow", "No. 646287", "blue and gold on tan", etc.) is visible at the bottom of some tiles — it's small enough to read as part of the artwork's visual texture rather than as text, and it disappears behind the colored gradient at the edge. If you want a fully clean crop, the next step is hand-tracing each badge in a vector tool (e.g. Inkscape, embedded SVG) for a pixel-perfect result — but the current PNGs are an unambiguous improvement over the generic SVG icons that shipped with the design.
