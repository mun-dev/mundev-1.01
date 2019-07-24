<?php
/**
* @package		EasyBlog
* @copyright	Copyright (C) 2010 - 2018 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<div class="es-mobile-filter" data-es-mobile-filters>
	<div class="es-mobile-filter__hd">
		<?php if ($user->isViewer() && $userAcl->get('add_entry')) { ?>
			<?php echo $this->html('mobile.filterActions',
					array($this->html('mobile.filterAction', 'APP_USER_BLOG_NEW_POST_BUTTON', $composeLink))
			); ?>
		<?php } ?>
	</div>
</div>