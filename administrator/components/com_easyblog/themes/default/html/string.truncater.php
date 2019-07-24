<?php
/**
* @package      EasyBlog
<<<<<<< HEAD
* @copyright    Copyright (C) 2010 - 2019 Stack Ideas Sdn Bhd. All rights reserved.
=======
* @copyright    Copyright (C) 2010 - 2017 Stack Ideas Sdn Bhd. All rights reserved.
>>>>>>> master
* @license      GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<<<<<<< HEAD
<div class="eb-data-truncater" data-eb-truncater>
	<div data-text class="fd-cf"><?php echo $truncated; ?></div>
	<div class="t-hidden" data-original><?php echo $original;?></div>

	<?php if ($showMore) { ?>
	<a href="javascript:void(0);" <?php echo $overrideReadmore ? 'data-filter-item="info"' : 'data-readmore'; ?>><?php echo JText::_('COM_EASYBLOG_STRING_TRUNCATER_MORE'); ?></a>
	<?php } ?>
</div>
=======
<?php if ($length > $max) { ?>
	<span data-truncater-<?php echo $uid;?>>
		<?php echo EBString::substr($text, 0, $max); ?><span data-truncater-ellipses><?php echo JText::_('COM_EASYBLOG_ELLIPSES' ); ?></span><span data-truncater-balance style="display: none;"><?php echo EBString::substr( $text , $max , $length ); ?></span>
		<a href="javascript:void(0);" data-truncater-more><?php echo JText::_('COM_EASYBLOG_STRING_TRUNCATER_MORE'); ?></a>
	</span>

<?php } else { ?>
	<?php echo $text; ?>
<?php } ?>
>>>>>>> master
