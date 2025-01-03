<?php
if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        ?>
        <div class="career-content-inside">
            <ul>
                <li class="career-title"><a href="<?php echo get_the_permalink(); ?>">
                <h4>
                    <?php 
                    echo get_the_title() .' - ';
                    $locations = get_the_terms( get_the_ID(), 'job_location' );
                    if ( ! empty( $locations ) && ! is_wp_error( $locations ) ) {
                        foreach ( $locations as $location ) {
                            echo esc_html( $location->name );
                        }
                    } 
                    ?>
                </h4></a>
                </li>
                <li class="career-location">
                    <span class="job-location">
                    <?php
                    $locations = get_the_terms( get_the_ID(), 'job_location' );
                    if ( ! empty( $locations ) && ! is_wp_error( $locations ) ) {
                        foreach ( $locations as $location ) {
                            echo esc_html( $location->name );
                        }
                    }
                    ?>
                    </span>
                    <span class="flexibility"><?php echo get_post_meta( get_the_ID(), '_ccf_flexibility', true ); ?></span>
                </li>
                <li class="career-apply">
                    <a class="job-apply" href="<?php echo get_post_meta( get_the_ID(), '_ccf_apply_url', true ); ?>" target="_blank">APPLY NOW</a>
                </li>
                <li class="career-readmore">
                    <a href="<?php echo get_the_permalink(); ?>"> <i class="fas fa-chevron-right"></i> </a>
                </li>
            </ul>
        </div>
        <?php
    }
} else {
    echo '<div class="post-not-found"> No Jobs Found. </div>';
}
wp_die();