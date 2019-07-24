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

require_once(dirname(__FILE__) . '/model.php');

class EasyBlogModelAcl extends EasyBlogAdminModel
{
	/**
	 * Category total
	 *
	 * @var integer
	 */
<<<<<<< HEAD
	public $_total = null;
=======
	var $_total = null;
>>>>>>> master

	/**
	 * Pagination object
	 *
	 * @var object
	 */
<<<<<<< HEAD
	public $_pagination = null;
=======
	var $_pagination = null;
>>>>>>> master

	/**
	 * Category data array
	 *
	 * @var array
	 */
<<<<<<< HEAD
	public $_data = null;

	public function __construct()
	{
		parent::__construct();

		$mainframe = JFactory::getApplication();

		$limit = $mainframe->getUserStateFromRequest('com_easyblog.acls.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $this->input->get('limitstart', 0, '', 'int');
=======
	var $_data = null;

	function __construct()
	{
		parent::__construct();

		$mainframe	= JFactory::getApplication();

		$limit		= $mainframe->getUserStateFromRequest( 'com_easyblog.acls.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart		= $this->input->get('limitstart', 0, '', 'int');
>>>>>>> master

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}

<<<<<<< HEAD
	/**
	 * Retrieve the title of the user group given the group id
	 *
	 * @since	5.3.0
	 * @access	public
	 */
	public function getUsergroupTitle($id)
	{
		$db = EB::db();

		$query = 'SELECT `title` FROM `#__usergroups` WHERE `id`=' . $db->Quote($id);

		$db->setQuery($query);
		$result = $db->loadResult();

		return $result;
	}

	public function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total)) {
=======
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
>>>>>>> master
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	/**
	 * Method to get a pagination object for the categories
	 *
	 * @access public
	 * @return integer
	 */
<<<<<<< HEAD
	public function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination)) {
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
=======
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
>>>>>>> master
		}

		return $this->_pagination;
	}

<<<<<<< HEAD
	public function getRules($key='')
=======
	/**
	 * Method to get categories item data
	 *
	 * @access public
	 * @return array
	 */
	function getJoomlaGroupRulesets()
	{
		$sql = 'SELECT * FROM ';

		return $this->_data;
	}

	function getRules($key='')
>>>>>>> master
	{
		$db = EB::db();
		$sql = 'SELECT * FROM '.$db->nameQuote('#__easyblog_acl').' WHERE `published`=1 ORDER BY `id` ASC';
		$db->setQuery($sql);

		return $db->loadObjectList($key);
	}

	public function deleteRuleset($cid)
	{
		if (empty($cid)) {
			return false;
		}

		$db = EB::db();

		$sql = 'DELETE FROM ' . $db->nameQuote('#__easyblog_acl_group') . ' WHERE '. $db->nameQuote('content_id') . ' = ' . $db->quote($cid) . ' AND `type` = ' . $db->quote('group');
		$db->setQuery($sql);
		$result = $db->query();

		return $result;
	}

<<<<<<< HEAD
	public function insertRuleset($cid, $saveData)
=======
	function insertRuleset($cid, $saveData)
>>>>>>> master
	{
		$db = EB::db();

		$rules = $this->getRules('action');

		$type = 'group';

		$newruleset = array();

<<<<<<< HEAD
		foreach ($rules as $rule) {
=======
		foreach($rules as $rule)
		{
>>>>>>> master
			$action = $rule->action;
			$str = "(".$db->quote($cid).", ".$db->quote($rule->id).", ".$db->quote($saveData[$action]).", ".$db->quote($type).")";
			array_push($newruleset, $str);
		}

<<<<<<< HEAD
		if (!empty($newruleset)) {
=======
		if(!empty($newruleset))
		{
>>>>>>> master
			$sql = 'INSERT INTO ' . $db->nameQuote('#__easyblog_acl_group') . ' (`content_id`, `acl_id`, `status`, `type`) VALUES ';
			$sql .= implode(',', $newruleset);
			$db->setQuery($sql);

			return $result = $db->query();
		}

		return true;
	}

	/**
	 * Retrieve a list of acl groups
	 *
	 * @since	1.2
	 * @access	public
<<<<<<< HEAD
	 */
	public function getGroups()
	{
		$db = EB::db();

		$query = 'SELECT DISTINCT(' . $db->nameQuote('group') . ') FROM ' . $db->nameQuote('#__easyblog_acl');
=======
	 * @param	string
	 * @return
	 */
	public function getGroups()
	{
		$db 	= EB::db();

		$query 	= 'SELECT DISTINCT(' . $db->nameQuote('group') . ') FROM ' . $db->nameQuote('#__easyblog_acl');
>>>>>>> master
		$db->setQuery($query);

		$groups	= $db->loadColumn();

		return $groups;
	}

	/**
	 * Retrieve a list of rules on the site
	 *
	 * @since	4.0
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function getInstalledRules($cid, $add = false)
	{
<<<<<<< HEAD
		$db = EB::db();
		$ruleset = new stdClass();
		$ruleset->rules = array();

		$query = 'SELECT * FROM ' . $db->nameQuote('#__easyblog_acl');
		$db->setQuery($query);
		$rules = $db->loadObjectList();

		// Need to group up the rules accordingly.
		foreach ($rules as &$rule) {
			$ruleset->rules[$rule->group][$rule->action] = (int) $rule->default;
=======
		$db					= EB::db();
		$ruleset			= new stdClass();
		$ruleset->rules		= array();

		$query	= 'SELECT * FROM ' . $db->nameQuote('#__easyblog_acl');
		$db->setQuery($query);
		$rules	= $db->loadObjectList();

		// Need to group up the rules accordingly.
		foreach ($rules as &$rule) {
			$ruleset->rules[$rule->group][$rule->action]	= (int) $rule->default;
>>>>>>> master
		}

		if (!$add) {

<<<<<<< HEAD
			$query = $this->buildQuery($cid);

			$db->setQuery($query);

			$row = $db->loadObject();

			// Add identifier for this rule set
			$ruleset->id = $row->id;
			$ruleset->name = $row->name;
			$ruleset->level = 0;
=======
			$query 	= $this->buildQuery($cid);

			$db->setQuery($query);

			$row	= $db->loadObject();

			// Add identifier for this rule set
			$ruleset->id 	= $row->id;
			$ruleset->name	= $row->name;
			$ruleset->level	= 0;
>>>>>>> master

			// Get the stored acl group ruleset
			$query 	= 'SELECT a.*, b.' . $db->nameQuote('group') . ', b.' . $db->nameQuote('action') . ' FROM ' . $db->nameQuote('#__easyblog_acl_group') . ' AS a '
					. 'INNER JOIN ' . $db->nameQuote('#__easyblog_acl') . ' AS b '
					. 'ON a.' . $db->nameQuote('acl_id') . ' = b.' . $db->nameQuote('id') . ' '
					. 'WHERE ' . $db->nameQuote('content_id') . '=' . $db->Quote($cid) . ' '
					. 'AND ' . $db->nameQuote('type') . '=' . $db->Quote('group');
			$db->setQuery($query);

			$row = $db->loadObjectList();

<<<<<<< HEAD
			if (!$row && !JAccess::checkGroup($cid, 'core.admin')) {
				// if empty and the group not a super admin group, 
				// this mean either the joomla group is a brand new one, or the joomla group id is invalid.
				// lets fall back to 'public' group. #1920
				$query 	= 'SELECT a.*, b.' . $db->nameQuote('group') . ', b.' . $db->nameQuote('action') . ' FROM ' . $db->nameQuote('#__easyblog_acl_group') . ' AS a '
						. 'INNER JOIN ' . $db->nameQuote('#__easyblog_acl') . ' AS b '
						. 'ON a.' . $db->nameQuote('acl_id') . ' = b.' . $db->nameQuote('id') . ' '
						. 'WHERE ' . $db->nameQuote('content_id') . '=' . $db->Quote('1') . ' '
						. 'AND ' . $db->nameQuote('type') . '=' . $db->Quote('group');
				$db->setQuery($query);

				$row = $db->loadObjectList();
			}

			if ($row) {
				foreach ($row as $data) {
					if (isset($ruleset->rules[$data->group][$data->action])) {
						$ruleset->rules[$data->group][$data->action] = $data->status;
=======
			if(count($row) > 0) {

				foreach ($row as $data) {

					if (isset($ruleset->rules[$data->group][$data->action])) {

						$ruleset->rules[$data->group][$data->action]	= $data->status;
>>>>>>> master
					}
				}
			}
		}

		return $ruleset;
	}

<<<<<<< HEAD
	public function getRuleSet($cid, $add=false)
	{
		$db = EB::db();

		return $rulesets;
	}

	public function getRuleSets($cid='')
	{
		$db = EB::db();

		$rulesets = new stdClass();
		$ids = array();
=======
	function getRuleSet($cid, $add=false)
	{
		$db = EB::db();



		return $rulesets;
	}

	function getRuleSets($cid='')
	{
		$db 		= EB::db();

		$rulesets	= new stdClass();
		$ids		= array();
>>>>>>> master

		$rules = $this->getRules('id');

		$type = 'group';

		//get user
		$query = $this->_buildQuery($cid);

		$pagination = $this->getPagination();
<<<<<<< HEAD
		$rows = $this->_getList($query, $pagination->limitstart, $pagination->limit);

		if (!empty($rows)) {
			foreach ($rows as $row) {
				$rulesets->{$row->id} = new stdClass();
				$rulesets->{$row->id}->id = $row->id;
				$rulesets->{$row->id}->name = $row->name;
				$rulesets->{$row->id}->level = $row->level;

				foreach ($rules as $rule) {
=======
		$rows = $this->_getList($query, $pagination->limitstart, $pagination->limit );

		if(!empty($rows))
		{
			foreach($rows as $row)
			{
				$rulesets->{$row->id} 			= new stdClass();
				$rulesets->{$row->id}->id		= $row->id;
				$rulesets->{$row->id}->name		= $row->name;
				$rulesets->{$row->id}->level	= $row->level;

				foreach($rules as $rule)
				{
>>>>>>> master
					$rulesets->{$row->id}->{$rule->action} = (INT)$rule->default;
				}

				array_push($ids, $row->id);
			}

			//get acl group ruleset
<<<<<<< HEAD
			$sql = 'SELECT * FROM ' . $db->nameQuote('#__easyblog_acl_group') . ' WHERE '. $db->nameQuote('type') . ' = ' . $db->Quote('group') . ' AND `content_id` IN (' . implode(' , ', $ids) . ')';
			$db->setQuery($sql);
			$acl = $db->loadAssocList();

			foreach ($acl as $data) {
				if (isset($rules[$data['acl_id']])) {
=======
			$sql = 'SELECT * FROM ' . $db->nameQuote('#__easyblog_acl_group') . ' WHERE '. $db->nameQuote('type') . ' = ' . $db->Quote('group') . ' AND `content_id` IN (' . implode( ' , ', $ids ) . ')';
			$db->setQuery($sql);
			$acl = $db->loadAssocList();

			foreach($acl as $data)
			{
				if(isset($rules[$data['acl_id']]))
				{
>>>>>>> master
					$action = $rules[$data['acl_id']]->action;
					$rulesets->{$data['content_id']}->{$action} = $data['status'];
				}
			}
		}

		return $rulesets;
	}

	public function buildQuery($cid = '')
	{
<<<<<<< HEAD
		$db = EB::db();
=======
		$db 	= EB::db();
>>>>>>> master

		$query = 'SELECT a.id, a.title AS `name`, COUNT(DISTINCT b.id) AS level';
		$query .= ' , GROUP_CONCAT(b.id SEPARATOR \',\') AS parents';
		$query .= ' FROM #__usergroups AS a';
		$query .= ' LEFT JOIN `#__usergroups` AS b ON a.lft > b.lft AND a.rgt < b.rgt';

<<<<<<< HEAD
		$where = $this->_buildQueryWhere($cid);
		$orderby = $this->_buildQueryOrderBy();
=======
		$where		= $this->_buildQueryWhere($cid);
		$orderby	= $this->_buildQueryOrderBy();
>>>>>>> master

		$query .= $where . ' ' . $orderby;

		return $query;
	}

<<<<<<< HEAD
	public function _buildQueryWhere($cid='')
	{
		$mainframe = JFactory::getApplication();
		$db = EB::db();

		$search = $mainframe->getUserStateFromRequest('com_easyblog.acls.search', 'search', '', 'string');
		$search = $db->getEscaped(trim(EBString::strtolower($search)));

		$where = array();

		if (empty($cid) && $search) {
			$where[] = ' LOWER(name) LIKE \'%' . $search . '%\' ';
		} else {
			$where[] = 'a.`id` = ' . $db->quote($cid);
		}

		$where = (count($where) ? ' WHERE ' .implode(' AND ', $where) : '');
=======
	function _buildQueryWhere($cid='')
	{
		$mainframe			= JFactory::getApplication();
		$db					= EB::db();

		$search 			= $mainframe->getUserStateFromRequest( 'com_easyblog.acls.search', 'search', '', 'string' );
		$search 			= $db->getEscaped( trim(EBString::strtolower( $search ) ) );

		$where = array();

		if(empty($cid) && $search)
		{
			$where[] = ' LOWER( name ) LIKE \'%' . $search . '%\' ';
		}
		else
		{
			$where[] = 'a.`id` = ' . $db->quote($cid);
		}

		$where = ( count( $where ) ? ' WHERE ' .implode( ' AND ', $where ) : '' );
>>>>>>> master

		return $where;
	}

<<<<<<< HEAD
	public function _buildQueryOrderBy()
	{
		$mainframe = JFactory::getApplication();

		$filter_order = $mainframe->getUserStateFromRequest('com_easyblog.acls.filter_order', 'filter_order', 'a.`id`', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest('com_easyblog.acls.filter_order_Dir', 'filter_order_Dir', '', 'word');

		$orderby = ' GROUP BY a.id, a.title';
		$orderby .= ' ORDER BY a.lft ASC';
=======
	function _buildQueryOrderBy()
	{
		$mainframe			= JFactory::getApplication();

		$filter_order 		= $mainframe->getUserStateFromRequest( 'com_easyblog.acls.filter_order', 'filter_order', 'a.`id`', 'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( 'com_easyblog.acls.filter_order_Dir', 'filter_order_Dir', '', 'word' );

		$orderby	 = ' GROUP BY a.id, a.title';
		$orderby	.= ' ORDER BY a.lft ASC';
>>>>>>> master

		return $orderby;
	}
}
