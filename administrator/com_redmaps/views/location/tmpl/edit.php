<?php
/**
 * @version     1.0.0
 * @package     com_redmaps
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_redmaps/assets/css/redmaps.css');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'location.cancel' || document.formvalidator.isValid(document.id('location-form'))) {
			Joomla.submitform(task, document.getElementById('location-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_redmaps&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="location-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('COM_REDMAPS_NEW_LOCATION') : JText::sprintf('COM_REDMAPS_EDIT_LOCATION', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('name'); ?>
				<?php echo $this->form->getInput('name'); ?></li>

				<li><?php echo $this->form->getLabel('statespecific_id'); ?>
				<?php echo $this->form->getInput('statespecific_id'); ?></li>

				<li><?php echo $this->form->getLabel('id'); ?>
				<?php echo $this->form->getInput('id'); ?></li>
			</ul>

		</fieldset>
	</div>

	<div class="width-40 fltrt">
		<?php echo JHtml::_('sliders.start', 'statespecific-sliders-'.$this->item->id, array('useCookie'=>1)); ?>
			<?php echo JHtml::_('sliders.panel', JText::_('COM_REDMAPS_BASIC_FIELDSET_LABEL'), 'params-options'); ?>
			<fieldset class="panelform">
				<ul class="adminformlist">
					<?php foreach($this->form->getGroup('params') as $field): ?>
						<?php if ($field->hidden): ?>
							<li><?php echo $field->input; ?></li>
						<?php else: ?>
							<li><?php echo $field->label; ?>
							<?php echo $field->input; ?></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</fieldset>
		<?php echo JHtml::_('sliders.end'); ?>
	</div>

	<input type="hidden" name="task" value="" />
	<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>