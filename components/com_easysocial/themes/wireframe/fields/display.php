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
?>
<td class="profile-data-label">
<?php if ($params->get('display_title')) { ?>
	<?php echo JText::_($params->get('title')) . ':'; ?>
<?php } ?>
</td>
<td class="profile-data-info">

	<div class="profile-data-info__data">
		<?php if($params->get('privacy') && $user->id === $this->my->id) { ?>
			<?php echo $this->includeTemplate('site/fields/privacy'); ?>
		<?php } ?>
		<div class="profile-data-info__content">
			<?php echo $this->includeTemplate($subNamespace); ?>
		</div>
	</div>
</td>
