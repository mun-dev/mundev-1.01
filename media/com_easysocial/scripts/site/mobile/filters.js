EasySocial.module('site/mobile/filters', function($) {

var module = this;

EasySocial.require()
.library('sly')
.done(function($) {

EasySocial.Controller('Mobile.Filters', {
	defaultOptions: {
		"{sliders}": "[data-es-sly-slider]",
		"{sliderGroup}": "[data-es-sly-slider-group]",

		"{group}": "[data-es-sly-filter-group]",
		"{groupSection}": "[data-es-sly-group]"
	}
}, function(self, opts, base) { return {

	init: function() {
		var activeGroup = self.getActiveGroup();
		var slider = self.getSliderFromGroup(activeGroup);

		// Init slider that is already visible
		self.initSlider(slider);

		if (self.sliderGroup().length > 0) {
			self.initSlider(self.sliderGroup());
		}
	},

	getActiveGroup: function() {
		return self.groupSection('.is-active');
	},

	getSliderFromGroup: function(group) {
		return group.find(self.sliders.selector);
	},

	initSlider: function(slider) {
		var sliderController = slider.controller();

		// Ensure that it hasn't been implemented before
		if (sliderController === undefined) {
			slider.implement(EasySocial.Controller.Mobile.Filters.Slider);
		}
	},

	"{group} click": function(element) {
		var group = element.data('type');
		var section = self.groupSection('[data-type=' + group + ']');
		var isDialog = element.data('dialog') !== undefined;

		if (!isDialog) {

			if (group) {
				self.groupSection().addClass('t-hidden');
				section.removeClass('t-hidden');
			}

			var slider = self.getSliderFromGroup(section);
			self.initSlider(slider);
		}

		// For dialogs, we need to render a dialog
		if (isDialog) {
			var child = section.children().clone();
			child.removeClass('t-hidden');

			EasySocial.dialog({
				"content": child[0]
			});
		}
	}
}});

EasySocial.Controller('Mobile.Filters.Slider', {
	defaultOptions: {
		sliderOptions: {
			horizontal: 1,
			itemNav: 'basic',
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			// activeClass: 'is-active' // Simulate this in {item} click instead.
			startAt: null,
			scrollBy: 1,
			speed: 300,
			elasticBounds: 0,
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1
		},

		// Slider item
		"{item}": "[data-es-sly-item]"
	}
}, function(self, opts) { return {
	init: function() {
		self.initSly();
	},

	getSelected: function() {
		var activeIndex = 0;

		self.item().each(function(index, item) {
			var item = $(item);

			if (item.hasClass('is-active')) {
				activeIndex = index;
			}


		});

		return activeIndex;
	},

	// Binded to sly
	onMove: function() {
		self.element.removeClass('is-end-left is-end-right');

		if (this.pos.cur == this.pos.start) {
			self.element.addClass('is-end-left');
		}

		if (this.pos.cur == this.pos.end) {
			self.element.addClass('is-end-right');
		}
	},

	initSly: function() {
		// Initialize selected
		var selectedIndex = self.getSelected();

		var options = $.extend({}, opts.sliderOptions, {
			startAt: selectedIndex
		});

		// Activate sly animation
		self.element.sly(options);

		self.element.sly('on', 'load move', self.onMove);
	},

	"{item} click": function(element) {
		var isDialog = element.data('dialog') !== undefined;

		// Check if the filter is rendering dialog
		if (!isDialog) {
			self.item().removeClass('is-active');
			element.addClass('is-active');
		}
	}
}});

module.resolve();

});

});

