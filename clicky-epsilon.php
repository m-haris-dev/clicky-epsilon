<?php
/*
Plugin Name: Clicky Epsilon
Description: Elevate your WordPress site with our custom plugin, featuring Service Slider, Testimonial Slider, Team Slider, News Slider, Team Grid, News Grid with pagination, Recent Post display, and Career List with search filter.
Version: 1.0
Author: ClickySoft
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add a meta box for the LinkedIn profile URL
function add_linkedin_profile_metabox() {
    add_meta_box(
        'linkedin_profile_metabox',      // Unique ID
        'LinkedIn Profile URL',          // Box title
        'linkedin_profile_metabox_html', // Content callback, must be of type callable
        'team',                          // Post type
        'side'                           // Context
    );
}
add_action( 'add_meta_boxes', 'add_linkedin_profile_metabox' );

// Display the meta box HTML
function linkedin_profile_metabox_html( $post ) {
    $value = get_post_meta( $post->ID, '_linkedin_profile_url', true );
    ?>
    <label for="linkedin_profile_url">LinkedIn Profile URL:</label>
    <input type="text" name="linkedin_profile_url" id="linkedin_profile_url" value="<?php echo esc_attr( $value ); ?>" size="25" />
    <?php
}

// Save the meta box data
function save_linkedin_profile_metabox( $post_id ) {
    if ( array_key_exists( 'linkedin_profile_url', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_linkedin_profile_url',
            sanitize_text_field( $_POST['linkedin_profile_url'] )
        );
    }
}
add_action( 'save_post', 'save_linkedin_profile_metabox' );

function add_designation_meta_box() {
    add_meta_box(
        'testimonial_designation_meta_box', // ID of the meta box
        'Designation',                      // Title of the meta box
        'display_designation_meta_box',     // Callback function
        'testimonial',                      // Post type
        'normal',                           // Context (normal, side, advanced)
        'high'                              // Priority
    );
}
add_action('add_meta_boxes', 'add_designation_meta_box');

function display_designation_meta_box($post) {
    $designation = get_post_meta($post->ID, '_testimonial_designation', true);
    wp_nonce_field(basename(__FILE__), 'testimonial_designation_nonce');
    ?>
    <label for="testimonial_designation">Designation</label>
    <input type="text" name="testimonial_designation" id="testimonial_designation" value="<?php echo esc_attr($designation); ?>" style="width: 100%;" />
    <?php
}

function save_testimonial_designation_meta_box($post_id) {
    // Check if nonce is set
    if (!isset($_POST['testimonial_designation_nonce'])) {
        return $post_id;
    }
    $nonce = $_POST['testimonial_designation_nonce'];
    // Verify that the nonce is valid
    if (!wp_verify_nonce($nonce, basename(__FILE__))) {
        return $post_id;
    }
    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // Check the user's permissions
    if (isset($_POST['post_type']) && 'testimonial' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    } else {
        return $post_id;
    }
    // Sanitize and save the data
    if (isset($_POST['testimonial_designation'])) {
        $designation = sanitize_text_field($_POST['testimonial_designation']);
        update_post_meta($post_id, '_testimonial_designation', $designation);
    }
}
add_action('save_post', 'save_testimonial_designation_meta_box');


add_action('add_meta_boxes', 'ccf_add_custom_meta_boxes');

function ccf_add_custom_meta_boxes() {
    add_meta_box(
        'ccf_flexibility',
        'Flexibility',
        'ccf_flexibility_callback',
        'careers',
        'normal',
        'high'
    );

    add_meta_box(
        'ccf_apply_url',
        'Apply URL',
        'ccf_apply_url_callback',
        'careers',
        'normal',
        'high'
    );
}

// Callback for Flexibility field
function ccf_flexibility_callback($post) {
    wp_nonce_field('ccf_save_meta_box_data', 'ccf_meta_box_nonce');
    $value = get_post_meta($post->ID, '_ccf_flexibility', true);
    echo '<label for="ccf_flexibility_field">Flexibility: </label>';
    echo '<input type="text" id="ccf_flexibility_field" name="ccf_flexibility_field" value="' . esc_attr($value) . '" size="100" />';
}

// Callback for Apply URL field
function ccf_apply_url_callback($post) {
    wp_nonce_field('ccf_save_meta_box_data', 'ccf_meta_box_nonce');
    $value = get_post_meta($post->ID, '_ccf_apply_url', true);
    echo '<label for="ccf_apply_url_field">Apply URL: </label>';
    echo '<input type="text" id="ccf_apply_url_field" name="ccf_apply_url_field" value="' . esc_url($value) . '" size="100" />';
}

// Save the meta box data
add_action('save_post', 'ccf_save_meta_box_data');
function ccf_save_meta_box_data($post_id) {
    if (!isset($_POST['ccf_meta_box_nonce']) || !wp_verify_nonce($_POST['ccf_meta_box_nonce'], 'ccf_save_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['ccf_flexibility_field'])) {
        $flexibility = sanitize_text_field($_POST['ccf_flexibility_field']);
        update_post_meta($post_id, '_ccf_flexibility', $flexibility);
    }

    if (isset($_POST['ccf_apply_url_field'])) {
        $apply_url = esc_url_raw($_POST['ccf_apply_url_field']);
        update_post_meta($post_id, '_ccf_apply_url', $apply_url);
    }
}

add_action('admin_menu', 'epsilon_custom_menu');
// Function to add the custom menu
function epsilon_custom_menu() {
    add_menu_page(
        'Epsilon Menu',    
        'Epsilon',         
        'manage_options',  
        'epsilon',         
        'epsilon_menu_page',
        'dashicons-admin-generic',
        20
    );
}
function epsilon_menu_page() {
    ?>
    <div class="wrap">
        <h1>Epsilon Shortcode List</h1>
        <h2>Services Slider Shortcode: [service_slider page_ids="476,481"]</h2>
        <h4>Page ID pass and seprate with comma</h4>

        <h2>Testimonial Slider Shortcode: [testimonial_slider cat="employee" moreinfo="hide"]</h2>
        <h4>cat="testimonial-category" and moreinfo="show" (hide or show) </h4>

        <h2>Team Slider Shortcode: [team_slider cat="recruiter"]</h2>
        <h4>Team Category Slug add</h4>
        
        <h2>News Slider Shortcode: [news_slider]</h2>
        
        <h2>Team Grid: [team_grid cat="recruiter"]</h2>
        <h4>Team Category Slug add</h4>
        
        <h2>News Grid with pagination: [news_grid]</h2>
        
        <h2>Recent Post: [recent_post]</h2>
        <h2>Career List with search filter: [careers_list]</h2>
    </div>
    <?php
}


include plugin_dir_path(__FILE__) . '/includes/class.eps-loader.php';
include plugin_dir_path(__FILE__) . '/includes/class.eps-shortcode.php';


?>