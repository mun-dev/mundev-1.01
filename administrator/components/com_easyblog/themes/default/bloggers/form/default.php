<?php
/**
* @package      EasyBlog
* @copyright    Copyright (C) 2010 - 2017 Stack Ideas Sdn Bhd. All rights reserved.
* @license      GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<form name="adminForm" id="adminForm" action="index.php" method="post" enctype="multipart/form-data" data-eb-form>
	<div class="app-tabs">
		<ul class="app-tabs-list list-unstyled">
			<li class="tabItem <?php echo $activeTab == 'general' ? 'active' : '';?>">
				<a data-bp-toggle="tab" href="#general" data-form-tabs>
					<?php echo JText::_('COM_EASYBLOG_BLOGGER_DETAILS');?>
				</a>
			</li>

			<li class="tabItem <?php echo $activeTab == 'blog' ? 'active' : '';?>">
				<a data-bp-toggle="tab" href="#blog" data-form-tabs>
					<?php echo JText::_('COM_EASYBLOG_BLOGGER_BLOG_SETTINGS');?>
				</a>
			</li>

			<li class="tabItem <?php echo $activeTab == 'integrations' ? 'active' : '';?>">
				<a data-bp-toggle="tab" href="#integrations" data-form-tabs>
					<?php echo JText::_('COM_EASYBLOG_BLOGGER_FORM_INTEGRATIONS');?>
				</a>
			</li>
		</ul>
	</div>

	<div class="tab-content">
		<div id="general" class="tab-pane <?php echo $activeTab == 'general' ? 'active' : '';?>">
			<?php echo $this->output('admin/bloggers/form/general'); ?>
		</div>

		<div id="blog" class="tab-pane <?php echo $activeTab == 'blog' ? 'active' : '';?>">
			<?php echo $this->output('admin/bloggers/form/blog'); ?>
		</div>

		<div id="integrations" class="tab-pane <?php echo $activeTab == 'integrations' ? 'active' : '';?>">
			<?php echo $this->output('admin/bloggers/form/integrations'); ?>
		</div>
	</div>

	<?php echo $this->html('form.action'); ?>
	<input type="hidden" name="id" value="<?php echo $user->id;?>" />
	<input type="hidden" name="active" value="<?php echo $activeTab;?>" data-eb-form-activetab />
</form>
