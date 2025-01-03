jQuery(document).ready(function($) {
	$(".team-slider").slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		arrows: false,
		infinite: true,
		autoplay: true,
        autoplaySpeed: 5000,
        speed: 300,
        centerMode: true,
        responsive: [
            {
              breakpoint: 1025,
              settings: {
                slidesToShow: 1,
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
              }
            },
			{
				breakpoint: 530,
				settings: {
				  slidesToShow: 1,
				  centerPadding: '0px',
				}
			}
        ]
	});
	$(".teams-btn-wrap .prev-btn").click(function () {
		$(".team-slider").slick("slickPrev");
	});

	$(".teams-btn-wrap .next-btn").click(function () {
		$(".team-slider").slick("slickNext");
	});
	$(".teams-btn-wrap .prev-btn").addClass("slick-disabled");
	$(".team-slider").on("afterChange", function () {
		if ($(".slick-prev").hasClass("slick-disabled")) {
			$(".teams-btn-wrap .prev-btn").addClass("slick-disabled");
		} else {
			$(".teams-btn-wrap .prev-btn").removeClass("slick-disabled");
		}
		if ($(".slick-next").hasClass("slick-disabled")) {
			$(".teams-btn-wrap .next-btn").addClass("slick-disabled");
		} else {
			$(".teams-btn-wrap .next-btn").removeClass("slick-disabled");
		}
	});

	$(".service-slider").slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		arrows: false,
		infinite: true,
		autoplay: true,
        autoplaySpeed: 5000,
        speed: 300,
        centerMode: true,
		centerPadding: '150px',
        responsive: [
            {
              breakpoint: 1025,
              settings: {
                slidesToShow: 1,
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
              }
            },
			{
				breakpoint: 530,
				settings: {
				  slidesToShow: 1,
				  centerPadding: '0px',
				}
			}
        ]
	});
	$(".service-btn-wrap .prev-btn").click(function () {
		$(".service-slider").slick("slickPrev");
	});

	$(".service-btn-wrap .next-btn").click(function () {
		$(".service-slider").slick("slickNext");
	});
	$(".service-btn-wrap .prev-btn").addClass("slick-disabled");
	$(".service-slider").on("afterChange", function () {
		if ($(".slick-prev").hasClass("slick-disabled")) {
			$(".service-btn-wrap .prev-btn").addClass("slick-disabled");
		} else {
			$(".service-btn-wrap .prev-btn").removeClass("slick-disabled");
		}
		if ($(".slick-next").hasClass("slick-disabled")) {
			$(".service-btn-wrap .next-btn").addClass("slick-disabled");
		} else {
			$(".service-btn-wrap .next-btn").removeClass("slick-disabled");
		}
	});

	$(".testimonial-slider").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		infinite: true,
		autoplay: true,
        autoplaySpeed: 5000,
        speed: 300,
        responsive: [
            {
              breakpoint: 1025,
              settings: {
                slidesToShow: 1,
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
              }
            },
			{
				breakpoint: 530,
				settings: {
				  slidesToShow: 1,
				}
			}
        ]
	});
	$(".testimonial-btn-wrap .prev-btn").click(function () {
		$(".testimonial-slider").slick("slickPrev");
	});

	$(".testimonial-btn-wrap .next-btn").click(function () {
		$(".testimonial-slider").slick("slickNext");
	});
	$(".testimonial-btn-wrap .prev-btn").addClass("slick-disabled");
	$(".testimonial-slider").on("afterChange", function () {
		if ($(".slick-prev").hasClass("slick-disabled")) {
			$(".testimonial-btn-wrap .prev-btn").addClass("slick-disabled");
		} else {
			$(".testimonial-btn-wrap .prev-btn").removeClass("slick-disabled");
		}
		if ($(".slick-next").hasClass("slick-disabled")) {
			$(".testimonial-btn-wrap .next-btn").addClass("slick-disabled");
		} else {
			$(".testimonial-btn-wrap .next-btn").removeClass("slick-disabled");
		}
	});

	$(".news-slider").slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		arrows: false,
		infinite: true,
		autoplay: true,
        autoplaySpeed: 5000,
        speed: 300,
        centerMode: true,
        responsive: [
            {
              breakpoint: 1025,
              settings: {
                slidesToShow: 1,
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1,
              }
            },
			{
				breakpoint: 530,
				settings: {
				  slidesToShow: 1,
				  centerPadding: '0px',
				}
			}
        ]
	});
	$(".news-btn-wrap .prev-btn").click(function () {
		$(".news-slider").slick("slickPrev");
	});

	$(".news-btn-wrap .next-btn").click(function () {
		$(".news-slider").slick("slickNext");
	});
	$(".news-btn-wrap .prev-btn").addClass("slick-disabled");
	$(".news-slider").on("afterChange", function () {
		if ($(".slick-prev").hasClass("slick-disabled")) {
			$(".news-btn-wrap .prev-btn").addClass("slick-disabled");
		} else {
			$(".news-btn-wrap .prev-btn").removeClass("slick-disabled");
		}
		if ($(".slick-next").hasClass("slick-disabled")) {
			$(".news-btn-wrap .next-btn").addClass("slick-disabled");
		} else {
			$(".news-btn-wrap .next-btn").removeClass("slick-disabled");
		}
	});
	
});
