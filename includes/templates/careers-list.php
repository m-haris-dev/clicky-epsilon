<form id="search-careers-form">
    <div>
        <select id="job-location" name="location">
            <option value="">All Location</option>
            <?php 
                $locations = get_terms('job_location');
                if ( ! empty( $locations ) && ! is_wp_error( $locations ) ) {
                    foreach ( $locations as $location ) {
                        echo '<option value="' . esc_attr( $location->slug ) . '">' . esc_html( $location->name ) . '</option>';
                    }
                }
            ?>
        </select>
    </div>
    <div class="position-field">
        <i class="fas fa-search"></i>
        <input type="text" id="career-title" name="title" placeholder="Search Position">
    </div>
    <div>
        <button type="submit">SEARCH</button>
    </div>
</form>
<div id="careers-results"></div>
<div id="preloader">
    <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>../assets/loading.gif" alt="Loading...">
</div>
<?php