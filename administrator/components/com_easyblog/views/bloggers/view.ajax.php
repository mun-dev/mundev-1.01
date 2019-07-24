<?php
/**
* @package		EasyBlog
* @copyright	Copyright (C) 2010 - 2017 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

require_once(JPATH_ADMINISTRATOR . '/components/com_easyblog/views.php');

class EasyBlogViewBloggers extends EasyBlogAdminView
{
	/**
	 * Displays a list of users on the site in a dialog
	 *
	 * @since	5.1
	 * @access	public
	 */
	public function browse()
	{
		$theme = EB::themes();

		$output	= $theme->output('admin/bloggers/dialogs/browse');
		
		return $this->ajax->resolve($output);
	}

	/**
	 * Display confirmation dialog whether you would like to reset the blogger ordering
	 *
	 * @since	5.2
	 * @access	public
	 */
	public function confirmResetOrdering()
	{
		$theme = EB::themes();

		$output	= $theme->output('admin/bloggers/dialogs/reset.ordering');
		
		return $this->ajax->resolve($output);
	}	
}
