EasySocial.ready(function($) {

	$.Joomla('submitbutton', function(task) {

		if (task == 'cancel') {
<<<<<<< HEAD
			window.location = '<?php echo JURI::base();?>index.php?option=com_easysocial&<?php echo $app->type == 'fields' ? 'view=workflows&layout=fields' : 'view=apps'; ?>';
=======
			window.location = '<?php echo JURI::base();?>index.php?option=com_easysocial&view=workflows&layout=fields';
>>>>>>> master
			return;
		}

		$.Joomla('submitform', [task]);
	});
});
