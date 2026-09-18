# Albany Cub Scouts Pack 3 — Website

Design and platform exploration for the Pack 3 website.

- **`site/`** — the chosen design (design 6) as a **single-file** static site. **Current source of truth.**
  - `index.html` — the whole site. Home (hero, about, organization, activities, join teaser, FAQs) plus the Join and Calendar pages as CSS `:target` pseudo-pages (`#join`, `#calendar`) — no separate files, no JS router. `styles.css` toggles `.page` sections via `:target` (any targeted `.page` hides the default `#home`).
  - `styles.css` — all styles, including the pseudo-page routing rules
  - `images/` — web-optimised photos, capped to ~2× their rendered size and re-encoded with mozjpeg/pngquant (see `docs/IMAGE-OPTIMIZATION.md`)
  - The homepage event card loads the next upcoming event live from the public "Cubs Pack 3" Google Calendar (Calendar API v3, key in `CALENDAR_API_KEY` in `site/index.html`). Shows "Loading…", then the real event; the card hides itself if the fetch fails, the key is missing/restricted, or no events are upcoming.
- `poc/` — platform proofs-of-concept: `wordpress-acf/`, `grav/`, `sveltia/`, `pagescms/`, and `eleventy/` (templating only: shared header/footer includes).
- `more-images/` — extra source photos and superseded image variants, including the unused originals moved out of `site/images/` during optimisation. Not published. (`just originals` extracts the pre-optimisation images into `more-images/originals/`, which is gitignored.)
- `design-ideas/` — earlier mockups and React prototypes.
- `docs/` — platform decision docs, build guides, and the `FRAMEWORK-EXPLORATION.md` running log.
- `Justfile` — common tasks. `just serve` previews the site, `just images` re-runs the image pipeline (`scripts/optimize-images.sh`), `just size` reports published image weight. Run `just` to list all.

Platform: GitHub Pages (static, deployed from `site/` by `.github/workflows/pages.yml`). The owner-editing path is still open — see `docs/FRAMEWORK-EXPLORATION.md` (running log) and `docs/PLATFORM-DECISION.md` (historical).
