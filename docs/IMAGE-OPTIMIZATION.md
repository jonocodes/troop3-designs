# Image Optimisation

How the published images in `site/images/` were slimmed down, and how to do it
again.

**Result:** 10.0 MB across 21 used images → **1.76 MB (82% smaller)**, with no
change to file paths or markup.

Last optimised: 2026-09-18. Pre-optimisation originals live in git history at
commit `13c27e7` (see "Recovering originals" below).

---

## Principles

1. **Cap dimensions to what's actually rendered.** A photo shown in a 370px-wide
   card doesn't need to be 2195px wide. Cap at ~2× the largest CSS display size
   (for high-DPI screens).
2. **One lossy pass per image.** Always resize + encode from the *original* in a
   single step. Resizing an already-recompressed JPEG compounds artifacts.
3. **Strip metadata** (`-strip`) — shrinks files and removes EXIF/GPS.
4. **Use the best encoder for the format**: `mozjpeg` for JPEG, `pngquant` for
   PNG. WebP/AVIF were measured and rejected (see below).

## Display roles and dimension caps applied

| Role | Rendered at | Cap applied |
|---|---|---|
| `.hero-bg` (3, random) | fullscreen `cover` | no resize (kept 1200–1377w) |
| `.welcome-image img` | 400px tall, up to ~1160w on tablet | kept 1200×900 |
| `.activity-image img` (6) | ~371–479 CSS px wide, 220 tall | width 1000 |
| `.quick-link-bg` (3) | ~371–600 CSS px wide, 280 tall | width 1000 |
| `.hero-logo img` (`pack3-logo.png`) | max 320px wide | 512×512 |
| `.logo-icon` (`pack3-tent.png`) | 50–56px | 128×128 |
| `.den-icon.has-badge` (`rank-*.png`) | 96×96 | 192×192 |

## Encoding settings

- **JPEG:** mozjpeg `cjpeg -quality 76 -progressive -optimize` (from the original
  via ImageMagick `-resize`, piped as PPM so ImageMagick never encodes JPEG).
- **PNG:** `pngquant --quality=65-90 --strip` after resize. `--skip-if-larger`
  keeps the original where quantising would grow it (the already-tiny rank badges).

## Reproducing

The whole pipeline is scripted — `scripts/optimize-images.sh`, driven by the
`Justfile`:

```sh
just originals   # one-off: extract pre-optimisation originals from git into more-images/originals/
just images      # resize + re-encode site/images in place (wraps nix-shell)
just size        # total bytes referenced by the live page
just optimize    # images, then size
```

`just images` uses the extracted originals when present, so re-runs always start
from source. Output is byte-for-byte reproducible (mozjpeg/pngquant are
deterministic here).

**Gotcha:** `imagemagick` pulls in a transitive `libjpeg-turbo` whose `cjpeg`
shadows mozjpeg's, silently producing larger files. `img_tools` in the Justfile
therefore lists `mozjpeg` first, and the script aborts if `cjpeg -version` isn't
mozjpeg. If you run the script outside `just`, make sure mozjpeg's `bin` precedes
libjpeg-turbo on `PATH`.

To run the tools directly (e.g. for a one-off image), `nix-shell -p mozjpeg
imagemagick pngquant libwebp`.

### Manual example

JPEG (an activity photo capped to 1000px, source taken from the originals):

```sh
magick more-images/originals/raw-html/images/activity-hiking-2.jpg \
  -resize '1000x>' -strip ppm:- \
  | cjpeg -quality 76 -progressive -optimize \
  -outfile site/images/activity-hiking-2.jpg
```

PNG (rank badge, 280 → 192):

```sh
magick more-images/originals/raw-html/images/rank-bear.png -resize 192x192 -strip site/images/rank-bear.png
pngquant --quality=65-90 --strip --force --skip-if-larger --ext .png site/images/rank-bear.png
```

## Recovering originals

The unoptimised files are unchanged in git at commit `13c27e7`:

```sh
# single file
git show 13c27e7:raw-html/images/hero-bg-3.jpg > hero-bg-3.jpg
# everything referenced by the live page
mkdir -p originals && git archive 13c27e7 raw-html/images | tar -x -C originals
```

`13c27e7` predates the `raw-html/` → `site/` rename, so those archived paths
deliberately still say `raw-html/`. `just originals` extracts them under
`more-images/originals/raw-html/images/` for the same reason.

Unused images were also **moved** (not deleted) to `more-images/` in the same
change; they remain recoverable from that commit too.

## The hero double-fetch fix

`styles.css` used to paint `hero-bg-1.jpg` as the `.hero-bg` background, then
`index.html`'s randomiser overwrote it — so any visit that picked bg 2 or 3
downloaded two hero images. The CSS now uses a solid `--forest-dark` fallback and
lets the randomiser supply the image, so exactly one hero is fetched per visit.

## Considered and rejected

- **WebP / AVIF conversion** — benchmarked WebP (-q 80) at only **19%** overall,
  and it *grew* the palette-optimised rank PNGs. AVIF would need `<picture>`
  fallback markup for a modest further gain. mozjpeg q76 gave ~30% with zero
  markup changes, so format conversion wasn't worth the complexity.
- **Responsive `srcset`** — would send smaller files to phones. Low value now that
  every image is ≤1000px; revisit only if mobile data usage matters.
- **`jpegoptim -m82`** was used for the first pass; superseded by mozjpeg, which
  compresses better at a lower nominal quality.
