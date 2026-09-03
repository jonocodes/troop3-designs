# Local preview — Pack 3 ACF theme

Run the theme in a real WordPress instance locally (Docker or Podman). This is a
dev/preview harness only — **not** a production deployment. For deploying to a
host, see `../SETUP-GUIDE.md`.

## Requirements

- Docker **or** Podman with `docker-compose` (Podman rootless works — this was
  built on it).
- The theme's images are committed at `../pack3-theme/images/`, so there's
  nothing to copy.

## Bring it up (2 commands)

```sh
cd poc/wordpress-acf/dev

# 1. Start WordPress + MariaDB + wp-cli on port 8080
docker-compose up -d

# 2. Provision: installs WP + ACF, activates the theme, creates pages, seeds content
docker-compose exec -T -u 33 wpcli bash -s < setup.sh
```

Then open:

- **http://localhost:8080** — this machine
- **http://<your-hostname>:8080** or **http://<lan-ip>:8080** — from other devices
- Admin: **http://localhost:8080/wp-admin** → `admin` / `admin`

## Stop / reset

```sh
docker-compose down        # stop, KEEP the database (a later `up` resumes as-is)
docker-compose down -v      # stop and WIPE the database (next `up` needs setup.sh again)
```

## Why these details matter

- **`-u 33` is required.** The theme files are owned by uid 33 (Debian
  `www-data`). wp-cli must run as that uid, or plugin/config writes fail with
  permission errors. As uid 33 it's non-root, so no `--allow-root` is needed.
- **Only ACF is installed** — no Classic Editor plugin. The theme forces the
  classic editor for pages itself (so ACF fields render as a form, not hidden in
  Gutenberg's collapsed meta-box drawer).
- **Host-agnostic URLs.** `setup.sh` sets `WP_HOME`/`WP_SITEURL` to echo back
  whatever host you request, so `localhost`, the machine hostname, and the LAN IP
  all work without WordPress redirecting you to `localhost`. This trick lives in
  the container's `wp-config.php`, not in the theme — it's preview-only.
- **`setup.sh` is idempotent** — safe to re-run against a live instance.

## What this is NOT

A production setup. No real secrets, `admin/admin` credentials, HTTP only, and
the host-agnostic URL hack are all for local convenience. A real deploy sets a
fixed site URL, real credentials, and HTTPS.
