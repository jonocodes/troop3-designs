# Pack 3 Website — Decisions & Findings (WordPress / ACF track)

Running log of platform decisions and technical findings for the Albany Cub
Scouts Pack 3 site. Focused on the WordPress + ACF implementation in this folder.

Last updated: 2026-09-01.

---

## Platform status: UNDECIDED (static HTML vs WordPress)

Not yet committed to a platform. Two live candidates, kept at rough parity for
now so they can be compared:

1. **Static HTML** — `../../raw-html/index.html` (the original design, 100%
   fidelity, free hosting, edited via code/git). **Now the working source of truth.**
2. **WordPress + ACF** — this folder (`poc/wordpress-acf/`), full design + owner
   editable content in wp-admin.

**Squarespace was ruled out.** It is a closed platform with no import/API/CLI —
a site can only be built by manual clicking in its editor or by a paid developer.
Cost ($33/mo) was acceptable, but the build labour lands on us regardless, so it
lost to options we can actually build and self-host.

**WordPress context:** Pack currently runs on WordPress; a new site would replace
the old one (not run alongside it).

---

## Decision: base "hardcoded" WordPress theme retired

The original `wordpress-theme/` (no ACF) only exposed Leaders, meeting info, and
menus as editable — **all page copy was hardcoded in PHP**. It was a strict
subset of the ACF theme, so it was archived and removed to avoid confusion.

- **Archived at git tag:** `archive/wordpress-theme-hardcoded`
- **Restore with:** `git checkout archive/wordpress-theme-hardcoded -- wordpress-theme`
- The ACF theme (`poc/wordpress-acf/pack3-theme/`) is now the single WordPress source of truth.

---

## Finding: how default content works (the 3-layer model)

Every text/image on the home page is editable via ACF fields. There are **three**
layers of "value", which is initially confusing:

| Layer | Lives in | Role |
|-------|----------|------|
| ACF `default_value` | `inc/acf-fields.php` | Pre-fills the **form input** so the editor sees text |
| Template fallback `pack3_field($name, $default)` | `page-home.php` | Renders on the **public page** when the DB value is empty |
| Saved value | database (post meta) | Set on Update; **overrides both** |

**Verified behaviour (2026-09-01):**
- Most form fields **do** pre-fill with their defaults (confirmed for Hero, etc.).
- The empty-looking ones are the **Activity Card** and **FAQ** slots — intentionally
  blank ("fill a slot to add one").
- The database is currently **empty** for these fields (`get_field('hero_title')`
  returns `null`). The public site looks correct **only because of the template
  fallback**, and the form looks filled **only because of ACF `default_value`** —
  two separate copies of the same text, kept in sync by hand.

### Two quirks this creates

1. **Nothing is in the database until someone clicks Update.** Live text comes
   from the template fallback until then.
2. **You can't blank a field.** Clearing e.g. the Hero title still shows the
   default on the public page (the fallback kicks in on empty).

---

## Open question: seed content into the DB? (Option A — NOT yet decided)

**Proposal:** at setup, write the design's copy into the ACF fields once, so the
database holds the real content.

**Pros:** the form always shows the true live text; `get_field` returns real
values; blanking a field actually blanks it; no hand-synced duplication.

**Does it remove the template defaults?** Not necessarily — separate choice:
- **Keep** the `pack3_field($name, $default)` fallbacks = safety net if ACF is
  deactivated or a field is wiped (theme still renders). Recommended while the
  platform decision is open.
- **Remove** them = single source of truth (the DB), less duplication, but the
  theme depends fully on ACF being present and populated.

Decision pending.

---

## Setup requirements (ACF theme)

- **Plugins:** only **Advanced Custom Fields (free)**. No ACF Pro (uses fixed
  field slots, not Repeater). **No Classic Editor plugin** — the theme forces the
  classic editor for pages itself (via `use_block_editor_for_post`), because ACF
  fields hide in Gutenberg's collapsed meta-box drawer otherwise.
- **`index.php`** was added — WordPress won't activate a theme without it. (The
  archived base theme was missing it too.)
- **Images** are committed in the theme at `pack3-theme/images/` (sourced from
  `../../raw-html/images/`); hero-bg + logo are theme files, most other photos are
  editable ACF image fields.

---

## Local preview

`dev/` (tracked) runs the theme in a real WordPress via Docker/Podman — see
`dev/README.md`. ACF theme at `http://localhost:8080` (admin / admin), provisioned
by `dev/setup.sh`.
