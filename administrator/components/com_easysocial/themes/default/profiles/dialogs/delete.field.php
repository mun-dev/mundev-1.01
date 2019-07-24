<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2014 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );
?>
<dialog>
	<width>450</width>
	<height>200</height>
	<selectors type="json">
	{
		"{deleteButton}"  : "[data-delete-button]",
		"{cancelButton}"  : "[data-cancel-button]"
	}
	</selectors>
	<bindings type="javascript">
	{
	}
	</bindings>
	<title><?php echo JText::_( 'COM_EASYSOCIAL_PROFILES_FORM_FIELDS_DELETE_ITEM_DIALOG_TITLE' ); ?></title>
	<content>
		<p><?php echo JText::_( 'COM_EASYSOCIAL_PROFILES_FORM_FIELDS_DELETE_ITEM_DIALOG_CONFIRMATION' ); ?></p>
		<div class="small mt-20">
			<span class="label label-danger"><?php echo JText::_( 'COM_EASYSOCIAL_NOTE' );?>:</span>
			<?php echo JText::_( 'COM_EASYSOCIAL_PROFILES_FORM_FIELDS_CONFIRM_DELETE_NOTE' );?>
		</div>
	</content>
	<buttons>
		<button data-cancel-button type="button" class="btn btn-es-default btn-sm"><?php echo JText::_( 'COM_EASYSOCIAL_PROFILES_FORM_FIELDS_DELETE_ITEM_DIALOG_CANCEL' ); ?></button>
		<button data-delete-button type="button" class="btn btn-es-danger btn-sm"><?php echo JText::_( 'COM_EASYSOCIAL_PROFILES_FORM_FIELDS_DELETE_ITEM_DIALOG_CONFIRM' ); ?></button>
	</buttons>
</dialog>
