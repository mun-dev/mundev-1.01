
EasyBlog.ready(function($){

	// Prevent closing
	$(document).on('click.toolbar', '[data-eb-toolbar-dropdown]', function(event) {
		event.stopPropagation();
	});

	// Logout
	$(document).on('click', '[data-blog-toolbar-logout]', function(event) {
		$('[data-blog-logout-form]').submit();
	});

	// Search
<<<<<<< HEAD
	$(document)
		.off('click.search.toggle')
		.on('click.search.toggle', '[data-eb-toolbar-search-toggle]', function() {
			var searchBar = $('[data-eb-toolbar-search]');
			var ebToolBar = $('[data-eb-toolbar]');

			ebToolBar.toggleClass('eb-toolbar--search-on');
		});

	<?php if ($this->isMobile() || $this->isTablet()) { ?>

=======
	$('[data-eb-toolbar-search]').on('click', function() {
		$('[data-eb-toolbar-search-wrapper]').toggleClass('hide');
	});

	<?php if ($this->isMobile()) { ?>

	$('[data-eb-mobile-menu]').on('click', function() {
		$('[data-eb-container]').toggleClass('eb-sidemenu-open');
	});
>>>>>>> master

	$('.btn-eb-navbar').click(function() {
		$('.eb-nav-collapse').toggleClass("nav-show");
		return false;
	});

<<<<<<< HEAD
	// Toggle main navigation
=======
>>>>>>> master
	$('[data-eb-toolbar-toggle]').on('click', function() {
		var contents = $('[data-eb-mobile-toolbar]').html();

		EasyBlog.dialog({
			"title": "<?php echo JText::_('COM_EASYBLOG_TOOLBAR_MENU_TITLE', true);?>",
			"content": contents
		});
	});

<<<<<<< HEAD
	// Toggle account and manage
	$('[data-eb-toolbar-manage-toggle]').on('click', function() {
		var contents = $('[data-eb-mobile-manage-toolbar]').html();

		EasyBlog.dialog({
			"title": "<?php echo JText::_('COM_EASYBLOG_DASHBOARD_TOOLBAR_MANAGE', true);?>",
			"content": contents
		});
	});

=======
>>>>>>> master
	$('[data-eb-toolbar-dashboard-toggle]').on('click', function() {
		var contents = $('[data-eb-mobile-dashboard-toolbar]').html();

		EasyBlog.dialog({
			"title": "<?php echo JText::_('COM_EASYBLOG_TOOLBAR_DASHBOARD_TITLE', true);?>",
			"content": contents
		});
	});
	<?php } ?>
});
