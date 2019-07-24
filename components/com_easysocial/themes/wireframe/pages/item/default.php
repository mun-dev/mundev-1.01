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
<div class="es-profile" data-es-page data-id="<?php echo $page->id;?>">

	<?php echo $this->html('cover.page', $page, $layout); ?>

	<div class="es-container" data-es-container>

		<?php echo $this->html('html.sidebar'); ?>

		<?php if ($this->isMobile()) { ?>
			<?php echo $this->output('site/pages/item/mobile'); ?>
		<?php } ?>

		<div class="es-content">
			<?php echo $this->render('module', 'es-pages-before-contents'); ?>

			<div class="es-stream-filters">
				<?php echo $streamFilter->html();?>
			</div>

			<div class="es-content-wrap" data-wrapper>
				<?php echo $this->html('listing.loader', 'stream', 8); ?>

				<div data-contents>
					<?php echo $this->includeTemplate('site/pages/item/content'); ?>
				</div>
			</div>

			<?php echo $this->render('module', 'es-pages-after-contents'); ?>
		</div>
	</div>
</div>
