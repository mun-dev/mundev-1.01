<?php
/**
* @package      EasyDiscuss
* @copyright    Copyright (C) 2010 - 2019 Stack Ideas Sdn Bhd. All rights reserved.
* @license      GNU/GPL, see LICENSE.php
* EasyDiscuss is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Restricted access');
?>
<?php echo JText::_('COM_EASYDISCUSS_EMAILTEMPLATE_HELLO');?>,

<?php echo JText::sprintf('COM_EASYDISCUSS_EMAIL_TEMPLATE_CONVERSATION', $authorName);?>

<?php echo JText::_('COM_EASYDISCUSS_EMAILTEMPLATE_MESSAGE'); ?> : <?php echo nl2br($content); ?>

<?php echo JText::_('COM_ED_EMAILTEMPLATE_VISIT_CONVERSATION_LINK_HERE');?> <?php echo $conversationLink; ?>