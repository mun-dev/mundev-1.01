<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2019 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

class EasySocialViewUsersListHelper extends EasySocial
{
	/**
	 * Cache users
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function cache($result)
	{
		static $cache = null;

		if (is_null($cache)) {
			$userIds = array();
			$users = array();

			foreach ($result as $obj) {
				$userIds[] = $obj->id;
				$users[] = ES::user($obj->id);
			}

			// bind / set the fields_data into cache for later reference.
			// the requirement is to ES::user() first before you can call this setUserFieldsData();
			$model = ES::model('Users');
			$model->setUserFieldsData($userIds);

			$cache = $users;
		}

		return $cache;

	}

	/**
	 * Determines the current filter on the page
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getActiveFilter()
	{
		static $filter = null;

		if (is_null($filter)) {
			$filter = $this->input->get('filter', 'all', 'word');
		}

		return $filter;
	}

	/**
	 * Determines the current filter on the page
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getActiveId()
	{
		static $id = null;

		if (is_null($id)) {
			$id = $this->input->get('id', 0, 'int');
		}

		return $id;
	}

	/**
	 * Determines if the user is currently trying to filter users by profile type
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getActiveProfile()
	{
		static $profile = null;

		if (is_null($profile)) {
			$profile = false;
			$filter = $this->getActiveFilter();
			$id = $this->getActiveId();

			if ($filter != 'profiletype') {
				return $profile;
			}

			$profile = ES::table('Profile');
			$profile->load($id);
		}

		return $profile;
	}

	/**
	 * Determines if the user is currently trying to filter users by search filter
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getActiveSearchFilter()
	{
		static $searchFilter = null;

		if (is_null($searchFilter)) {
			$searchFilter = false;
			$filter = $this->getActiveFilter();
			$id = $this->getActiveId();

			if ($filter != 'search') {
				return $searchFilter;
			}

			$searchFilter = ES::table('SearchFilter');
			$searchFilter->load($id);
		}

		return $searchFilter;
	}

	/**
	 * Determines the current sorting type on the page
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getActiveSort()
	{
		static $sort = null;

		if (is_null($sort)) {
			$sort = $this->input->get('sort', $this->config->get('users.listings.sorting'), 'word');
		}

		return $sort;
	}

	/**
	 * Determines the page title to be used
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getPageTitle()
	{
		static $title = null;

		if (is_null($title)) {
			$title = 'COM_EASYSOCIAL_PAGE_TITLE_USERS';

			$filter = $this->getActiveFilter();

			if ($filter == 'online') {
				$title = JText::_('COM_EASYSOCIAL_PAGE_TITLE_USERS_ONLINE_USERS');
			}

			if ($filter == 'photos') {
				$title = JText::_('COM_EASYSOCIAL_PAGE_TITLE_USERS_WITH_PHOTOS');
			}

			if ($filter == 'blocked') {
				$title = JText::_('COM_EASYSOCIAL_PAGE_TITLE_USERS_BLOCKED');
			}

			if ($filter == 'verified') {
				$title = JText::_('COM_ES_PAGE_TITLE_USERS_VERIFIED_USERS');
			}

			// Use search filter title as the title of the page
			$searchFilter = $this->getActiveSearchFilter();

			if ($searchFilter) {
				$title = $searchFilter->get('title');
			}

			// Use profile title as the title of the page
			$profile = $this->getActiveProfile();

			if ($profile) {
				$title = $profile->get('title');
			}
		}

		return $title;
	}

	/**
	 * Retrieve profile types
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getProfileTypes()
	{
		static $profiles = null;

		if (is_null($profiles)) {
			$model = ES::model('Profiles');

			$showCount = $this->config->get('users.listings.profilescount');
			$profiles = $model->getProfiles(array('state' => SOCIAL_STATE_PUBLISHED, 'includeAdmin' => $this->shouldIncludeAdmins(), 'excludeESAD' => true, 'validUser' => true, 'showCount' => $showCount, 'excludeUserListing' => true));
		}

		return $profiles;
	}

	/**
	 * Retrieve search filters for users listing
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getSearchFilters()
	{
		static $filters = null;

		if (is_null($filters)) {
			$model = ES::model('Search');
			$filters = $model->getSiteWideFilters();
		}

		return $filters;
	}

	/**
	 * Generates the sortable options
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function getSortables()
	{
		static $items = null;

		if (is_null($items)) {
			$items = new stdClass();
			$types = array('latest', 'lastlogin', 'alphabetical');

			$filter = $this->getActiveFilter();
			$activeId = $this->getActiveId();

			foreach ($types as $type) {

				$items->{$type} = new stdClass();

				// some of the filter type is referring the id instead of the sort name
				// data-filterId attribute use to determine 'search' and 'profiles' filter type data id
				$attributes = array('data-sort', 'data-filter="' . $filter . '"', 'data-type="' . $type . '"', 'data-filterid="' . $activeId . '"');

				$urlOptions = array();
				$urlOptions['filter'] = $filter;
				$urlOptions['sort'] = $type;

				if ($activeId) {
					$urlOptions['id'] = $activeId;
				}

				$items->{$type}->attributes = $attributes;
				$items->{$type}->url = ESR::users($urlOptions);
			}
		}

		return $items;
	}

	/**
	 * Determines if the listings should include admins
	 *
	 * @since	3.0.0
	 * @access	public
	 */
	public function shouldIncludeAdmins()
	{
		static $include = null;

		if (is_null($include)) {
			$include = $this->config->get('users.listings.admin') ? true : false;
		}

		return $include;
	}
}
