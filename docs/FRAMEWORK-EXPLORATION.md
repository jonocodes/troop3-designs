# Framework & Platform Exploration Log

Running log of what we've explored for the Pack 3 site, the requirements driving
those choices, and where things stand. Discussion notes, dead ends and open
questions belong here; individual POC folders keep the how-to details.

Last updated: 2026-09-16.

---

## Requirements

What the site actually needs — every evaluation below is measured against these:

- **Static brochure site.** 3 pages (Home, Join, Calendar), Google Forms + Google
  Calendar embeds, ~25 photos. No accounts, no data of our own.
- **Hosting: GitHub Pages — decided.** `.github/workflows/pages.yml` publishes the
  site folder on push to `main`. No server to patch, no monthly cost.
  Squarespace/Wix are out (see below).
- **Editing without a developer** (original goal): a pack volunteer should be able
  to change text and photos. Two shapes were explored: a CMS form UI, or editing
  the HTML/partials in git. Not settled yet.
- **Local editing and full preview.** Work on the site locally and see the whole
  thing while editing; live reload preferred.
- **Hand-written HTML, not markdown.** The pages are HTML templates; no content
  model or markdown authoring is required.
- **Repeatability.** Builds and checks should be runnable scripts, not eyeballing
  (`npm run check`, parity tests, screenshots).

## Where it stands (2026-09-16)

- **Deployed source:** `raw-html/` (design 6) via GitHub Pages.
- **Build tool:** **Eleventy** (Nunjucks templates) with shared header/footer
  partials — demonstrated by two POCs: `poc/pagescms/site/` and `poc/eleventy/`.
- **Open:** which Eleventy build becomes canonical, whether Pages deploys a built
  `_site/` instead of the site folder, and what the owner's editing surface is.

---

## Options explored

### Ruled out

- **Squarespace / Wix** — closed platforms: no import/API/CLI, so the site can only
  be built by clicking in an editor; custom CSS/scripts need the ~$33/mo Business
  plan. The build labour lands on us either way, and a static repo site is free and
  automatable. See `docs/PLATFORM-DECISION.md` (historical) and
  `docs/SQUARESPACE-GUIDE-NO-CSS.md`, which is now a dead end.
- **Runtime JS "components" in the browser** (native web components, Preact + htm,
  Alpine, petite-vue, fetch-based partials) — would share the header/footer without
  a build, but nav/footer then exist only after JS runs: no-JS users and some
  crawlers see nothing, and content flashes/shifts on load. On GitHub Pages a build
  step is free, so the output should stay plain HTML. Not built; discussed only.
- **React (or any SPA framework)** — the early `design-ideas/` prototypes were
  React and were flattened back to static HTML; no dynamic app needs live here.

### Built as POCs

| Option | What it is | Outcome |
|--------|------------|---------|
| `poc/wordpress-acf/` | WordPress + ACF, full site, owner edits in wp-admin | Works and is fully editable, but needs PHP + MariaDB hosting and ongoing WP/plugin patching |
| `poc/grav/` | Flat-file PHP CMS, no database | Lighter than WordPress, but still a server; editing UX proven for a hero slice only |
| `poc/sveltia/` | Eleventy site + git-based CMS (Sveltia UI, Decap proxy) | No server; edits JSON via forms; requires content modeling per section. Local editing: Sveltia uses the File System Access API, Decap keeps a proxy; multi-device needs GitHub OAuth |
| `poc/pagescms/` | Eleventy site + Pages CMS; edits the **HTML partials** in a web code editor | No content modeling, but the editor still faces HTML; the CMS itself is a Next.js + Postgres app (hosted app is the sane path). Its `site/` is a full Eleventy build with a smoke-test `check` |
| `poc/eleventy/` | Templating only: full site as an Eleventy build with shared partials | Proves header/footer/scripts (125 duplicated lines) collapse to one copy with identical output; self-contained assets; `npm run check`. Overlaps heavily with `poc/pagescms/site/` |

### Compared, not built

- **Eleventy vs Hugo** for the build step. Eleventy won because the pages are raw
  HTML: `.html` files are treated as templates as-is (Liquid by default, Nunjucks
  configured), so the diff is "replace header markup with an include". Hugo is a
  single binary but assumes content files wrapped by layouts, and its Go templates
  are more machinery than 3 static pages need.
- **Jekyll** — GitHub Pages can build it natively, but the repo deploys via Actions
  already, and Ruby tooling is a heavier local ask than Node.
- **WordPress theme without ACF** — superseded and archived at
  `archive/wordpress-theme-hardcoded` (see `docs/ARCHIVES.md`).

---

## Findings that keep coming up

- **Owner editing is the expensive axis, not hosting.** Every CMS option pays the
  same per-section wiring cost; the cheaper options (Sveltia, Pages CMS) push that
  cost onto the person editing instead (forms need a schema; Pages CMS edits HTML).
- **Two editing archetypes:** content-model CMS (WordPress, Grav — forms, needs
  schema) vs code editor over partials (Sveltia, Pages CMS — no schema, needs
  HTML literacy). Static hosting rules out nothing either way.
- **Templating is a prerequisite** for any CMS: one header/footer/scripts partial
  set, verified by a build check. Done in both Eleventy POCs.
- **Verification matters:** both POCs ship `npm run check`; the first Eleventy POC
  also asserted byte-parity with the deployed pages (whitespace-normalized, two
  documented normalizations).
- **GitHub Pages constraints:** static files only, no server-side includes or
  redirects; every build happens in Actions, so any tool that emits static files
  is viable.

## Open questions

- Which editing UX will the pack actually accept — CMS forms, or a code editor?
- Which build is canonical: `poc/pagescms/site/` (CMS-ready) or `poc/eleventy/`
  (templating-only), or do both stay as comparisons?
- Do we switch `pages.yml` to build and publish `_site/`, and does the deployed
  site folder stay in the loop as the source of page bodies?
- If Pages CMS: use the hosted app (app.pagescms.org); local self-hosting hit
  GitHub App manifest bugs in pages-cms 2.1.8 (`poc/pagescms/dev/patches/`).
- If Sveltia: multi-device editing needs the GitHub backend + OAuth worker; local
  editing is same-machine only.

---

## Related docs

- `docs/PLATFORM-DECISION.md` — historical Squarespace/Wix evaluation (superseded).
- `docs/ARCHIVES.md` — archived experiments and restore commands.
- `poc/wordpress-acf/DECISIONS-AND-FINDINGS.md` — WordPress track decisions.
- `poc/README.md` — the POC index (what each one proves, ports, how to run).
- `poc/eleventy/README.md`, `poc/pagescms/README.md` — the two Eleventy builds.
