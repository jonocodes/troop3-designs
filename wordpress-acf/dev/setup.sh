#!/bin/bash
# Provision the local Pack 3 ACF preview site.
# Run INSIDE the wpcli container as uid 33 (see README.md):
#   docker-compose exec -T -u 33 wpcli bash -s < setup.sh
#
# Idempotent-ish: safe to re-run. Uid 33 matches the theme/file owner, so no
# --allow-root is needed and plugin/config writes succeed.
set -e
WP="wp --path=/var/www/html"

# 1. Wait for WordPress core files
for i in $(seq 1 30); do
  [ -f /var/www/html/wp-load.php ] && break; sleep 2
done

# 2. Install WordPress (skips if already installed)
$WP core is-installed 2>/dev/null || $WP core install \
  --url="http://localhost:8080" \
  --title="Albany Cub Scouts Pack 3" \
  --admin_user="admin" --admin_password="admin" \
  --admin_email="admin@example.com" --skip-email

# 3. Advanced Custom Fields (free) — the only required plugin
$WP plugin is-active advanced-custom-fields 2>/dev/null || \
  $WP plugin install advanced-custom-fields --activate

# 4. Activate the theme + pretty permalinks
$WP theme activate pack3-theme
$WP rewrite structure '/%postname%/' --hard >/dev/null
$WP rewrite flush --hard >/dev/null

# 5. Create the three template pages
create_page () { # title slug template
  local id
  id=$($WP post list --post_type=page --name="$2" --field=ID 2>/dev/null | head -1)
  [ -z "$id" ] && id=$($WP post create --post_type=page --post_status=publish \
      --post_title="$1" --post_name="$2" --porcelain)
  $WP post meta update "$id" _wp_page_template "$3" >/dev/null
  echo "$id"
}
HOME_ID=$(create_page "Home" "home" "page-home.php")
create_page "About" "about" "page-about.php" >/dev/null
create_page "Calendar" "calendar" "page-calendar.php" >/dev/null

# 6. Static homepage
$WP option update show_on_front page >/dev/null
$WP option update page_on_front "$HOME_ID" >/dev/null

# 7. Sample leader (About page)
if [ "$($WP post list --post_type=pack3_leader --format=count 2>/dev/null)" = "0" ]; then
  L=$($WP post create --post_type=pack3_leader --post_status=publish --post_title="Jane Smith" --porcelain)
  $WP post meta update "$L" _pack3_leader_role "Cubmaster" >/dev/null
  $WP post meta update "$L" _pack3_leader_description "Leads the pack and coordinates all den activities." >/dev/null
  $WP post meta update "$L" _pack3_leader_order 10 >/dev/null
fi

# 8. A couple of activities + FAQs so the page looks complete out of the box
$WP eval '
if (function_exists("update_field")) {
  update_field("activity_1_title", "Pinewood Derby", '"$HOME_ID"');
  update_field("activity_1_when", "January (Sunday)", '"$HOME_ID"');
  update_field("activity_1_description", "Scouts build and race their own wooden cars!", '"$HOME_ID"');
  update_field("faq_1_question", "Who Can Participate?", '"$HOME_ID"');
  update_field("faq_1_icon", "people", '"$HOME_ID"');
  update_field("faq_1_answer", "<p>Any child in Kindergarten through 5th grade is welcome.</p>", '"$HOME_ID"');
}'

# 9. Host-agnostic URLs so localhost / hostname / LAN-IP all work (no localhost redirect)
$WP config set WP_HOME    "isset(\$_SERVER['HTTP_HOST']) ? 'http://'.\$_SERVER['HTTP_HOST'] : 'http://localhost:8080'" --raw --type=constant
$WP config set WP_SITEURL "isset(\$_SERVER['HTTP_HOST']) ? 'http://'.\$_SERVER['HTTP_HOST'] : 'http://localhost:8080'" --raw --type=constant

echo "=== ready: http://localhost:8080  (admin / admin) ==="
