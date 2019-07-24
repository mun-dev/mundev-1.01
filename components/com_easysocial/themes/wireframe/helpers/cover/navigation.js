<?php if ($this->isMobile()) { ?>
EasySocial.require()
.library('sly')
.done(function($){
	var navItem = $('[data-es-nav-item]');
	var activeIdx = 0;

	$.each(navItem, function(idx, item) {
		if ($(item).hasClass('is-active')) {
			activeIdx = idx;
		}
	})

	var navigationBar = $('[data-mobile-sly-nav]');

	// Activate sly animation
	navigationBar.sly({
		horizontal: 1,
		itemNav: 'centered',
		smart: 1,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		activeClass: 'is-active',
		startAt: activeIdx,
		scrollBy: 1,
		speed: 300,
		elasticBounds: 0,
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1
	});

	navigationBar.sly('on', 'load move', function() {
		navigationBar.removeClass('is-end-left is-end-right');

		if (this.pos.cur == this.pos.start) {
			navigationBar.addClass('is-end-left');
		}

		if (this.pos.cur == this.pos.end) {
			navigationBar.addClass('is-end-right');
		}
	});
});
<?php } ?>