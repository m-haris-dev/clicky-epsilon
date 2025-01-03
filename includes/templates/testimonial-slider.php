<?php
if ( $query->have_posts() ) {
    echo '<div class="testimonial-slider">';
    while ( $query->have_posts() ) {
        $query->the_post();
        $testimonial_designation = get_post_meta( get_the_ID(), '_testimonial_designation', true );
        $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        ?>
        <div>
            <div class="testimonial-content">
                <div class="testimonial-msg"><?php the_content(); ?></div>
                <?php
                if($atts['moreinfo'] == 'hide' ){}
                else{
                ?>
                <div class="testimonial-bottom">
                    <div>
                        <img src="<?php echo $thumbnail_url; ?>" alt="">
                    </div>
                    <div>
                        <h4><?php the_title(); ?></h4>
                        <span><?php echo $testimonial_designation; ?></span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
    echo '</div>
    <div class="testimonial-btn-wrap">
        <div class="prev-btn"><img src="'.plugin_dir_url(dirname(__FILE__)).'../assets/team-left-arrow.png"></div>
        <div class="next-btn"><img src="'.plugin_dir_url(dirname(__FILE__)).'../assets/team-right-arrow.png"></div>
    </div>
    ';
}else{
    echo '<p>Not Found</p>';
}
wp_reset_postdata();