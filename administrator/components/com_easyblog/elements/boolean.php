<?php
/**
* @package		EasyBlog
<<<<<<< HEAD
* @copyright	Copyright (C) 2010 - 2019 Stack Ideas Sdn Bhd. All rights reserved.
=======
* @copyright	Copyright (C) 2010 - 2017 Stack Ideas Sdn Bhd. All rights reserved.
>>>>>>> master
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

require_once(__DIR__ . '/abstract.php');

class JFormFieldBoolean extends EasyBlogFormField
{
	protected $type = 'Boolean';

	/**
	 * Renders a form toggler at the back end
	 *
	 * @since	5.1
	 * @access	public
	 */	
	protected function getInput()
	{
		$this->set('id', $this->id);
		$this->set('name', $this->name);
		$this->set('value', $this->value);

		return $this->output('admin/elements/boolean');
	}
}
