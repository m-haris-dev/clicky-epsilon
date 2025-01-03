<?php
/**
 * File: class.eps-loader.php
*/
if (!class_exists('EPS_LOADER')) {

	class EPS_LOADER
	{
        public function __construct()
		{
            add_action( 'wp_enqueue_scripts', array($this, 'enqueue_slick_slider_assets'));
            add_action( 'init', array($this, 'create_team_cpt' ));
            add_action( 'init', array($this, 'create_career_cpt' ));
            add_action( 'init', array($this, 'create_testimonial_cpt' ));
            add_action('init', array($this, 'register_testimonial_taxonomy'));
            add_action('init', array($this, 'register_team_taxonomy'));
            add_action('init', array($this, 'register_career_taxonomy'));
            add_action('init', array($this, 'create_featured_work_cpt'));
            add_action('init', array($this, 'register_featured_taxonomy'));
            add_filter('template_include', array($this, 'featured_archive_template'));
            add_filter('template_include', array($this, 'career_archive_template'));
            add_action('wp_enqueue_scripts', array($this, 'custom_plugin_enqueue_scripts'));
            add_action('wp_ajax_nopriv_custom_ajax_fetch_posts', array($this, 'custom_ajax_fetch_posts'));
            add_action('wp_ajax_custom_ajax_fetch_posts', array($this,'custom_ajax_fetch_posts'));
            add_action( 'wp_ajax_search_careers', array($this, 'search_careers' ));
            add_action( 'wp_ajax_nopriv_search_careers', array($this, 'search_careers' ));
            add_action( 'wp_enqueue_scripts', array($this, 'enqueue_ajax_search_script' ));
        }

        function enqueue_slick_slider_assets() {
            wp_enqueue_style( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
            wp_enqueue_style( 'slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );
            wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ), null, true );
            wp_enqueue_script( 'custom-slick-init', plugin_dir_url(dirname(__FILE__)) . 'custom-slick-init.js', array( 'jquery', 'slick-js' ), null, true );
            wp_enqueue_style( 'custom-style', plugin_dir_url(dirname(__FILE__)) . 'custom-style.css' );
        }

        function create_team_cpt() {

            $labels = array(
                'name'                  => _x( 'Teams', 'Post Type General Name', 'text_domain' ),
                'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'             => __( 'Teams', 'text_domain' ),
                'name_admin_bar'        => __( 'Team', 'text_domain' ),
                'archives'              => __( 'Team Archives', 'text_domain' ),
                'attributes'            => __( 'Team Attributes', 'text_domain' ),
                'parent_item_colon'     => __( 'Parent Team:', 'text_domain' ),
                'all_items'             => __( 'All Teams', 'text_domain' ),
                'add_new_item'          => __( 'Add New Team', 'text_domain' ),
                'add_new'               => __( 'Add New', 'text_domain' ),
                'new_item'              => __( 'New Team', 'text_domain' ),
                'edit_item'             => __( 'Edit Team', 'text_domain' ),
                'update_item'           => __( 'Update Team', 'text_domain' ),
                'view_item'             => __( 'View Team', 'text_domain' ),
                'view_items'            => __( 'View Teams', 'text_domain' ),
                'search_items'          => __( 'Search Team', 'text_domain' ),
                'not_found'             => __( 'Not found', 'text_domain' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
                'featured_image'        => __( 'Featured Image', 'text_domain' ),
                'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
                'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
                'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
                'insert_into_item'      => __( 'Insert into team', 'text_domain' ),
                'uploaded_to_this_item' => __( 'Uploaded to this team', 'text_domain' ),
                'items_list'            => __( 'Teams list', 'text_domain' ),
                'items_list_navigation' => __( 'Teams list navigation', 'text_domain' ),
                'filter_items_list'     => __( 'Filter teams list', 'text_domain' ),
            );
            $args = array(
                'label'                 => __( 'Team', 'text_domain' ),
                'description'           => __( 'Post Type Description', 'text_domain' ),
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor', 'thumbnail' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
            );
            register_post_type( 'team', $args );
        
        }

        function create_testimonial_cpt() {

            $labels = array(
                'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
                'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'             => __( 'Testimonials', 'text_domain' ),
                'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
                'archives'              => __( 'Testimonial Archives', 'text_domain' ),
                'attributes'            => __( 'Testimonial Attributes', 'text_domain' ),
                'parent_item_colon'     => __( 'Parent Testimonial:', 'text_domain' ),
                'all_items'             => __( 'All Testimonials', 'text_domain' ),
                'add_new_item'          => __( 'Add New Testimonial', 'text_domain' ),
                'add_new'               => __( 'Add New', 'text_domain' ),
                'new_item'              => __( 'New Testimonial', 'text_domain' ),
                'edit_item'             => __( 'Edit Testimonial', 'text_domain' ),
                'update_item'           => __( 'Update Testimonial', 'text_domain' ),
                'view_item'             => __( 'View Testimonial', 'text_domain' ),
                'view_items'            => __( 'View Testimonials', 'text_domain' ),
                'search_items'          => __( 'Search Testimonial', 'text_domain' ),
                'not_found'             => __( 'Not found', 'text_domain' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
                'featured_image'        => __( 'Featured Image', 'text_domain' ),
                'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
                'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
                'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
                'insert_into_item'      => __( 'Insert into Testimonial', 'text_domain' ),
                'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'text_domain' ),
                'items_list'            => __( 'Testimonials list', 'text_domain' ),
                'items_list_navigation' => __( 'Testimonials list navigation', 'text_domain' ),
                'filter_items_list'     => __( 'Filter Testimonials list', 'text_domain' ),
            );
            $args = array(
                'label'                 => __( 'Testimonial', 'text_domain' ),
                'description'           => __( 'Post Type Description', 'text_domain' ),
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor', 'thumbnail' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
            );
            register_post_type( 'testimonial', $args );
        
        }

        function register_testimonial_taxonomy() {
            // Define the labels for the taxonomy
            $labels = array(
                'name'              => _x('Testimonial Categories', 'taxonomy general name', 'textdomain'),
                'singular_name'     => _x('Testimonial Category', 'taxonomy singular name', 'textdomain'),
                'search_items'      => __('Search Testimonial Categories', 'textdomain'),
                'all_items'         => __('All Testimonial Categories', 'textdomain'),
                'parent_item'       => __('Parent Testimonial Category', 'textdomain'),
                'parent_item_colon' => __('Parent Testimonial Category:', 'textdomain'),
                'edit_item'         => __('Edit Testimonial Category', 'textdomain'),
                'update_item'       => __('Update Testimonial Category', 'textdomain'),
                'add_new_item'      => __('Add New Testimonial Category', 'textdomain'),
                'new_item_name'     => __('New Testimonial Category Name', 'textdomain'),
                'menu_name'         => __('Testimonial Categories', 'textdomain'),
            );

            // Define the arguments for the taxonomy
            $args = array(
                'hierarchical'      => true, // Set to true for categories, false for tags
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array('slug' => 'Testimonial-category'),
            );

            // Register the taxonomy for the "testimonial" post type
            register_taxonomy('testimonial_cat', array('testimonial'), $args);
        }

        function register_team_taxonomy() {
            // Define the labels for the taxonomy
            $labels = array(
                'name'              => _x('Team Categories', 'taxonomy general name', 'textdomain'),
                'singular_name'     => _x('Team Category', 'taxonomy singular name', 'textdomain'),
                'search_items'      => __('Search Team Categories', 'textdomain'),
                'all_items'         => __('All Team Categories', 'textdomain'),
                'parent_item'       => __('Parent Team Category', 'textdomain'),
                'parent_item_colon' => __('Parent Team Category:', 'textdomain'),
                'edit_item'         => __('Edit Team Category', 'textdomain'),
                'update_item'       => __('Update Team Category', 'textdomain'),
                'add_new_item'      => __('Add New Team Category', 'textdomain'),
                'new_item_name'     => __('New Team Category Name', 'textdomain'),
                'menu_name'         => __('Team Categories', 'textdomain'),
            );

            // Define the arguments for the taxonomy
            $args = array(
                'hierarchical'      => true, // Set to true for categories, false for tags
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array('slug' => 'team-category'),
            );

            // Register the taxonomy for the "Team" post type
            register_taxonomy('team_cat', array('team'), $args);
        }

        function create_featured_work_cpt() {
            $labels = array(
                'name'                  => _x( 'Featured Works', 'Post Type General Name', 'text_domain' ),
                'singular_name'         => _x( 'Featured Work', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'             => __( 'Featured Works', 'text_domain' ),
                'name_admin_bar'        => __( 'Featured Work', 'text_domain' ),
                'archives'              => __( 'Featured Work Archives', 'text_domain' ),
                'attributes'            => __( 'Featured Work Attributes', 'text_domain' ),
                'parent_item_colon'     => __( 'Parent Featured Work:', 'text_domain' ),
                'all_items'             => __( 'All Featured Works', 'text_domain' ),
                'add_new_item'          => __( 'Add New Featured Work', 'text_domain' ),
                'add_new'               => __( 'Add New', 'text_domain' ),
                'new_item'              => __( 'New Featured Work', 'text_domain' ),
                'edit_item'             => __( 'Edit Featured Work', 'text_domain' ),
                'update_item'           => __( 'Update Featured Work', 'text_domain' ),
                'view_item'             => __( 'View Featured Work', 'text_domain' ),
                'view_items'            => __( 'View Featured Works', 'text_domain' ),
                'search_items'          => __( 'Search Featured Work', 'text_domain' ),
                'not_found'             => __( 'Not found', 'text_domain' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
                'featured_image'        => __( 'Featured Image', 'text_domain' ),
                'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
                'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
                'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
                'insert_into_item'      => __( 'Insert into Featured Work', 'text_domain' ),
                'uploaded_to_this_item' => __( 'Uploaded to this Featured Work', 'text_domain' ),
                'items_list'            => __( 'Featured Works list', 'text_domain' ),
                'items_list_navigation' => __( 'Featured Works list navigation', 'text_domain' ),
                'filter_items_list'     => __( 'Filter Featured Works list', 'text_domain' ),
            );
            $args = array(
                'label'                 => __( 'Featured Work', 'text_domain' ),
                'description'           => __( 'Post Type Description', 'text_domain' ),
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor', 'thumbnail' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
            );
            register_post_type( 'featured-work', $args );
        }

        function register_featured_taxonomy() {
            $labels = array(
                'name'              => _x('Featured Categories', 'taxonomy general name', 'textdomain'),
                'singular_name'     => _x('Featured Category', 'taxonomy singular name', 'textdomain'),
                'search_items'      => __('Search Featured Categories', 'textdomain'),
                'all_items'         => __('All Featured Categories', 'textdomain'),
                'parent_item'       => __('Parent Featured Category', 'textdomain'),
                'parent_item_colon' => __('Parent Featured Category:', 'textdomain'),
                'edit_item'         => __('Edit Featured Category', 'textdomain'),
                'update_item'       => __('Update Featured Category', 'textdomain'),
                'add_new_item'      => __('Add New Featured Category', 'textdomain'),
                'new_item_name'     => __('New Featured Category Name', 'textdomain'),
                'menu_name'         => __('Featured Categories', 'textdomain'),
            );
            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array('slug' => 'featured-category'),
            );
            register_taxonomy('featured_cat', array('featured-work'), $args);
        }

        function featured_archive_template($template) {
            if (is_post_type_archive('featured-work')) {
                $theme_files = array('archive-featured-work.php');
                $exists_in_theme = locate_template($theme_files, false);
                if ($exists_in_theme != '') {
                    return $exists_in_theme;
                } else {
                    return plugin_dir_path(__FILE__) . 'templates/archive-featured-work.php';
                }
            }
            return $template;
        }

        function career_archive_template($template) {
            if (is_post_type_archive('careers')) {
                $theme_files = array('archive-careers.php');
                $exists_in_theme = locate_template($theme_files, false);
                if ($exists_in_theme != '') {
                    return $exists_in_theme;
                } else {
                    return plugin_dir_path(__FILE__) . 'templates/archive-careers.php';
                }
            }
            return $template;
        }

        function custom_ajax_fetch_posts() {
            // Get the current page number
            $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
        
            // Set up the query arguments
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'paged' => $paged,
            );
            // Query the posts
            $query = new WP_Query($args);
            // Check if there are posts
            if ($query->have_posts()) {
                $i=0;
                while ($query->have_posts()) : $query->the_post();
                $i++;
                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    // Output your post template (adjust this to match your needs)
                ?>
                <div class="news-grid-content">
                <?php
                if($thumbnail_url){
                ?>
                    <img class="news-img" src="<?php echo $thumbnail_url; ?>" alt="">
                <?php
                }
                ?>
                    <div class="news-content-left">
                        <a href="<?php echo get_the_permalink(); ?>"><h4><?php echo get_the_title(); ?></h4></a>
                        <div class="news-desc"><?php echo get_the_excerpt(); ?></div>
                        <div class="news-pub">
                            <div>
                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/news-logo.png" alt="">
                            </div>
                            <div>
                                <span class="news-publisher">EPSILON INC.</span>
                                <span class="news-date"><?php echo get_the_date('M d, Y'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="news-content-share">
                        <div class="social-share">
                            <label class="toggle" for="toggle-<?php echo $i; ?>">
                            <input type="checkbox" id="toggle-<?php echo $i; ?>" />
                            <div class="btn-social">
                                <i class="fas fa-share-alt"></i>
                                <i class="fas fa-times"></i>
                                <div class="social">
                                <a href="mailto:?subject=Check out Epsilon Inc. <?php echo get_the_title();  ?> &amp; body=I found this on Epsilon Inc .  Check it out: <?php echo get_the_permalink(); ?>">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                </div>
                            </div>
                            </label>
                        </div>
                    </div>
                </div>
                <?php
                endwhile;
        
                // Generate pagination
                $total_pages = $query->max_num_pages;
                if ($total_pages > 1) {
                    echo '<div class="news-grid-pagination" id="pagination">';
                    for ($i = 1; $i <= $total_pages; $i++) {
                        $active_class = ($i == $paged) ? ' active' : '';
                        echo '<a href="#" class="page-numbers' . $active_class . '" data-page="' . $i . '">' . $i . '</a>';
                    }
                    echo '</div>';
                }
        
                // Reset post data
                wp_reset_postdata();
            }
            else{
                echo '<div class="post-not-found"> No more posts to load. </div>';
            }
            wp_die();
        }

        function custom_plugin_enqueue_scripts() {
            wp_enqueue_script('custom-ajax-pagination', plugin_dir_url(dirname(__FILE__)) . 'custom-ajax-pagination.js', array('jquery'), null, true);
            // Pass the AJAX URL and the initial page number to the script
            wp_localize_script('custom-ajax-pagination', 'custom_ajax_object', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'start_page' => 1
            ));
        }

        function create_career_cpt() {

            $labels = array(
                'name'                  => _x( 'Careers', 'Post Type General Name', 'text_domain' ),
                'singular_name'         => _x( 'Career', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'             => __( 'Careers', 'text_domain' ),
                'name_admin_bar'        => __( 'Career', 'text_domain' ),
                'archives'              => __( 'Career Archives', 'text_domain' ),
                'attributes'            => __( 'Career Attributes', 'text_domain' ),
                'parent_item_colon'     => __( 'Parent Career:', 'text_domain' ),
                'all_items'             => __( 'All Careers', 'text_domain' ),
                'add_new_item'          => __( 'Add New Career', 'text_domain' ),
                'add_new'               => __( 'Add New', 'text_domain' ),
                'new_item'              => __( 'New Career', 'text_domain' ),
                'edit_item'             => __( 'Edit Career', 'text_domain' ),
                'update_item'           => __( 'Update Career', 'text_domain' ),
                'view_item'             => __( 'View Career', 'text_domain' ),
                'view_items'            => __( 'View Careers', 'text_domain' ),
                'search_items'          => __( 'Search Career', 'text_domain' ),
                'not_found'             => __( 'Not found', 'text_domain' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
                'featured_image'        => __( 'Featured Image', 'text_domain' ),
                'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
                'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
                'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
                'insert_into_item'      => __( 'Insert into Career', 'text_domain' ),
                'uploaded_to_this_item' => __( 'Uploaded to this Career', 'text_domain' ),
                'items_list'            => __( 'Careers list', 'text_domain' ),
                'items_list_navigation' => __( 'Careers list navigation', 'text_domain' ),
                'filter_items_list'     => __( 'Filter Careers list', 'text_domain' ),
            );
            $args = array(
                'label'                 => __( 'Career', 'text_domain' ),
                'description'           => __( 'Post Type Description', 'text_domain' ),
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor', 'thumbnail' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
            );
            register_post_type( 'careers', $args );
        
        }

        function register_career_taxonomy() {
            $labels = array(
                'name'              => _x('Job Location', 'taxonomy general name', 'textdomain'),
                'singular_name'     => _x('Job Location', 'taxonomy singular name', 'textdomain'),
                'search_items'      => __('Search Job Location', 'textdomain'),
                'all_items'         => __('All Job Location', 'textdomain'),
                'parent_item'       => __('Parent Job Location', 'textdomain'),
                'parent_item_colon' => __('Parent Job Location:', 'textdomain'),
                'edit_item'         => __('Edit Job Location', 'textdomain'),
                'update_item'       => __('Update Job Location', 'textdomain'),
                'add_new_item'      => __('Add New Job Location', 'textdomain'),
                'new_item_name'     => __('New Job Location Name', 'textdomain'),
                'menu_name'         => __('Job Location', 'textdomain'),
            );
            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array('slug' => 'job-location'),
            );
            register_taxonomy('job_location', array('careers'), $args);
        }

        function search_careers() {
            $title = sanitize_text_field($_POST['title']);
            $location = sanitize_text_field($_POST['location']);
            
            $args = array(
                'post_type' => 'careers',
                'posts_per_page' => -1,
                's' => $title,
                'tax_query' => array(),
            );
        
            if (!empty($location)) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'job_location',
                    'field' => 'slug',
                    'terms' => $location,
                );
            }
            $query = new WP_Query($args);
            ob_start();
            include plugin_dir_path(__FILE__) . '/templates/careers-list-content.php';
            return ob_get_clean();
        }

        function enqueue_ajax_search_script() {
            wp_enqueue_script( 'ajax-search', plugin_dir_url(dirname(__FILE__)) . '/ajax-search.js', array( 'jquery' ), null, true );
            wp_localize_script( 'ajax-search', 'ajax_search_params', array(
                'ajax_url' => admin_url( 'admin-ajax.php' )
            ));
        }

    }
    new EPS_LOADER();
}