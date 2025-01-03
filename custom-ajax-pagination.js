jQuery(document).ready(function($) {
    function loadPosts(page) {
        $('#preloader').show(); // Show preloader

        $.ajax({
            url: custom_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'custom_ajax_fetch_posts',
                page: page,
            },
            success: function(response) {
                $('#news-grid-container').html(response);

                // Highlight the active page number
                $('.page-numbers').removeClass('active');
                $('.page-numbers[data-page="' + page + '"]').addClass('active');
            },
            error: function() {
                alert('An error occurred while fetching the posts.');
            },
            complete: function() {
                $('#preloader').hide(); // Hide preloader
            }
        });
    }

    // Initial load
    loadPosts(custom_ajax_object.start_page);

    // Handle pagination click
    $(document).on('click', '.page-numbers', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        loadPosts(page);
    });
});
