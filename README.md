# Albany Cub Scouts Pack 3 — Website

Design and platform exploration for the Pack 3 website.

- **`raw-html/`** — the chosen design (design 6) as a static site. **Current source of truth.**
  - `index.html` — homepage (hero, about, organization, activities, join teaser, FAQs, footer)
  - `join.html` — standalone Join / registration page
  - `calendar.html` — standalone Pack Calendar page (Google Calendar + detailed doc embeds)
  - `styles.css` — shared styles for all pages
  - The homepage event card loads the next upcoming event live from the public "Cubs Pack 3" Google Calendar (Calendar API v3, key in `CALENDAR_API_KEY` in `raw-html/index.html`). Shows "Loading…", then the real event; the card hides itself if the fetch fails, the key is missing/restricted, or no events are upcoming.
- `poc/` — platform proofs-of-concept: `wordpress-acf/`, `grav/`, `sveltia/`, `pagescms/`, and `eleventy/` (templating only: shared header/footer includes).
- `design-ideas/` — earlier mockups and React prototypes.
- `docs/` — platform decision docs, build guides, and the `FRAMEWORK-EXPLORATION.md` running log.

Platform: GitHub Pages (static, deployed from `raw-html/` by `.github/workflows/pages.yml`). The owner-editing path is still open — see `docs/FRAMEWORK-EXPLORATION.md` (running log) and `docs/PLATFORM-DECISION.md` (historical).
