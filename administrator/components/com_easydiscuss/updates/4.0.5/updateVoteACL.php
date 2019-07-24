<?php
/**
* @package      EasyDiscuss
* @copyright    Copyright (C) 2010 - 2015 Stack Ideas Sdn Bhd. All rights reserved.
* @license      GNU/GPL, see LICENSE.php
* EasyDiscuss is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

require_once(DISCUSS_ADMIN_ROOT . '/includes/maintenance/dependencies.php');

class EasyDiscussMaintenanceScriptUpdateVoteACL extends EasyDiscussMaintenanceScript
{
    public static $title = "Update voting acl";
    public static $description = "Ensure that voting acl is visible in the acl area for public group.";

    public function main()
    {
        $db = ED::db();

        $query = "UPDATE " . $db->nameQuote('#__discuss_acl');
        $query .= " SET " . $db->nameQuote('public') . '=' . $db->Quote('1');
        $query .= " WHERE " . $db->nameQuote('action') . '=' . $db->Quote('vote_discussion');

        // echo $query;exit;

        $db->setQuery($query);
        $state = $db->query();

        return $state;

    }
}
