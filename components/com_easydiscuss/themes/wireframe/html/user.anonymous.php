<?php
/**
* @package      EasyDiscuss
<<<<<<< HEAD
* @copyright    Copyright (C) 2010 - 2019 Stack Ideas Sdn Bhd. All rights reserved.
=======
* @copyright    Copyright (C) 2010 - 2015 Stack Ideas Sdn Bhd. All rights reserved.
>>>>>>> master
* @license      GNU/GPL, see LICENSE.php
* EasyDiscuss is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<div class="o-avatar-status is-offline">
	<a href="javascript:void(0);"
<<<<<<< HEAD
		class="o-avatar o-avatar--<?php echo $size; ?> <?php echo ED::themes()->renderAvatarClass($user); ?>"
=======
		class="o-avatar o-avatar--<?php echo isset($size) ? $size : 'sm'; ?> o-avatar--bg-<?php echo $user->getNameInitial()->code;?> <?php echo ($this->config->get('layout_avatar')) ? 'o-avatar--text' : '' ?>"
>>>>>>> master
		data-ed-provide="tooltip"
		data-placement="top"
		title="<?php echo JText::_('COM_EASYDISCUSS_ANONYMOUS_USER');?>"
	>
<<<<<<< HEAD
		<?php if ($showProfileImage) { ?>
			<img src="<?php echo ED::getDefaultAvatar();?>" alt="<?php echo JText::_('COM_EASYDISCUSS_ANONYMOUS_USER');?>"/>
		<?php } else { ?>
			<?php echo $textAvatarName; ?>
		<?php } ?>
	</a>
</div>

=======
		<?php if ($this->config->get('layout_avatar')) { ?>
			<img src="<?php echo ED::getDefaultAvatar();?>" alt="<?php echo JText::_('COM_EASYDISCUSS_ANONYMOUS_USER');?>"/>
		<?php } else { ?>
			<?php echo JText::_('COM_EASYDISCUSS_ANONYMOUS_USER');?>
		<?php } ?>
	</a>
</div>
>>>>>>> master
