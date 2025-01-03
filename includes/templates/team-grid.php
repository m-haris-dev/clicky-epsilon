<?php
if ( $query->have_posts() ) {
    echo '<div class="team-grid">';
    while ( $query->have_posts() ) {
        $query->the_post();
        $linkedin_profile_url = get_post_meta( get_the_ID(), '_linkedin_profile_url', true );
        ?>
        <div class="team-grid-member">
            <?php if ( $linkedin_profile_url ){ ?>
                <a href="<?php echo esc_url( $linkedin_profile_url ); ?>" target="_blank">
            <?php }
            $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            if(!empty($thumbnail_url)){
                ?>
                <img class="team-forhead" src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>../assets/EPSILON CIRCLES.png" alt="">
                <img class="team-img" src="<?php echo $thumbnail_url; ?>" alt="">
                <?php
            }
            ?>
            <h4><?php echo get_the_title(); ?></h4>
            <span><?php echo get_the_content(); ?></span>
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