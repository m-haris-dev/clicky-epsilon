<?php
if ( $query->have_posts() ) {
    echo '
    <div class="teams-btn-wrap">
        <div class="prev-btn"><img src="'.plugin_dir_url(dirname(__FILE__)).'../assets/team-left-arrow.png"></div>
        <div class="next-btn"><img src="'.plugin_dir_url(dirname(__FILE__)).'../assets/team-right-arrow.png"></div>
    </div>
    ';
    echo '<div class="team-slider">';
    while ( $query->have_posts() ) {
        $query->the_post();
        $linkedin_profile_url = get_post_meta( get_the_ID(), '_linkedin_profile_url', true );
        ?>
        <div class="team-member">
            <?php if ( $linkedin_profile_url ){ ?>
                <a href="<?php echo esc_url( $linkedin_profile_url ); ?>" target="_blank">
            <?php }
            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            ?>
            <div class="team-slider-box" style="background-image: url('<?php echo $thumbnail_url; ?>')">
            <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>../assets/team-overlay.png" class="team-slider-overlay" alt="">    
            <div class="team-slider-content">
                    <div class="team-by-default">
                        <h4><?php the_title(); ?></h4>
                        <div><?php the_content(); ?></div>
                    </div>
                    <div class="team-hover-text">
                        <ul>
                            <li><img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>../assets/linkedin.png"></li>
                            <li>Connect with <br><?php the_title(); ?> on LinkedIn</li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if ( $linkedin_profile_url ){ ?>
            </a>
            <?php } ?>
        </div>
        <?php
    }
    echo '</div>';
}else{
    echo '<p>Not Found</p>';
}
wp_reset_postdata();