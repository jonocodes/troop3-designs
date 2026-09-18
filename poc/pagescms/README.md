# Pages CMS POC → moved to its own repo

This POC was promoted out of the exploration monorepo into a standalone,
**deployed** repository. The code and how-to docs now live there:

- **Repo:** <https://github.com/jonocodes/troop3-pagescms>
- **Live site:** <https://jonocodes.github.io/troop3-pagescms/>
  (Eleventy build published to GitHub Pages by `.github/workflows/deploy-site.yml`)

## What it proves

The workflow: **the HTML lives in shared partials in a GitHub repo, and someone
logs into a web UI (Pages CMS) to edit those partials** — no manual git, no
markdown, no database of content.

- The Eleventy site sits at the **repo root** so `.pages.yml` is at the root of
  the connected repo, which is where Pages CMS reads it from.
- Raw-HTML editing (no content fields): each `.pages.yml` entry opens a code
  editor over the actual `.html` file.
- `dev/` in that repo is the experimental local self-hosting harness (Postgres +
  GitHub App); the hosted app at app.pagescms.org is the sane path.

## Why a pointer and not a copy / submodule

The files used to be duplicated here. They were removed to avoid drift — the
standalone repo is the single source of truth and is the thing that actually
deploys. A git submodule was considered but skipped: it adds init/update
ceremony and a pinned-SHA to bump for no real gain, since nothing here builds
against these files.

See `docs/FRAMEWORK-EXPLORATION.md` (the running log) for how this POC compares
to the others, and for the "Editing surface: Pages CMS vs editing HTML directly
in GitHub" discussion.
