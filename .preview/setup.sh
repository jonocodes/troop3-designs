#!/bin/bash
# Provision the WordPress preview site via wp-cli. Idempotent-ish (safe to re-run).
set -e
WP="wp --allow-root --path=/var/www/html"

# 1. Install WordPress if not already installed
if ! $WP core is-installed 2>/dev/null; then
  $WP core install \
    --url="http://localhost:8080" \
    --title="Albany Cub Scouts Pack 3" \
    --admin_user="admin" \
    --admin_password="admin" \
    --admin_email="admin@example.com" \
    --skip-email
fi

# 2. Activate the theme
$WP theme activate pack3-theme

# 3. Pretty permalinks (needed for /about, /calendar)
$WP rewrite structure '/%postname%/' --hard
$WP rewrite flush --hard

# 4. Create the three template pages (idempotent by slug)
create_page () { # name slug template
  local title="$1" slug="$2" template="$3"
  local id
  id=$($WP post list --post_type=page --name="$slug" --field=ID 2>/dev/null | head -1)
  if [ -z "$id" ]; then
    id=$($WP post create --post_type=page --post_status=publish \
        --post_title="$title" --post_name="$slug" --porcelain)
  fi
  $WP post meta update "$id" _wp_page_template "$template" >/dev/null
  echo "$id"
}

HOME_ID=$(create_page "Home"     "home"     "page-home.php")
create_page "About"    "about"    "page-about.php" >/dev/null
create_page "Calendar" "calendar" "page-calendar.php" >/dev/null

# 5. Set static homepage
$WP option update show_on_front page
$WP option update page_on_front "$HOME_ID"

# 6. Add sample leaders (only if none exist)
if [ "$($WP post list --post_type=leader --format=count 2>/dev/null)" = "0" ]; then
  L1=$($WP post create --post_type=leader --post_status=publish --post_title="Jane Smith" --porcelain)
  $WP post meta update "$L1" leader_role "Cubmaster"
  $WP post meta update "$L1" leader_description "Leads the pack and coordinates all den activities."
  $WP post meta update "$L1" leader_sort_order 10
  L2=$($WP post create --post_type=leader --post_status=publish --post_title="Alex Johnson" --porcelain)
  $WP post meta update "$L2" leader_role "Assistant Cubmaster"
  $WP post meta update "$L2" leader_description "Supports the Cubmaster and runs outdoor adventures."
  $WP post meta update "$L2" leader_sort_order 20
fi

# 7. Primary nav menu pointing at the pages
if ! $WP menu list --fields=name --format=csv 2>/dev/null | grep -q "^Primary$"; then
  $WP menu create "Primary"
  $WP menu item add-post   Primary "$HOME_ID" >/dev/null 2>&1 || true
  for s in about calendar; do
    pid=$($WP post list --post_type=page --name="$s" --field=ID | head -1)
    $WP menu item add-post Primary "$pid" >/dev/null 2>&1 || true
  done
  $WP menu location assign Primary primary || true
fi

echo "=== DONE ==="
$WP post list --post_type=page --fields=ID,post_title,post_name --format=table
