<?php
/**
 * Pack 3 Albany Theme Functions (ACF Version)
 */

defined('ABSPATH') || exit;

// Calendar feed parser
require_once get_template_directory() . '/inc/calendar-feed.php';

// ACF field definitions
require_once get_template_directory() . '/inc/acf-fields.php';

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

    add_image_size('leader-avatar', 150, 150, true);
    add_image_size('activity-card', 800, 440, true);
}
add_action('after_setup_theme', 'pack3_setup');

/**
 * Enqueue fonts, styles, and scripts.
 */
function pack3_enqueue_assets() {
    wp_enqueue_style(
        'pack3-google-fonts',
        'https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Fredoka:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'pack3-style',
        get_stylesheet_uri(),
        array('pack3-google-fonts'),
        wp_get_theme()->get('Version')
    );

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
 * Show admin notice if ACF is not installed.
 */
function pack3_acf_notice() {
    if (!class_exists('ACF')) {
        echo '<div class="notice notice-error"><p><strong>Pack 3 Theme:</strong> This theme requires the <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">Advanced Custom Fields</a> plugin (free). Please install and activate it.</p></div>';
    }
}
add_action('admin_notices', 'pack3_acf_notice');

/**
 * Helper: get an ACF field with a fallback default.
 */
function pack3_field($name, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }
    $value = get_field($name);
    return ($value !== null && $value !== '' && $value !== false) ? $value : $default;
}

/**
 * Helper: get FAQ icon SVG by key.
 */
function pack3_faq_icon_svg($icon_key) {
    $icons = array(
        'people'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
        'question' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>',
        'dollar'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>',
        'clock'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
        'star'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>',
        'shield'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
        'heart'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>',
        'info'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>',
    );
    return isset($icons[$icon_key]) ? $icons[$icon_key] : $icons['question'];
}
