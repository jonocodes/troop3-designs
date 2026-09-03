# Pack 3 — CMS exploration POCs

Proofs-of-concept comparing ways to run the design-6 site. Grav and the static/CMS
POC reproduce a header + hero + quick-links slice with real CSS/images and a few
**editable fields** so the editing UX is real, not mocked. `wordpress-acf/` is the
fullest build — the whole page is editable — and has its own docs (`README.md`,
`SETUP-GUIDE.md`, `dev/`).

| POC | Stack | Server? | DB? | Content lives in | Front page | Admin |
|-----|-------|---------|-----|------------------|-----------|-------|
| `wordpress-acf/` | WordPress + ACF (full site) | Yes (PHP/Apache + MariaDB) | Yes | WordPress DB (ACF fields) | http://localhost:8080/ | http://localhost:8080/wp-admin |
| `grav/`    | Grav (flat-file PHP CMS) | Yes (PHP/Apache, container) | No | `.md` files w/ YAML front matter | http://localhost:8082/home | http://localhost:8082/admin |
| `sveltia/` | Static site (Eleventy) + git-based CMS | No | No | `src/_data/home.json` in the repo | http://localhost:8083/ | http://localhost:8083/admin/ |

Logins: **WordPress** `admin` / `admin` (run via `wordpress-acf/dev/`). **Grav** `admin` / `Password123`. **Static/CMS** — local dev, no password.

Screenshots captured in `screens/`.

---

## 1. Grav POC (`grav/`)

A real flat-file CMS: no database, content is text files, admin panel like WordPress
but far lighter. The design is a Grav **theme** (`theme/pack3/`); the editable hero is
a **page** (`hero.md`) whose fields are defined by a **blueprint**
(`theme/pack3/blueprints/hero.yaml`) — that blueprint is what renders the labelled
"Hero Fields" tab in the admin.

Run it:
```bash
cd poc/grav
docker build -t pack3-grav:latest .
docker run -d --name pack3-grav -p 8082:80 pack3-grav:latest
# then load the theme + page + create the admin user (see below)
```
Provisioning done for this POC (scripted against the running container):
- `docker cp theme/pack3 pack3-grav:/var/www/html/user/themes/pack3`
- swapped `user/pages/01.home/default.md` → our `hero.md`
- set `pages.theme: pack3` in `user/config/system.yaml`
- `php bin/plugin login new-user -u admin -p Password123 -e a@b.com -N 'Pack 3 Admin' -P a -l en`

Notes / findings:
- Latest **Grav requires PHP ≥ 8.3** (8.2 throws a Composer platform error) — Dockerfile pins `php:8.3-apache`.
- The editable fields are defined in `blueprints/hero.yaml` as a top-level `section` (not a
  separate tab), so they appear **immediately when you open the Home page** — ACF-style. (A
  separate tab is easy to miss; you land on the empty markdown "Content" tab and think there's
  nothing to edit.)
- Admin editor **pre-fills the current values** (Badge Text, Hero Title, … Event fields) — no blank-form confusion.
- Verified round-trip: edit Hero Title in admin → Save → written to `hero.md` on disk → live `<h1>` updates.
- Editing writes straight to the `.md` file → git-diffable, no DB. A non-technical user only sees the form.
- Cost of the model: you still run/patch a PHP server. (Free & open source, unlike Kirby which is ~€99/site.)
- Grav's admin (v2, Vue-based) renders form inputs without `name` attributes — target by position/label if scripting.

## 2. Static + git-based CMS POC (`sveltia/`)

Zero server. Eleventy renders `src/index.njk` from `src/_data/home.json`; a git-based CMS
edits that JSON through a form; the static host rebuilds. Content is versioned in the repo.

Run it:
```bash
cd poc/sveltia
npm install
npm run serve   # Eleventy dev server on :8083 (watches + rebuilds)
npm run proxy   # Decap local proxy on :8081 (writes edits to disk) — for the Decap admin only
```

### The Sveltia vs Decap reality (important)
- **Sveltia CMS** (`/admin/`, `src/admin/index.html` + `config-sveltia.yml`) is the modern,
  nicer UI. It **dropped proxy-server support** — local editing uses the browser's
  **File System Access API** ("Work with Local Repository" → pick the repo folder). `config-sveltia.yml`
  is set to **local-repository mode** (`backend.name: github` + localhost). Sveltia requires the
  folder you pick to be a **git repository root** (contain a `.git`), and resolves `file:` paths
  relative to it — so before the demo, make `poc/sveltia` a repo:
  ```bash
  cd poc/sveltia && git init && git add -A && git commit -m "sveltia poc"
  ```
  (It's committed here as normal files inside the main repo; in production this folder becomes its
  own deploy repo, so `git init` mirrors reality.) Then open `/admin/`, click **Work with Local
  Repository**, pick the `poc/sveltia` folder → the Home Page entry shows the **real, populated**
  content from `home.json`. The folder-pick is a native dialog (needs a Chromium user-gesture), so
  it can't be screenshotted headlessly — `screens/sveltia-local-landing.png` shows the entry point.
  (An earlier `test-repo` backend showed empty fields because it's an in-memory demo with no seed data;
  empty fields also happen if the picked folder isn't a git root — that was the real cause.)
- **Decap CMS** (`/admin/decap.html` + `config.yml`) is Sveltia's config-compatible predecessor
  and **keeps the local proxy**, so the full loop is scriptable. This POC used Decap to prove the
  end-to-end edit: changed "Hero Title" in the form → Publish → the proxy wrote `src/_data/home.json`
  → Eleventy rebuilt → the live `<h1>` updated. Same `config.yml` field definitions work in both.

### Accessing Sveltia (the "only works with HTTPS or localhost" error)
Sveltia refuses to run on a plain-HTTP LAN hostname (e.g. `http://lute:8083`). Two facts:
1. **It needs a secure context.** `localhost` counts; a LAN hostname over HTTP does not. An HTTPS
   proxy fixes loading: `node poc/https-proxy.js` serves the site at **https://lute:8443/**
   (self-signed cert in `poc/certs/` — the browser will warn once; accept it).
2. **Sveltia's *local* editing is same-machine only.** "Work with Local Repository" uses the
   browser File System Access API, so it edits folders on *the machine running the browser*. From
   another device you cannot edit the server's repo this way. So:
   - On the server machine: `http://localhost:8083/admin/` → real local editing of this repo.
   - From another device today: use **Decap** at `http://lute:8083/admin/decap.html` — its proxy
     runs server-side, so editing works over plain LAN HTTP right now.
   - Real multi-device editing (any laptop): the production model below (Sveltia + GitHub backend).

For production either way: static host (Cloudflare Pages/Netlify) + the CMS talking to GitHub via
an OAuth worker (`sveltia-cms-auth`). Editors never touch git; a save commits + redeploys.

Run the HTTPS proxy:
```bash
cd poc && node https-proxy.js   # https://lute:8443/  and  https://lute:8443/admin/
```

---

## What both POCs share with the ACF work
Making *every* section editable is still per-section wiring (schema/blueprint/fields) — same as ACF.
These POCs wire the hero + event card only, enough to feel the workflow. The difference is what you
live with afterward: **Grav** = light PHP server, files not DB; **static+CMS** = no server at all,
content in git, free hosting, nothing to patch.

## Teardown
```bash
docker rm -f pack3-grav
# stop the Eleventy + Decap background processes
```
