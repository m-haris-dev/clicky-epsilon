<?php
echo '<div class="service-slider">';

foreach ($page_ids as $page_id) {
    $page = get_post($page_id);
    if ($page && $page->post_type == 'page') {
        $title = get_the_title($page_id);
        $excerpt = get_the_excerpt($page_id);
        $featured_image_url = get_the_post_thumbnail_url($page_id, 'full');
        $page_btn = get_post_meta($page_id, 'page_readmore', true);
        $page_title = get_post_meta($page_id, 'page_service_title', true);
        ?>
        <div class="service-box" style="background-image: url('<?php echo $featured_image_url; ?>')">
            <div class="service-content">
                <h4><?php echo $page_title; ?></h4>
                <div class="desc"><?php echo $excerpt; ?></div>
                <?php
                if(!empty($page_btn)){
                ?>
                    <a href="<?php echo get_the_permalink($page_id); ?>"><?php echo $page_btn; ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}
echo '</div>';
