<?php
/**
 * Kunena Component
 * @package         Kunena.Template.Crypsis
 * @subpackage      Layout.User
 *
 * @copyright       Copyright (C) 2008 - 2019 Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$this->addStyleSheet('assets/css/bootstrap.datepicker.css');
$this->addScript('assets/js/bootstrap.datepicker.js');
$this->addScript('assets/js/locales/bootstrap-datepicker.kunena.js');
$this->addScript('assets/js/profile.js');

// Load language strings for bootstrap datepicker
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYS_SUNDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYS_MONDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYS_TUESDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYS_WEDNESDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYS_THURSDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYS_FRIDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYS_SATURDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSSHORT_SUNDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSSHORT_MONDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSSHORT_TUESDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSSHORT_WEDNESDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSSHORT_THURSDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSSHORT_FRIDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSSHORT_SATURDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSMIN_SUNDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSMIN_MONDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSMIN_TUESDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSMIN_WEDNESDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSMIN_THURSDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSMIN_FRIDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_DAYSMIN_SATURDAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_JANUARY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_FEBRUARY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_MARCH');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_APRIL');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_MAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_JUNE');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_JULY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_AUGUST');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_SEPTEMBER');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_OCTOBER');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_NOVEMBER');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_DECEMBER');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_JANUARY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_FEBRUARY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_MARCH');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_APRIL');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_MAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_JUNE');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_JULY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_AUGUST');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_SEPTEMBER');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_OCTOBER');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_NOVEMBER');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHSSHORT_DECEMBER');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_TODAY');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_MONTHS_TITLE');
Text::script('COM_KUNENA_BOOTSTRAP_DATEPICKER_CLEAR');
?>
<h3>
	<?php echo $this->headerText; ?>
</h3>

<table class="table table-bordered table-striped table-hover">
	<tbody>
	<?php if ($this->config->personal) : ?>
		<tr>
			<td class="span3">
				<label for="personaltext">
					<?php echo Text::_('COM_KUNENA_MYPROFILE_PERSONALTEXT'); ?>
				</label>
			</td>
			<td>
				<input id="personaltext" type="text" maxlength="<?php echo (int) $this->config->maxpersotext; ?>"
				       name="personaltext" value="<?php echo $this->escape($this->profile->personalText); ?>"
				       class="hasTooltip" title="<?php echo Text::_('COM_KUNENA_MYPROFILE_PERSONALTEXT_DESC') ?>"/>
			</td>
		</tr>
	<?php endif; ?>
	<tr>
		<td>
			<label for="birthdate">
				<?php echo Text::_('COM_KUNENA_MYPROFILE_BIRTHDATE'); ?>
			</label>
		</td>
		<td>
			<div id="birthdate">
				<div class="input-append date">
					<input type="text" name="birthdate" data-date-format="mm/dd/yyyy"
					       value="<?php echo $this->profile->birthdate == '1000-01-01' ? '' : KunenaDate::getInstance($this->profile->birthdate)->format('m/d/Y'); ?>"
					       class="hasTooltip" title="<?php echo Text::_('COM_KUNENA_MYPROFILE_BIRTHDATE_DESC') ?>">
					<span class="add-on"><?php echo KunenaIcons::grid();?></span>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<label for="location">
				<?php echo Text::_('COM_KUNENA_MYPROFILE_LOCATION'); ?>
			</label>
		</td>
		<td>
			<input id="location" type="text" name="location"
			       value="<?php echo $this->escape($this->profile->location); ?>" class="hasTooltip"
			       title="<?php echo Text::_('COM_KUNENA_MYPROFILE_LOCATION_DESC') ?>"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="gender">
				<?php echo Text::_('COM_KUNENA_MYPROFILE_GENDER'); ?>
			</label>
		</td>
		<td>
			<?php
			// Make the select list for the view type
			$gender[] = HTMLHelper::_('select.option', 0, Text::_('COM_KUNENA_MYPROFILE_GENDER_UNKNOWN'));
			$gender[] = HTMLHelper::_('select.option', 1, Text::_('COM_KUNENA_MYPROFILE_GENDER_MALE'));
			$gender[] = HTMLHelper::_('select.option', 2, Text::_('COM_KUNENA_MYPROFILE_GENDER_FEMALE'));

			// Build the html select list
			echo HTMLHelper::_(
				'select.genericlist', $gender, 'gender', 'class="inputbox hasTooltip" title="' . Text::_('COM_KUNENA_MYPROFILE_GENDER') . '" size="1"', 'value', 'text',
				$this->escape($this->profile->gender), 'gender'
			);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="social-site">
				<?php echo Text::_('COM_KUNENA_MYPROFILE_WEBSITE_NAME'); ?>
			</label>
		</td>
		<td>
				<span class="hasTooltip" title="<?php echo Text::_('COM_KUNENA_MYPROFILE_WEBSITE_NAME')
					. '::' . Text::_('COM_KUNENA_MYPROFILE_WEBSITE_NAME_DESC'); ?>">
					<input id="social-site" type="text" maxlength="25" name="websitename"
					       value="<?php echo $this->escape($this->profile->websitename); ?>"/>
				</span>
		</td>
	</tr>
	<tr>
		<td>
			<label for="social-url">
				<?php echo Text::_('COM_KUNENA_MYPROFILE_WEBSITE_URL'); ?>
			</label>
		</td>
		<td>
				<span class="hasTooltip"
				      title="<?php echo Text::_('COM_KUNENA_MYPROFILE_WEBSITE_URL') . '::' . Text::_('COM_KUNENA_MYPROFILE_WEBSITE_URL_DESC'); ?>">
					<input id="social-url" type="url" name="websiteurl"
					       value="<?php echo $this->escape($this->profile->getWebsiteURL()); ?>"/>
				</span>
		</td>
	</tr>

	<?php if ($this->config->social) : ?>
		<?php foreach ($this->social as $key => $social) : ?>
			<tr>
				<td>
					<label for="social-<?php echo $key; ?>">
						<?php echo Text::_('COM_KUNENA_MYPROFILE_' . $key); ?>
					</label>
				</td>
				<td>
					<?php if ($social != 'qq') : ?>
					<span class="hasTooltip" title="<?php echo Text::_("COM_KUNENA_MYPROFILE_{$key}")
						. '::' . Text::_("COM_KUNENA_MYPROFILE_{$key}_DESC"); ?>">
				<?php endif; ?>
						<input id="social-<?php echo $key; ?>" type="text" name="<?php echo $key ?>"
						       value="<?php echo $this->escape($this->profile->$key); ?>"/>
				</span>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if ($this->config->signature) : ?>
		<tr>
			<td>
				<label for="signature">
					<?php echo Text::_('COM_KUNENA_MYPROFILE_SIGNATURE'); ?>
				</label>
			</td>
			<td>
				<span class="hasTooltip" title="<?php echo Text::_('COM_KUNENA_MYPROFILE_SIGNATURE')
					. '::' . Text::_('COM_KUNENA_MYPROFILE_SIGNATURE_DESC'); ?>">
					<textarea class="input-xxlarge" maxlength="<?php echo (int) $this->config->maxsig; ?>"
					          name="signature" id="signature" rows="10"
					          cols="30"><?php echo $this->escape($this->profile->signature); ?></textarea>
				</span>
			</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
