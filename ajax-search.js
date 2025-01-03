jQuery(document).ready(function($) {
    function fetchCareers(title = '', location = '') {
        $('#preloader').show();
        $.ajax({
            url: ajax_search_params.ajax_url,
            type: 'POST',
            data: {
                action: 'search_careers',
                title: title,
                location: location,
            },
            success: function(response) {
                $('#careers-results').html(response);
            },
            complete: function() {
                $('#preloader').hide(); // Hide preloader
            }
        });
    }

    // Fetch all careers on page load
    fetchCareers();

    $('#search-careers-form').on('submit', function(event) {
        event.preventDefault();
        var title = $('#career-title').val();
        var location = $('#job-location').val();
        fetchCareers(title, location);
    });
});
