
EasySocial.require()
.library('sly')
.script('site/story/story')
.done(function($) {

	var isMobile = false;

	<?php if ($this->isMobile() || $this->isTablet()) { ?>
	isMobile = true;
	<?php } ?>

	// define the global variable so that story controller and this js script can reference this varaible.
	window.currentStoryController = '';

	// Story controller
	var controller = $("[data-story=<?php echo $story->id; ?>]").addController("EasySocial.Controller.Story", {

			"errors": {
				"empty": "<?php echo JText::_('COM_EASYSOCIAL_STORY_CONTENT_EMPTY', true);?>",
				"filter": "<?php echo JText::_('COM_EASYSOCIAL_STORY_NOT_ON_STREAM_FILTER', true);?>",
				"standard": "<?php echo JText::_('COM_EASYSOCIAL_STORY_SUBMIT_ERROR', true);?>"
			},

			"moodText": "<?php echo JText::_('COM_EASYSOCIAL_MOOD_VERB_FEELING', true);?>",

			"flood": {
				"enabled": <?php echo !$this->my->isSiteAdmin() && $this->access->get('story.flood.user') ? 'true' : 'false' ; ?>,
				"interval": '<?php echo $this->access->get('story.flood.interval', '90'); ?>',
				"submit": <?php echo $this->my->canSubmitStory() ? 'true' : 'false'; ?>
			},

			<?php
			if ($story->plugins) {
				$length = count($story->plugins);
				$i = 0;
			?>
				plugin: {
					<?php foreach($story->plugins as $plugin) { ?>
					<?php echo $plugin->name; ?>: {
						id: '<?php echo $plugin->id; ?>',
						type: '<?php echo $plugin->type; ?>',
						name: '<?php echo $plugin->name; ?>'
					}<?php if (++$i < $length) { echo ','; }; ?>
					<?php } ?>
				},
			<?php } ?>
				enterToSubmit: false,
				sourceView: "<?php echo JRequest::getCmd('view',''); ?>",
				hashtagEditable: "<?php echo $story->hashtagEditable; ?>",
				singlePanel: "<?php echo $singlePanel; ?>",
				emoticons: '<?php echo $emoticons; ?>',
				mapIntegration: "<?php echo $this->config->get('location.provider'); ?>",
				mapElementId: "map-<?php echo $story->id; ?>"
			}
	);

	$(document)
		.off('click', '[data-story-panel-button-more] [data-favourite]')
		.on('click', '[data-story-panel-button-more] [data-favourite]', function(event) {

		event.stopPropagation();
		event.preventDefault();

		var panelButtons = $('[data-story-panel-buttons]');
		var element = $(this).parent('[data-story-panel-button-more]');
		var id = element.data('id');
		var selected = element.hasClass('is-selected');

		// If it was already selected, we need to remove the button now
		if (selected) {
			element.removeClass('is-selected');

			var button = panelButtons.find('[data-story-plugin-name=' + id + ']');
			button.remove();

			EasySocial.ajax('site/controllers/story/removeFavourite', {
				"element": id
			});

			// Reload slider in mobile
			if (isMobile) {
				navSlyReload();
			}

			return;
		}

		element.addClass('is-selected');

		// Duplicate the DOM element
		var duplicate = element.clone();
		duplicate.find('[data-favourite]').remove();

		var newButton = $(duplicate.html());
		newButton.attr('data-story-panel-button', '')
			.attr('data-story-plugin-name', id);

		// Append the new button
		if (isMobile) {
			var mobilePanel = $('[data-story-panel-buttons-mobile]');
			mobilePanel.append(newButton);

			// Reload the slider
			navSlyReload();
		} else {
			panelButtons.append(newButton);
		}

		EasySocial.ajax('site/controllers/story/addFavourite', {
			"element": id
		});
	});

	// Initialize the buttons in popbox
	$(document)
		.off('click', '[data-story-panel-button-more]')
		.on('click', '[data-story-panel-button-more]', function(event) {

		event.preventDefault();
		event.stopPropagation();

		var element = $(this);
		var id = element.data('id');
		var button = element.children('.es-story-panel-button');
		var buttons = $('[data-story-panel-button-more] .es-story-panel-button');

		buttons.removeClass('active');
		button.addClass('active');

		// current active story form controller.
		buttonController = window.currentStoryController;

		// active the correct panel in correct story form
		buttonController.activatePanel(id);

		// close the popup.
		buttonController.plusButton().click();
	});

	// Story plugins
	$.module("<?php echo $story->moduleId; ?>")
		.done(function(story) {
			<?php foreach($story->plugins as $plugin) { ?>
				<?php echo $plugin->script; ?>
			<?php } ?>
		});

	if (isMobile) {
		var navigationBar = $('[data-story-sly-nav]');

		// Destroy any existing slyder
		navigationBar.sly('destroy');

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
			startAt: 0,
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

		function navSlyReload() {
			// Add some delay
			setTimeout(function() {
				navigationBar.sly('reload');

				// Do double reload to ensure the sly is loaded correctly with the correct DOM. #3045
				setTimeout(function() {
					navigationBar.sly('reload');
				}, 4);
			}, 4);
		}

		// Reload once to re-calculate the width
		navSlyReload();
	}
});
