<?php
/**
 * File: class.eps-shortcode.php
*/
if (!class_exists('EPS_SHORTCODE')) {
    class EPS_SHORTCODE
    {
        public function __construct()
		{
            add_shortcode( 'team_slider', array($this, 'team_slider_shortcode'));
            add_shortcode( 'service_slider', array($this, 'service_slider_shortcode'));
            add_shortcode( 'testimonial_slider', array($this, 'testimonial_slider_shortcode'));
            add_shortcode( 'news_slider', array($this, 'news_slider_shortcode'));
            add_shortcode( 'team_grid', array($this, 'team_grid_shortcode'));
            add_shortcode('news_grid', array($this, 'news_grid_shortcode'));
            add_shortcode('recent_post', array($this, 'recent_post_shortcode'));
            add_shortcode('careers_list', array($this, 'career_search_shortcode'));
            add_shortcode('news_share', array($this, 'news_share_shortcode'));
        }

        function team_slider_shortcode($atts) {
            $atts = shortcode_atts(array(
                'cat' => '',
            ), $atts);
            $args = array(
                'post_type'      => 'team',
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'team_cat',
                        'field'    => 'slug',
                        'terms'    => $atts['cat'],
                    ),
                ),
            );
            $query = new WP_Query( $args );
            ob_start();
            include plugin_dir_path(__FILE__) . '/templates/team-slider.php';
            return ob_get_clean();
        }

        function service_slider_shortcode($atts){
            $atts = shortcode_atts(array(
                'page_ids' => '',
            ), $atts);
            $page_ids = explode(',', $atts['page_ids']);
            ob_start();
            include plugin_dir_path(__FILE__) . '/templates/services-slider.php';
            return ob_get_clean();
        }

        function testimonial_slider_shortcode($atts) {
            $args = array(
                'post_type' => 'testimonial',
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'testimonial_cat',
                        'field'    => 'slug',
                        'terms'    => $atts['cat'],
                    ),
                ),
            );
            $query = new WP_Query( $args );
            ob_start();
            include plugin_dir_path(__FILE__) . '/templates/testimonial-slider.php';
            return ob_get_clean();
        }

        function news_slider_shortcode() {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => -1,
            );
            $query = new WP_Query( $args );
            ob_start();
            include plugin_dir_path(__FILE__) . '/templates/news-slider.php';
            return ob_get_clean();
        }

        function team_grid_shortcode($atts) {
            $atts = shortcode_atts(array(
                'cat' => '',
            ), $atts);
            $args = array(
                'post_type'      => 'team',
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'team_cat',
                        'field'    => 'slug',
                        'terms'    => $atts['cat'],
                    ),
                ),
            );
            $query = new WP_Query( $args );
            ob_start();
            include plugin_dir_path(__FILE__) . '/templates/team-grid.php';
            return ob_get_clean();
        }

        function news_grid_shortcode() {
            ob_start();
            ?>
            <div id="news-grid-container">
                <!-- Posts will be loaded here -->
            </div>
            <div id="preloader" style="display:none;">
                <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/loading.gif'; ?>" alt="Loading...">
            </div>
            <?php
            return ob_get_clean();
        }

        function recent_post_shortcode() {
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            $query = new WP_Query( $args );
            ob_start();
            include plugin_dir_path(__FILE__) . '/templates/news-recent.php';
            return ob_get_clean();
        }

        function career_search_shortcode(){
            ob_start();
            include plugin_dir_path(__FILE__) . '/templates/careers-list.php';
            return ob_get_clean();
        }

        function news_share_shortcode() {
            if (is_singular('post')) {
                global $post;
                $post_title = get_the_title($post->ID);
                $post_url = get_permalink($post->ID);
                $html = '<div class="news-content-share">
                            <div class="social-share">
                                <label class="toggle" for="toggle">
                                <input type="checkbox" id="toggle" />
                                <div class="btn-social">
                                    <i class="fas fa-share-alt"></i>
                                    <i class="fas fa-times"></i>
                                    <div class="social">
                                    <a href="mailto:?subject=Check out Epsilon Inc. ' . esc_attr($post_title) . ' &amp;body=I found this on Epsilon Inc .  Check it out: ' . esc_url($post_url) . '">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url($post_url) . '" onclick="window.open(this.href, \'mywin\',\'left=20,top=20,width=500,height=500,toolbar=1,resizable=0\'); return false;">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    </div>
                                </div>
                                </label>
                            </div>
                        </div>';
                return $html;
            } else {
                return '';
            }
        }

    }
    new EPS_SHORTCODE();
}