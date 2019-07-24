
EasyBlog.ready(function($){

<<<<<<< HEAD
	var updateLocationPanels = function () {
		var service = $('[data-location-integration]').val();
=======
	$('[data-location-integration]').on('change', function(){
		var value = $(this).val();
>>>>>>> master

		// Hide everything
		$('[data-panel-integration]').addClass('hide');

		// Show only what we want the user to see
<<<<<<< HEAD
		$('[data-panel-' + service + ']').removeClass('hide');

		$('[data-google-settings]').toggleClass('hide', service == 'osm');
	}

	updateLocationPanels();

	$(document)
		.on('change.location.integration', '[data-location-integration]', function() {
			updateLocationPanels();
		});
=======
		$('[data-panel-' + value + ']').removeClass('hide');
	});
>>>>>>> master
});