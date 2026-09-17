# Eleventy templating POC

Proves out building the Pack 3 site with Eleventy so the header, footer and shared JS
exist once instead of once per page — with no change to the rendered result. This is
about *templating*, not a CMS: pages stay hand-written HTML (no markdown, no content
model), and editing is still "edit an `.html` file". The POC is self-contained: the
site's stylesheet and images live in `src/` and are emitted to `_site/`.

## Run it

```bash
cd poc/eleventy
npm install
npm run serve   # http://localhost:8084/ — watches + live reloads
npm run build   # writes _site/
npm run check   # build + smoke test (shared header/footer, one active nav each, assets copied)
```

## Structure

| File | Role |
|------|------|
| `src/index.html`, `src/join.html`, `src/calendar.html` | Page bodies + front matter (`title`, `active`, `permalink`) |
| `src/_includes/base.html` | `<head>`, derives `indexPrefix`/`homeHref` from `active`, includes header/content/footer |
| `src/_includes/header.html` | Header, overlay, mobile menu |
| `src/_includes/footer.html` | Footer |
| `src/site.js` | `toggleMenu` / `toggleFaq` / `scrollToTop` / back-to-top (was inline, duplicated) |
| `src/styles.css`, `src/images/` | Site assets, copied to output by `eleventy.config.js` |
| `check.js` | `npm run check` smoke test |

## Findings

- **Duplication removed:** 125 lines (header 40 + footer 64 + scripts 21) were copied into
  every page; they now exist once. Page sources shrink accordingly:
  `index.html` 629 → 489, `join.html` 212 → 82, `calendar.html` 174 → 43 lines.
- **Build:** Eleventy v3.1.6, ~0.07s, 3 pages written + assets copied.
- **URLs stay identical** (`/index.html`, `/join.html`, `/calendar.html`) via
  `permalink: /join.html`. Without it Eleventy defaults to pretty URLs (`/join/`).
- **Page bodies are carried over unchanged** — only the header, footer and scripts moved
  into partials, so the rendered output matches the original pages.
- **The per-page link difference is handled once:** index uses `#about`, the other pages
  use `index.html#about`. `base.html` derives `indexPrefix`/`homeHref` from the `active`
  front matter value, so pages only declare `active: join` etc.
- **Inconsistency normalized:** index's mobile menu lacked the Join link (calendar already
  had it); the include now shows it everywhere except on `join.html` itself.
- **Costs:** ~9.6MB of images duplicated in `src/images/` (accepted: the POC stays
  independent), and a Node/npm toolchain in CI.

## Relation to `poc/pagescms/site/`

That POC wraps a very similar Eleventy build in Pages CMS editing. This one is the
templating-only comparison; the differences are that its check is stricter about nav
state and that `poc/pagescms/site/` exposes `_includes/` to a web editor.

## If this graduates

- `.github/workflows/pages.yml` gains `npm ci && npm run build` before
  `upload-pages-artifact`, uploading `poc/eleventy/_site`.
- Pick one canonical build (this dir or `poc/pagescms/site/`) rather than both.
- `node_modules` is ignored by the root `.gitignore`; `_site/` by the local one.
