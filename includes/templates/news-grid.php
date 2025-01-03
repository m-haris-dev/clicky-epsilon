<?php
while ($query->have_posts()) : $query->the_post();
    // Output your post template (adjust this to match your needs)
    echo '<h2>' . get_the_title() . '</h2>';
    echo '<div>' . get_the_excerpt() . '</div>';
endwhile;