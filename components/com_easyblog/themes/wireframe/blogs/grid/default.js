EasyBlog.require()
.script('site/vendors/swiper')
.done(function($) {
	var swiper = new Swiper($('[data-eb-grid-featured-container]'), {
		"freeMode": false,
		"slidesPerView": 'auto'
	});

	// Prev and Next button
	$('[data-eb-grid-featured-container] [data-featured-previous]').on('click', function() {
		swiper.slidePrev();
	});

	$('[data-eb-grid-featured-container] [data-featured-next]').on('click', function() {
		swiper.slideNext();
	});
});