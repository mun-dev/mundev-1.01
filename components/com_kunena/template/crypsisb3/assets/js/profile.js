/**
 * Kunena Component
 * @package Kunena.Template.Crypsis
 *
 * @copyright     Copyright (C) 2008 - 2019 Kunena Team. All rights reserved.
 * @license https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link https://www.kunena.org
 **/

jQuery(document).ready(function () {
	if (jQuery.fn.datepicker !== undefined) {
		jQuery('#birthdate .input-group.date').datepicker({
			orientation: "top auto"
		});
	}

	var avatartab = jQuery.parseJSON(Joomla.getOptions('com_kunena.avatartab'));

	if (avatartab) {
		jQuery('.nav-tabs a[href=#editavatar]').tab('show');
	}
});
