# Cub Scout Rank Badges — Source & Licensing

## TL;DR

- **Source**: Scouting America (formerly BSA) at `scouting.org`. The rank badge artwork lives at `https://www.scouting.org/wp-content/uploads/2023/04/logos-cub-ranks-N-RANK-1-original@2x.png`.
- **Confirmed URLs (3 of 6 verified live)**:
  - Lion: `1-lion-1-original@2x.png` ✅
  - Wolf: `3-wolf-1-original@2x.png` ✅
  - Webelos: `5-webelos-1-original@2x.png` ✅
  - Tiger, Bear, Arrow of Light: **not found via path guessing or DOM scraping** (see "Unresolved" below)
- **Licensing**: these are official trademarks. Use for chartered-unit Scouting purposes (i.e., a pack's own website identifying its own program) is the intended use; add a credit line; never modify the artwork.

## What the official Guide says

Two relevant PDFs were downloaded to `docs/scouting-refs/` (July 2024 revision):

### `Official_Policy.pdf`

Establishes that insignia are **uniform marks of identification** for Scouting America members. Policy covers how they're worn on the uniform — not directly about web/print reproduction, but confirms the marks are official organizational identifiers.

### `Guidelines_for_Custom_Patches_And_Emblems.pdf` (the relevant one)

This is the rulebook for *custom* (unit/council-made) patches, but it spells out what's reserved:

> A licensee must not produce:
> - ...
> - **Rank insignia, or patches/emblems substantially similar to rank insignia**
> - Merit badges or merit badge "knockoffs"

Key implication: **the official rank insignia is protected**, and you must not make knockoff versions. Using the official artwork (as provided by scouting.org) for a chartered pack's own website is the intended path.

### Modified Trademark Use

> If modifications are made to Scouting America trademarks, they require permission from the Scouting America Licensing Team and are subject to design approval on a case-by-case basis.

**Rule for the website: render the official badges as-is** — no color shifts, no cropping, no overlay text.

## What the website should do

1. **Use the official PNGs from scouting.org** (the URLs above) directly — they are public assets provided by Scouting America for unit use.
2. **Add a credit** near the den-organization section: "Cub Scout rank badges are trademarks of Scouting America, used with permission."
3. **Never modify** the badge artwork (no recoloring, no reskinning, no text overlays).
4. **Do not hotlink directly from scouting.org on the public site** — download the PNGs once and ship them with the site. (Hotlinking is fragile — the URL pattern could change, and it adds a third-party dependency to a static site that doesn't need one.)
5. **Statutory marks (`®`, `™`) are not required** on web embeds per the same PDF (they're only required on patches ≥3.5" round or ≥4" wide/tall).

## Unresolved (as of 2026-09)

Tiger, Bear, and Arrow of Light badge URLs were not located despite:

- Multiple filename variations tried (`original@2x`, `original2x`, `original`, with and without the leading `1-`)
- Searching scouting.org via webfetch (the Insignia Guide HTML page, the Cub Scouts landing, the rank-specific adventure pages)
- A scripted Playwright pass that loaded the Tiger/Bear/AOL/Wolf adventure pages and enumerated every image on each (none were `logos-cub-ranks-*`)

The Lion badge URL was discovered because the page `…/adventures/lion/attachment/logos-cub-ranks-1-lion-1-original2x/` was indexed externally and surfaced in search. The corresponding attachment pages exist in the WordPress media library but appear to be **orphans** with no inbound links, so they're not reachable by following site navigation.

### Options to resolve

1. **Contact the local council** or the National Supply Service at scoutshop.org — both routinely provide rank insignia graphics for unit websites. The local council's marketing contact is probably the fastest path.
2. **Use the Cub Scout Insignia PDF** (`docs/scouting-refs/33066-24-Cub_Scout_Insignia.pdf` — 6.4 MB, contains all six rank badges in vector form). PDF→PNG extraction at 284×284 would produce clean PNGs for all six. The download size is the only downside (it'd add ~6 MB to the repo, but we already have a 3.7 MB images folder, so the proportional jump is large but absolute is fine).
3. **Accept the partial set** (3 of 6 with the lion/wolf/webelos PNGs we have, fallback to SVG icons for the other 3 — the current design does this).
4. **Email the Licensing Team** at <licensing@scouting.org> and ask for the official rank-badge asset bundle, which they routinely provide to chartered units.

For this site, option 3 is what's currently in place — Lion/Wolf/Webelos use real PNGs (when wired up); Tiger/Bear/Arrow of Light keep the existing SVG icons. Option 2 is the best follow-up before launch if you want all six to be real.

## What was wired up

The 3 confirmed PNGs are downloaded to `raw-html/images/ranks/`. The den-card markup in `raw-html/index.html` still uses SVG icons (lines 482, 488, 494, 500, 506, 512) — wiring the PNGs into those spots is a follow-up that changes `<div class="den-icon">…</div>` to `<img class="den-icon-img" src="images/ranks/rank-{name}.png" alt="…">` for the three ranks where we have the asset, keeping the SVG for the other three.
