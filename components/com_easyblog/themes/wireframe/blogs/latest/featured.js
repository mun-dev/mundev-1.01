EasyBlog.require()
<<<<<<< HEAD
.script('site/vendors/swiper')
.done(function($) {

	var swiper = new Swiper($('[data-eb-featured-container]'), {
		"freeMode": false,
		"slidesPerView": 'auto',

		<?php if ($this->params->get('featured_auto_slide', true)) { ?>
		"autoplay": {
			"delay": <?php echo $this->params->get('featured_auto_slide_interval', 8) * 1000;?>
		}
		<?php } ?>
	});

	// Prev and Next button
	$('[data-featured-posts] [data-featured-previous]').on('click', function() {
		swiper.slidePrev();
	});

	$('[data-featured-posts] [data-featured-next]').on('click', function() {
		swiper.slideNext();
	});
=======
.done(function($) {

	// https://github.com/joomla/joomla-cms/issues/475
	// Override if Mootools loaded
	if (typeof MooTools != 'undefined' ) {
		var mHide = Element.prototype.hide;
		var mShow = Element.prototype.show;
		var mSlide = Element.prototype.slide;

		Element.implement({
			hide: function () {
				if (this.hasClass("mootools-noconflict")) {
					return this;
				}
				mHide.apply(this, arguments);
			},

			show: function (v) {
				if (this.hasClass("mootools-noconflict")) {
					return this;
				}
				mShow.apply(this, v);
			},

			slide: function (v) {
				if (this.hasClass("mootools-noconflict")) {
					return this;
				}
				mSlide.apply(this, v);
			}
		});
	};

	// Prev and Next button
	$('a[data-bp-slide="prev"]').click(function() {
	  $('[data-featured-posts]').carousel('prev');
	});
	$('a[data-bp-slide="next"]').click(function() {
	  $('[data-featured-posts]').carousel('next');
	});

// Auto slider
<?php if ($this->params->get('featured_auto_slide', true)) { ?>
	$('[data-featured-posts]').carousel({
		interval: <?php echo $this->params->get('featured_auto_slide_interval', 8) * 1000;?>,
		pause: true
	});
<?php } else { ?>
	$('[data-featured-posts]').carousel({
		interval: false,
		pause: true
	});
<?php } ?>
>>>>>>> master
});