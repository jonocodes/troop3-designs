<?php
/**
 * Pack 3 Albany Theme Functions
 */

defined('ABSPATH') || exit;

// Calendar feed parser
require_once get_template_directory() . '/inc/calendar-feed.php';

/**
 * Theme setup: menus, image sizes, title tag.
 */
function pack3_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'primary'  => 'Primary Navigation',
        'footer'   => 'Footer Navigation',
    ));

    // Leader photo size
    add_image_size('leader-avatar', 150, 150, true);
}
add_action('after_setup_theme', 'pack3_setup');

/**
 * Enqueue fonts, styles, and scripts.
 */
function pack3_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'pack3-google-fonts',
        'https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Fredoka:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Theme stylesheet
    wp_enqueue_style(
        'pack3-style',
        get_stylesheet_uri(),
        array('pack3-google-fonts'),
        wp_get_theme()->get('Version')
    );

    // Main JS
    wp_enqueue_script(
        'pack3-main',
        get_template_directory_uri() . '/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'pack3_enqueue_assets');

/**
 * Register the "Leaders" custom post type.
 */
function pack3_register_leaders_cpt() {
    register_post_type('pack3_leader', array(
        'labels' => array(
            'name'               => 'Leaders',
            'singular_name'      => 'Leader',
            'add_new'            => 'Add New Leader',
            'add_new_item'       => 'Add New Leader',
            'edit_item'          => 'Edit Leader',
            'all_items'          => 'All Leaders',
            'search_items'       => 'Search Leaders',
            'not_found'          => 'No leaders found',
            'not_found_in_trash' => 'No leaders found in Trash',
            'menu_name'          => 'Leaders',
        ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'menu_icon'    => 'dashicons-groups',
        'supports'     => array('title', 'thumbnail'),
        'has_archive'  => false,
        'rewrite'      => false,
    ));
}
add_action('init', 'pack3_register_leaders_cpt');

/**
 * Register custom meta fields for Leaders.
 */
function pack3_register_leader_meta() {
    register_post_meta('pack3_leader', '_pack3_leader_role', array(
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
        'default'      => '',
    ));
    register_post_meta('pack3_leader', '_pack3_leader_description', array(
        'type'         => 'string',
        'single'       => true,
        'show_in_rest' => true,
        'default'      => '',
    ));
    register_post_meta('pack3_leader', '_pack3_leader_order', array(
        'type'         => 'integer',
        'single'       => true,
        'show_in_rest' => true,
        'default'      => 10,
    ));
}
add_action('init', 'pack3_register_leader_meta');

/**
 * Add meta boxes for Leader fields in the admin.
 */
function pack3_leader_meta_boxes() {
    add_meta_box(
        'pack3_leader_details',
        'Leader Details',
        'pack3_leader_meta_box_html',
        'pack3_leader',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'pack3_leader_meta_boxes');

/**
 * Render the Leader meta box.
 */
function pack3_leader_meta_box_html($post) {
    $role = get_post_meta($post->ID, '_pack3_leader_role', true);
    $desc = get_post_meta($post->ID, '_pack3_leader_description', true);
    $order = get_post_meta($post->ID, '_pack3_leader_order', true);
    wp_nonce_field('pack3_leader_meta', 'pack3_leader_nonce');
    ?>
    <table class="form-table">
        <tr>
            <th><label for="pack3_leader_role">Role</label></th>
            <td><input type="text" id="pack3_leader_role" name="pack3_leader_role" value="<?php echo esc_attr($role); ?>" class="regular-text" placeholder="e.g. Cubmaster, Den Leader - Bears"></td>
        </tr>
        <tr>
            <th><label for="pack3_leader_description">Description</label></th>
            <td><textarea id="pack3_leader_description" name="pack3_leader_description" rows="3" class="large-text" placeholder="A short bio or note about this leader."><?php echo esc_textarea($desc); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="pack3_leader_order">Sort Order</label></th>
            <td><input type="number" id="pack3_leader_order" name="pack3_leader_order" value="<?php echo esc_attr($order ?: 10); ?>" class="small-text" min="0"> <span class="description">Lower numbers appear first.</span></td>
        </tr>
    </table>
    <p class="description">Set the leader's name as the post title. Use "Set Featured Image" on the right to upload their photo.</p>
    <?php
}

/**
 * Save Leader meta fields.
 */
function pack3_save_leader_meta($post_id) {
    if (!isset($_POST['pack3_leader_nonce']) || !wp_verify_nonce($_POST['pack3_leader_nonce'], 'pack3_leader_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['pack3_leader_role'])) {
        update_post_meta($post_id, '_pack3_leader_role', sanitize_text_field($_POST['pack3_leader_role']));
    }
    if (isset($_POST['pack3_leader_description'])) {
        update_post_meta($post_id, '_pack3_leader_description', sanitize_textarea_field($_POST['pack3_leader_description']));
    }
    if (isset($_POST['pack3_leader_order'])) {
        update_post_meta($post_id, '_pack3_leader_order', absint($_POST['pack3_leader_order']));
    }
}
add_action('save_post_pack3_leader', 'pack3_save_leader_meta');

/**
 * Get all leaders, sorted by order.
 *
 * @return WP_Post[] Array of leader posts.
 */
function pack3_get_leaders() {
    return get_posts(array(
        'post_type'      => 'pack3_leader',
        'posts_per_page' => -1,
        'orderby'        => 'meta_value_num',
        'meta_key'       => '_pack3_leader_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ));
}

/**
 * Register homepage custom fields for meeting info.
 */
function pack3_register_homepage_meta() {
    $fields = array(
        '_pack3_meeting_day',
        '_pack3_meeting_time',
        '_pack3_meeting_location',
        '_pack3_meeting_address',
    );
    foreach ($fields as $field) {
        register_post_meta('page', $field, array(
            'type'         => 'string',
            'single'       => true,
            'show_in_rest' => true,
            'default'      => '',
        ));
    }
}
add_action('init', 'pack3_register_homepage_meta');

/**
 * Add meeting info meta box to the Home page.
 */
function pack3_homepage_meta_boxes() {
    $home_page_id = get_option('page_on_front');
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'page') {
        add_meta_box(
            'pack3_meeting_info',
            'Pack Meeting Info',
            'pack3_meeting_meta_box_html',
            'page',
            'normal',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'pack3_homepage_meta_boxes');

/**
 * Render the meeting info meta box.
 */
function pack3_meeting_meta_box_html($post) {
    $day = get_post_meta($post->ID, '_pack3_meeting_day', true);
    $time = get_post_meta($post->ID, '_pack3_meeting_time', true);
    $loc = get_post_meta($post->ID, '_pack3_meeting_location', true);
    $addr = get_post_meta($post->ID, '_pack3_meeting_address', true);
    wp_nonce_field('pack3_meeting_meta', 'pack3_meeting_nonce');
    ?>
    <table class="form-table">
        <tr>
            <th><label for="pack3_meeting_day">Meeting Day</label></th>
            <td><input type="text" id="pack3_meeting_day" name="pack3_meeting_day" value="<?php echo esc_attr($day ?: 'First Thursday of each month'); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="pack3_meeting_time">Meeting Time</label></th>
            <td><input type="text" id="pack3_meeting_time" name="pack3_meeting_time" value="<?php echo esc_attr($time ?: '6:30 PM - 8:00 PM'); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="pack3_meeting_location">Venue Name</label></th>
            <td><input type="text" id="pack3_meeting_location" name="pack3_meeting_location" value="<?php echo esc_attr($loc ?: 'Veterans Memorial Hall'); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="pack3_meeting_address">Venue Address</label></th>
            <td><input type="text" id="pack3_meeting_address" name="pack3_meeting_address" value="<?php echo esc_attr($addr ?: '1325 Portland Avenue'); ?>" class="regular-text"></td>
        </tr>
    </table>
    <p class="description">These fields are used in the Organization section and footer on the homepage.</p>
    <?php
}

/**
 * Save meeting info meta fields.
 */
function pack3_save_meeting_meta($post_id) {
    if (!isset($_POST['pack3_meeting_nonce']) || !wp_verify_nonce($_POST['pack3_meeting_nonce'], 'pack3_meeting_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('pack3_meeting_day', 'pack3_meeting_time', 'pack3_meeting_location', 'pack3_meeting_address');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_page', 'pack3_save_meeting_meta');
