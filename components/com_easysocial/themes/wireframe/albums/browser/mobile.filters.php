<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2018 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<div class="es-mobile-filter" data-es-mobile-filters>
	<div class="es-mobile-filter__hd">
		<div class="es-mobile-filter__hd-cell is-slider">
			<div class="es-mobile-filter-slider is-end-left" data-es-sly-slider-group>
				<div class="es-mobile-filter-slider__content">
					<?php if ($coreAlbums) { ?>
						<?php echo $this->html('mobile.filterGroup', $lib->getCoreAlbumsTitle(), 'core', ($mobileFilter == 'core')); ?>
					<?php } ?>

					<?php if ($lib->showMyAlbums() && ($myAlbums || ($layout == 'form' && empty($id)))) { ?>
						<?php echo $this->html('mobile.filterGroup', $lib->getMyAlbumsTitle(), 'mine', ($mobileFilter == 'mine')); ?>
					<?php } ?>

					<?php if ($albums || ($layout == "form" && empty($id) && !$lib->showMyAlbums())) { ?>
						<?php echo $this->html('mobile.filterGroup', 'COM_EASYSOCIAL_OTHER_ALBUMS', 'regular', ($mobileFilter == 'regular')); ?>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php if ($lib->canCreateAlbums() && !$lib->exceededLimits()) { ?>
			<?php echo $this->html('mobile.filterActions', array($this->html('mobile.filterAction', 'COM_EASYSOCIAL_ALBUMS_CREATE_ALBUM', $lib->getCreateLink()))); ?>
		<?php } ?>
	</div>

	<div class="es-mobile-filter__bd" data-es-group-filters>
		<?php if ($coreAlbums) { ?>
		<div class="es-mobile-filter__group<?php echo $mobileFilter != 'core' ? ' t-hidden' : ' is-active'; ?>" data-es-sly-group data-type="core">
			<div class="es-mobile-filter-slider is-end-left" data-es-sly-slider>
				<div class="es-mobile-filter-slider__content">
					<?php foreach ($coreAlbums as $album) { ?>
						<?php echo $this->html('mobile.filterTab', $album->get('title'), $album->getPermalink(), ($album->id == $id), array('data-album-list-item', 'data-album-id="' . $album->id . '"')); ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if ($lib->showMyAlbums() && ($myAlbums || ($layout == 'form' && empty($id)))) { ?>
		<div class="es-mobile-filter__group<?php echo $mobileFilter != 'mine' ? ' t-hidden' : ' is-active'; ?>" data-es-sly-group data-type="mine">
			<div class="es-mobile-filter-slider is-end-left" data-es-sly-slider>
				<div class="es-mobile-filter-slider__content">
					<?php if ($layout == 'form' && empty($id)) { ?>
						<?php echo $this->html('mobile.filterTab', 'COM_EASYSOCIAL_ALBUMS_NEW_ALBUM', 'javascript:void(0);', true, array('data-album-list-item')); ?>
					<?php } ?>

					<?php if ($myAlbums) { ?>
						<?php foreach ($myAlbums as $album) { ?>
							<?php echo $this->html('mobile.filterTab', $album->get('title'), $album->getPermalink(), ($album->id == $id), array('data-album-list-item', 'data-album-id="' . $album->id . '"')); ?>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>

		<?php if ($albums || ($layout == "form" && empty($id) && !$lib->showMyAlbums())) { ?>
		<div class="es-mobile-filter__group<?php echo $mobileFilter != 'regular' ? ' t-hidden' : ' is-active'; ?>" data-es-sly-group data-type="regular">
			<div class="es-mobile-filter-slider is-end-left" data-es-sly-slider>
				<div class="es-mobile-filter-slider__content">
					<?php if ($layout == 'form' && empty($id) && !$lib->showMyAlbums()) { ?>
						<?php echo $this->html('mobile.filterTab', 'COM_EASYSOCIAL_ALBUMS_NEW_ALBUM', 'javascript:void(0);', true, array('data-album-list-item')); ?>
					<?php } ?>

					<?php if ($albums) { ?>
						<?php foreach ($albums as $album) { ?>
							<?php echo $this->html('mobile.filterTab', $album->get('title'), $album->getPermalink(), ($album->id == $id), array('data-album-list-item', 'data-album-id="' . $album->id . '"')); ?>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
