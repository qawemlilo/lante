<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<div class="remind<?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>

	<form id="user-registration" style="margin: 10px;" action="<?php echo JRoute::_('index.php?option=com_users&task=remind.remind'); ?>" method="post" class="form-validate form-horizontal">

		<?php foreach ($this->form->getFieldsets() as $fieldset): ?>
		<div class="alert alert-info"><?php echo JText::_($fieldset->label); ?></div>		
        <fieldset>
			<dl class="control-group">
			<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field): ?>
				<dt class="control-label"><?php echo $field->label; ?></dt>
				<dd class="controls"><?php echo $field->input; ?></dd>
			<?php endforeach; ?>
			</dl>
		</fieldset>
		<?php endforeach; ?>
		<div class="form-actions" style="margin-left: 0px; margin-top: -10px;">
			<button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
