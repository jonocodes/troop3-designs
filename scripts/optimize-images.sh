#!/usr/bin/env bash
# Optimise the published site images in site/images.
#
# Pipeline (see docs/IMAGE-OPTIMIZATION.md):
#   - JPEG: resize to a role-based max width, then mozjpeg q76 (via ImageMagick
#     PPM pipe, so ImageMagick never encodes the JPEG).
#   - PNG:  resize, then pngquant (skips if quantising would grow the file).
#
# Source resolution: if a pre-optimisation original is present under
# $ORIGINALS_DIR (default more-images/originals/raw-html/images, fetched by
# `just originals`), it is used so the lossy pass runs from the source rather
# than a previously-optimised file. Otherwise the current file is re-encoded.
# (The "raw-html" in that path is the pre-rename name of the site/ directory.)
#
# Requires: imagemagick, mozjpeg (cjpeg), pngquant on PATH — `just images`
# wraps this in nix-shell.
set -euo pipefail

cd "$(dirname "$0")/.."
DEST=site/images
ORIG="${ORIGINALS_DIR:-more-images/originals/raw-html/images}"

for tool in magick cjpeg pngquant; do
  command -v "$tool" >/dev/null || { echo "missing tool: $tool (run via 'just images')" >&2; exit 1; }
done
# Guard against libjpeg-turbo's cjpeg shadowing mozjpeg's (see Justfile img_tools).
cjpeg -version 2>&1 | grep -q mozjpeg || {
  echo "cjpeg is not mozjpeg — refusing to run (it produces larger files)." >&2
  echo "Run via 'just images', or put mozjpeg's bin ahead of libjpeg-turbo on PATH." >&2
  exit 1
}
[ -d "$DEST" ] || { echo "no such directory: $DEST" >&2; exit 1; }

src_for() {
  if [ -f "$ORIG/$1" ]; then printf '%s' "$ORIG/$1"; else printf '%s' "$DEST/$1"; fi
}

jpeg() { # <name> <max-width|0>
  local name=$1 w=$2 s tmp
  s=$(src_for "$name"); tmp=$(mktemp --suffix=.jpg)
  if [ "$w" = 0 ]; then
    magick "$s" -strip ppm:- | cjpeg -quality 76 -progressive -optimize -outfile "$tmp"
  else
    magick "$s" -resize "${w}x>" -strip ppm:- | cjpeg -quality 76 -progressive -optimize -outfile "$tmp"
  fi
  mv "$tmp" "$DEST/$name"
  printf '  %-32s %6dK\n' "$name" "$(( $(stat -c%s "$DEST/$name") / 1024 ))"
}

png() { # <name> <max-dim>
  local name=$1 d=$2 s tmp
  s=$(src_for "$name"); tmp=$(mktemp --suffix=.png)
  magick "$s" -resize "${d}x${d}>" -strip "$tmp"
  pngquant --quality=65-90 --strip --force --skip-if-larger --ext .png "$tmp" || true
  mv "$tmp" "$DEST/$name"
  printf '  %-32s %6dK\n' "$name" "$(( $(stat -c%s "$DEST/$name") / 1024 ))"
}

echo "== JPEG (mozjpeg q76) =="
jpeg activity-derby-2.jpg 1000
jpeg activity-egg-drop-3.jpg 1000
jpeg activity-camping-2.jpg 1000
jpeg activity-hiking-2.jpg 1000
jpeg activity-pancake-breakfast.jpg 1000
jpeg activity-flag-3.jpg 1000
jpeg card-activities-2.jpg 1000
jpeg card-faqs-3.jpg 1000
jpeg card-registration-3.jpg 1000
jpeg hero-bg-1.jpg 0
jpeg hero-bg-2.jpg 0
jpeg hero-bg-3.jpg 0
jpeg welcome-group-4.jpg 0

echo "== PNG (pngquant) =="
png pack3-logo.png 512
png pack3-tent.png 128
for r in aol bear lion tiger webelos wolf; do png "rank-$r.png" 192; done

echo "done"
