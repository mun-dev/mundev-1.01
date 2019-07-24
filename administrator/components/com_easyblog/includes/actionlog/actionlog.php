<?php
/**
* @package		EasyBlog
* @copyright	Copyright (C) 2010 - 2019 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

class EasyBlogActionLog extends EasyBlog
{
	private $defaultData = array(
		'action' => '',
		'title' => 'com_easyblog',
		'extension_name' => 'com_easyblog'
	);

	public function log($actionString, $context, $data = array())
	{
		$user = isset($data['user']) && is_object($user) ? $user : $this->my;
		
		$data = array_merge($data, $this->defaultData);
		
		$data['userid'] = $user->id;
		$data['username'] = $user->username;
		$data['accountlink'] = "index.php?option=com_users&task=user.edit&id=" . $user->id;
		
		$context = $data['extension_name'] . '.' . $context;


		$model = $this->getModel();

		// Could be disabled
		if ($model === false) {
			return false;
		}
		
		$model->addLog(array($data), JText::_($actionString), $context, $user->id);
	}

	/**
	 * Retrieve joomla's ActionLog model
	 *
	 * @since	5.3.0
	 * @access	public
	 */
	public function getModel()
	{
		$config = array('ignore_request' => true);
		
		\Joomla\CMS\MVC\Model\ItemModel::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_actionlogs/models', 'ActionlogsModelActionlog');
		$model = \Joomla\CMS\MVC\Model\ItemModel::getInstance('Actionlog', 'ActionLogsModel', $config);

		return $model;
	}
}
