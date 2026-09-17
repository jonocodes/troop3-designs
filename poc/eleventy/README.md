# Eleventy templating POC

Proves out building the **real** `raw-html/` site with Eleventy so the header,
footer and shared JS exist once instead of once per page — with no change to the
rendered result. This is about *templating*, not a CMS: pages stay hand-written
HTML, `raw-html/` stays the source of truth for design + assets, and editing is
still "edit an `.html` file".

## Run it

```bash
cd poc/eleventy
npm install
npm run serve   # http://localhost:8084/ — watches + live reloads
npm run build   # writes _site/
```

## Structure

| File | Role |
|------|------|
| `src/index.html`, `src/join.html`, `src/calendar.html` | Page bodies + front matter (`title`, `active`, `permalink`) |
| `src/_includes/base.html` | `<head>`, derives `indexPrefix`/`homeHref` from `active`, includes header/content/footer |
| `src/_includes/header.html` | Header, overlay, mobile menu |
| `src/_includes/footer.html` | Footer |
| `src/site.js` | `toggleMenu` / `toggleFaq` / `scrollToTop` / back-to-top (was inline, duplicated) |
| `eleventy.config.js` | Input `src`, output `_site`, copies `raw-html/images` + `raw-html/styles.css` (no asset duplication) |

## Findings

- **Duplication removed:** 125 lines (header 40 + footer 64 + script 21) were copied into
  every page; they now exist once. Page sources shrink accordingly:
  `index.html` 629 → 489, `join.html` 212 → 82, `calendar.html` 174 → 43 lines.
- **Build:** Eleventy v3.1.6, ~0.07s, 3 pages written + 32 assets copied.
- **URLs stay identical** (`/index.html`, `/join.html`, `/calendar.html`) via
  `permalink: /join.html`. Without it Eleventy defaults to pretty URLs (`/join/`).
- **Output parity** (verified `raw-html/` vs `_site/`): page bodies byte-identical;
  headers byte-identical except the intentional mobile-menu change below; footers
  byte-identical except join/calendar inherit index's 1935/1936 HTML comment.
  A Playwright screenshot of the POC homepage is **byte-identical** to one of
  `raw-html/index.html`.
- **The per-page link difference is handled once:** index uses `#about`, the other
  pages use `index.html#about`. `base.html` derives `indexPrefix`/`homeHref` from the
  `active` front matter value, so pages only declare `active: join` etc.
- **Inconsistency normalized:** index's mobile menu lacked the Join link (calendar
  already had it); the include now shows it everywhere except on `join.html` itself.
  `join.html` consequently has one blank line where that item is suppressed.

## If this graduates

- Either move `raw-html/*` into `src/` (assets included), or point Eleventy's input at
  `raw-html/` and keep `_includes/` beside it.
- `.github/workflows/pages.yml` gains `npm ci && npm run build` before
  `upload-pages-artifact`, uploading `poc/eleventy/_site` instead of `raw-html/`.
- `node_modules` is ignored by the root `.gitignore`; `_site/` by the local one.
