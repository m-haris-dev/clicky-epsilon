<?php
if ( $query->have_posts() ) {
    echo '<div class="news-recent">';
    while ( $query->have_posts() ) {
        $query->the_post();
        ?>
        <div>
            <div class="news-recent-post">
            
                <div class="news-top">
                    <div class="news-pub">
                        <div>
                            <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>../assets/news-logo.png" alt="">
                        </div>
                        <div>
                            <span class="news-publisher">EPSILON INC.</span>
                            <span class="news-date"><?php echo get_the_date('M d, Y'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="news-center">
                    <h4><?php echo get_the_title(); ?></h4>
                </div>

                <div class="news-bottom">
                    <a href="<?php echo get_the_permalink(); ?>"><span>VIEW MORE </span><img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>../assets/read-more-icon.png" alt=""></a>
                </div>

            </div>
        </div>
        <?php
    }
    echo '</div>';
}else{
    echo '<p>Not Found</p>';
}
wp_reset_postdata();